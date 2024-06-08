@extends('admindashboard')
@section('headsectiondashboard')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('title','Admin Dashboard - Manage Questions')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <form action="{{ route('admin_manage_questions_selected') }}" method="post" class="w-75" id="add_question">
            @csrf
            @if ($faculty_list->isEmpty() && $subject_list->isEmpty())
            <small class="text-danger"> Add faculty and subject before adding questions. <a href="{{ route('admin_manage_faculties') }}"> Click here to add faculty </a> </small>
            @endif
            @if (!$faculty_list->isEmpty() && $subject_list->isEmpty())
            <small class="text-danger"> Add subject before adding questions. <a href="{{ route('admin_manage_subjects') }}"> Click here to add subject </a> </small>
            @endif
            <div class="d-flex flex-column flex-sm-row gap-2 mb-2">
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label for="faculty_list_for_question" class="form-label"> Select Faculty <span style="color: red"> * </span> </label>
                    <select id="faculty_list_for_question" name="faculty_list_for_question"  id="faculty_list_for_question" class="form-select" @if ($faculty_list->isEmpty() || $subject_list->isEmpty()) disabled @endif>
                        <option style="display:none" disabled selected value> Select Faculty </option>
                        @foreach ($faculty_list as $facultylist)
                            <option data-facultyname="{{ $facultylist->Faculty_Name}}" value="{{ $facultylist->id }}"> {{ $facultylist->Faculty_Name }} </option>
                        @endforeach
                    </select> 
                    <span class="text-danger" id="faculty_selection_question_error">   </span>
                </div>
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label class="form-label" for="subject_id"> Subject Name <span style="color: red"> * </span> </label>
                    <select class="form-select" name="subject_id" id="subject_id" @if ($faculty_list->isEmpty() || $subject_list->isEmpty()) disabled @endif>
                        <option style="display:none" disabled selected value> Select Subject </option>
                    </select>
                    <span class="text-danger" id="subject_name_for_question_error">  </span>
                </div>
            </div>
            <div class="mb-2 text-center">
                <span class="text-success" id="final_question_error">  </span>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-primary w-100" @if ($faculty_list->isEmpty() || $subject_list->isEmpty()) disabled @endif> Manage Question </button>
            </div>
        </form>
    </div>
    <script>
        let get_subject_url = "{{ route('get_subject') }}";
    </script>
    <script src="{{ asset('js/custom/question.js') }}">  </script>
@endsection