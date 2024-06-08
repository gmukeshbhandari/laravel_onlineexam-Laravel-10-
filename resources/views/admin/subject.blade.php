@extends('admindashboard')
@section('headsectiondashboard')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    @media screen and (min-width: 1023px) and (max-width: 1080px) {
    #examduration {
        font-size: 15px;
    }
}
@media screen and (min-width: 766px) and (max-width: 950px) {
    #examduration {
        font-size: 10px;
    }
}
</style>
@endsection
@section('title','Admin Dashboard - Manage Faculties')
@section('content')
<div class="d-flex justify-content-center align-items-center">
    <form action="#" method="post" class="w-75" id="add_subject">
        @csrf

        @if ($faculty_list->isEmpty()) <small class="text-danger"> Add Faculty before adding Subject. <a href="{{ route('admin_manage_faculties') }}"> Click Here </a> </small> @endif
            <div class="d-flex flex-column flex-sm-row gap-2 mb-2">
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label for="faculty_list" class="form-label"> Select Faculty <span style="color: red"> * </span> </label>
                    <select id="faculty_list" name="faculty_list" class="form-select" @if ($faculty_list->isEmpty()) disabled @endif>
                        <option style="display:none" disabled selected value> Select Faculty </option>
                        @foreach ($faculty_list as $facultylist)
                            <option value="{{ $facultylist->id }}"> {{ $facultylist->Faculty_Name }} </option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="faculty_selection_error">   </span>
                </div>
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label class="form-label" for="subject_name"> Subject Name <span style="color: red"> * </span> </label>
                    <input type="text" class="form-control" name="subject_name" id="subject_name" maxlength="100" value="{{ old('subject_name')}}"  @if ($faculty_list->isEmpty()) disabled @endif autofocus>
                    <span class="text-danger" id="subject_name_error">  </span>
                </div>
            </div>
            <div class="text-center mb-2">
                <small class="text-danger"> <em> (Optional: Full Marks, Pass Marks and Exam Duration can be added later on.) </em> </small>
            </div>
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2 mb-2">
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label class="form-label" for="full_marks"> Full Marks </label>
                    <input type="number" class="form-control" name="full_marks" id="full_marks" min="0.001" max="9999.999" value="{{ old('full_marks')}}" step="0.001" @if ($faculty_list->isEmpty()) disabled @endif>
                    <span class="text-danger" id="full_marks_error">   </span>
                </div>
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label class="form-label" id="examduration" for="exam_duration"> Exam Duration (in seconds) </label>
                    <input type="number" class="form-control" name="exam_duration" id="exam_duration" min="60" max="14400" value="{{ old('exam_duration')}}" @if ($faculty_list->isEmpty()) disabled @endif>
                    <span class="text-danger" id="exam_duration_error">  </span>
                </div>
                <div class="mb-2 w-100 w-md-50 flex-grow-1">
                    <label class="form-label" for="pass_marks"> Pass Marks </label>
                    <input type="number" class="form-control" name="pass_marks" id="pass_marks" min="0.001" max="9999.998" value="{{ old('pass_marks')}}" step="0.001" @if ($faculty_list->isEmpty()) disabled @endif>
                    <span class="text-danger" id="pass_marks_error">   </span>
                </div>
            </div>
            <div class="mb-2 text-center">
                <span class="text-success" id="final_error">  </span>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-primary w-100" @if ($faculty_list->isEmpty()) disabled @endif> Add Subject </button>
            </div>
    </form>
</div>

@if($total_subject_list->isNotEmpty())
<div class="w-75 mt-2">
    <input type="text" maxlength="20" id="search_subjects" class=" mb-2 form-control" placeholder="Search...">
</div>
<div id="search_subjects_results">

</div>
<div class="d-flex flex-column p-2" id="original_subjects_table">
{{-- <div class="d-flex flex-column p-2" id="listofsubjectsadded"> --}}
    <div class="table-responsive">
    {{-- <div id="search_subjects_results">

    </div> --}}
    {{-- <div id="original_subjects_table"> --}}
    <table class="table table-hover caption-top">
        <caption class="display-6 mb-2 text-white"> List of Added Subjects <p> <button class="btn btn-primary" onclick="getCheckboxValues_subjects()"> Mass Delete </button> </p> </caption>
        <thead>
        <tr>
            <th> </th>
            <th scope="col"> S.N </th>
            <th scope="col"> Subject Name </th>
            <th scope="col"> Added Under Faculty </th>
            <th scope="col"> Full Marks </th>
            <th scope="col"> Pass Marks </th>
            <th scope="col"> Exam Duration </th>
            <th scope="col"> Date Added </th>
            <th scope="col"> Action </th>
        </tr>
        </thead>
        <input type="hidden" name="per_page" value="{{ $perPage }}">
        <input type="hidden" name="page" value="{{ $page }}">
        <tbody>
            {{-- @php
                $count = 1;
            @endphp --}}
            @foreach($total_subject_list as $key => $subject_list) {{-- If we dont want S.N we can remove this and write below --}}
                {{--  @foreach($total_subject_list as $key => $subject_list) --}}  {{-- If we dont want S.N we can do this --}}
                <tr>
                    <td>
                        @if($subject_list->Status === '1')
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{ $subject_list->id}}" value="{{ $subject_list->id}}" @if($subject_list->Status === '0') disabled @endif>
                            </div>
                        @endif
                    </td>
                    {{-- <th scope="row">@php echo $count @endphp</th>
                    @php $count++; @endphp --}}
                    <th scope="row"> {{ $key + $total_subject_list->firstItem() }} </th>
                    <td>
                        {{ $subject_list->Subject_Name }}
                        @if(!empty($subject_list->Old_Subject_Names))
                        @php
                        $old_subjects_converted_to_array = explode(',', $subject_list->Old_Subject_Names);
                        //explode converted string from $subject_list->Old_Subject_Names into an array of entries based on commas.
                        //For Example: 2024-02-19 10:55:56:Subject def,2024-02-19 10:56:06:Math is converted into following:
                        //   0 => "2024-02-19 10:55:56:Subject def"
                        //   1 => "2024-02-19 10:56:06:Math"
                        @endphp
                        <a href="#" data-target="pop_up_old_subject_names_{{ $subject_list->id }}" class="show_old_subjects"> <i class="fa-solid fa-list"></i> </a>
                        <div id="pop_up_old_subject_names_{{ $subject_list->id }}" class="d-flex justify-content-center align-items-center d-none">
                            <h5 class="text-decoration-underline"> Old Names of {{ $subject_list->Subject_Name }} </h5>
                            <ul class="list-unstyled">
                                @foreach($old_subjects_converted_to_array as $key => $old_subject_name)
                                    @php
                                        $parts = explode(':', $old_subject_name);
                                        //again converts each subjects from above into array separeted by colon for example: 2024-02-19 10:55:56:Math is converted into following separted
                                        //array:4[
                                        //   0 => "2024-02-19 10"
                                        //   1 => "55"
                                        //   2 => "56"
                                        //   3 => "Math"
                                        // ]
                                        // Get the class name part
                                        $subject_name_only = end($parts);
                                        // $faculty_name_only = $parts[3];
                                    @endphp
                                    <li> {{ $key + 1 }}. {{ $subject_name_only }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </td>
                    <td> {{ $subject_list->Faculty_Name }}</td>
                    <td>  @if(empty($subject_list->Full_Marks)) - @else {{ $subject_list->Full_Marks }} @endif </td>
                    <td>  @if(empty($subject_list->Pass_Marks)) - @else {{ $subject_list->Pass_Marks }} @endif </td>
                    <td>  @if(empty($subject_list->Exam_Duration)) - @else {{ $subject_list->Exam_Duration }} @endif </td>
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $subject_list->Date_Added);
                        if($subject_list->Subject_Name_Last_Updated_Date)
                        {
                            $date_last_updated = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $subject_list->Subject_Name_Last_Updated_Date);
                        }
                        else {
                            $date_last_updated = null;
                        }
                    @endphp
                    @if($date_last_updated)
                        <td  class="d-flex flex-column gap-2">
                            <span> {{ $date->toDayDateTimeString() }}  </span>
                            <span> {{ $date_last_updated->toDayDateTimeString() }} <small> (Subject Name Last Updated) </small> </span>
                        </td>
                    @else
                        <td>
                            {{ $date->toDayDateTimeString() }}
                        </td>
                    @endif

                    <td>
                    <h4 class="d-flex flex-column flex-md-row gap-2">
                        <form id="form_{{ $subject_list->id }}" method="post" action="{{ route('admin_manage_questions_selected') }}">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $subject_list->id }}">
                            <button type="submit"  data-subject-id="{{ $subject_list->id }}" class="btn btn-primary manage-question-btn" @if($subject_list->Status === '0') disabled @endif"> Manage Question </button>
                        </form>
                        <a class="edit_subject btn btn-sm btn-info @if($subject_list->Status === '0') disabled @endif"  data-facultyid="{{ $subject_list->Faculty_ID }}" data-facultyname="{{ $subject_list->Faculty_Name }}" data-name="{{ $subject_list->Subject_Name }}" href="{{ route('manage_subject_individual_edit',['id' =>$subject_list->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Edit </a>
                        <a class="delete_subject btn btn-sm btn-danger @if($subject_list->Status === '0') disabled @endif" data-name="{{ $subject_list->Subject_Name }}"  href="{{ route('manage_subject_individual',['id' =>$subject_list->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Delete </a>
                    </h4>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- </div> --}}
    <div class="d-flex gap-2 justify-content-between mb-2"  id="original_subject_table_per_page">
        <form method="get" action="{{ route('admin_manage_subjects') }}">
            <label for="per_page">Items per page:</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()">
                <option value="5" {{ Request::input('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ Request::input('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ Request::input('per_page') == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ Request::input('per_page') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ Request::input('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ Request::input('per_page') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>
        @if ($total_subject_list->total() !== 0)
            @if ($total_subject_list->total() >= $perPage)
                <p class="mb-0"> Showing 1 to {{ $perPage }} of {{ $total_subject_list->total() }} items </p>
            @else
                <p class="mb-0"> Showing 1 to {{ $total_subject_list->total()  }} of {{ $total_subject_list->total() }} items </p>
            @endif
        @else
            <p class="mb-0"> Showing 0 items </p>
        @endif
    </div>
    <div class="d-flex flex-column gap-2 align-items-center justify-content-center" id="original_subject_table_next_previous">
    {{-- {{ $faculty_list->links() }} --}}
    {{-- {{ $faculty_list->links('custom-pagination') }} --}}
    {{ $total_subject_list->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }}
    </div>
    </div>
</div>
@endif

<script>
    let add_subject_route = "{{ route('admin_add_subjects') }}";
    let admin_manage_subject = "{{ route('admin_manage_subjects') }}";
    let mass_manage_subject = "{{ route('mass_manage_subjects') }}";
    let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
    // let csrf_token = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/custom/subject.js') }}">  </script>


@endsection
