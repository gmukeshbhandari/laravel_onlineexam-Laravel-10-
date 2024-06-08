@extends('admindashboard')
@section('headsectiondashboard')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"> </script>
@endsection
@section('title','Admin Dashboard - Manage Faculties')
@section('content')
<div class="d-flex justify-content-center align-items-center">
        <form action="#" method="post" class="w-50" id="add_faculty">
            @csrf
            <div class="mb-2">
                <label class="form-label" for="faculty_name"> Faculty Name <span style="color: red"> * </span> </label>
                <input type="text" class="form-control" name="faculty_name" id="faculty_name" maxlength="100" value="{{ old('faculty_name')}}" autofocus>
                <span class="text-danger" id="faculty_name_error">   </span>
            </div>
            <div>
                <button type="submit" class="btn btn-primary"> Add Faculty </button>
            </div>
        </form>
</div>
    @if($faculty_list->isNotEmpty())
    <div class="d-flex flex-column p-2" id="listoffacultiesadded">
        <div class="table-responsive">
        <table class="table table-hover caption-top"  id="listoffaculties_sort">
            <caption class="display-6 mb-2 text-white"> List of Added Faculties <p> <button class="btn btn-primary" onclick="getCheckboxValues()"> Mass Delete </button> </p> </caption>
            <thead>
            <tr>
                <th> </th>
                <th scope="col"> S.N </th>
                <th scope="col"> Faculty Name <i onclick="sortTable(1)" class="fa-solid fa-sort"></i> </th>
                <th scope="col"> Date Added <i onclick="sortTable(2)" class="fa-solid fa-sort"></i> </th>
                <th scope="col"> No of Subject under this Faculty <i onclick="sortTable(3)" class="fa-solid fa-sort"></i> </th>
                <th scope="col"> Action </th>
            </tr>
            </thead>
            <input type="hidden" name="per_page" value="{{ $perPage }}">
            <input type="hidden" name="page" value="{{ $page }}">
            <tbody>
                {{-- @php
                    $count = 1;
                @endphp --}}
                @foreach($faculty_list as $key => $facultylist) {{-- If we dont want S.N we can remove this and write below --}}
                    {{--  @foreach($faculty_list as $key => $facultylist) --}}  {{-- If we dont want S.N we can do this --}}
                    <tr>
                        <td>
                            @if($facultylist->Status === '1')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="{{ $facultylist->id}}" value="{{ $facultylist->id}}" @if($facultylist->Status === '0') disabled @endif>
                                </div>
                            @endif
                        </td>
                        {{-- <th scope="row">@php echo $count @endphp</th>
                        @php $count++; @endphp --}}
                        <th scope="row"> {{ $key + $faculty_list->firstItem() }} </th>
                        <td>
                            {{ $facultylist->Faculty_Name }}
                                @if(!empty($facultylist->Old_Faculty_Names))
                                    @php
                                    $old_faculties_converted_to_array = explode(',', $facultylist->Old_Faculty_Names);
                                    //explode converted string from $facultylist->Old_Faculty_Names into an array of entries based on commas.
                                    //For Example: 2024-02-19 10:55:56:Class 123,2024-02-19 10:56:06:Class 1235ty,2024-02-19 10:56:36:Class 123,2024-02-19 10:58:54:Class 11 is converted into following:
                                    //   0 => "2024-02-19 10:55:56:Class 123"
                                    //   1 => "2024-02-19 10:56:06:Class 1235ty"
                                    //   2 => "2024-02-19 10:56:36:Class 123"
                                    //   3 => "2024-02-19 10:58:54:Class 11"
                                    @endphp
                                    <a href="#" data-target="pop_up_old_faculty_names_{{ $facultylist->id }}" class="show_old_faculties"> <i class="fa-solid fa-list"></i> </a>
                                    <div id="pop_up_old_faculty_names_{{ $facultylist->id }}" class="d-flex justify-content-center align-items-center d-none">
                                        <h5 class="text-decoration-underline"> Old Names of {{ $facultylist->Faculty_Name }} </h5>
                                        <ul class="list-unstyled">
                                            @foreach($old_faculties_converted_to_array as $key => $old_faculty_name)
                                                @php
                                                    $parts = explode(':', $old_faculty_name);
                                                    //again converts each faculties from above into array separeted by colon for example: 2024-02-19 10:55:56:Class 123 is converted into following separted
                                                    //array:4[
                                                    //   0 => "2024-02-19 10"
                                                    //   1 => "55"
                                                    //   2 => "56"
                                                    //   3 => "Class 123"
                                                    // ]
                                                    // Get the class name part
                                                    $faculty_name_only = end($parts);
                                                    // $faculty_name_only = $parts[3];
                                                @endphp
                                                <li> {{ $key + 1 }}. {{ $faculty_name_only }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                        </td>
                        @php
                            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $facultylist->Date_Added);
                            if($facultylist->Faculty_Name_Last_Updated_Date) 
                            {
                                $date_last_updated = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $facultylist->Faculty_Name_Last_Updated_Date); 
                            }
                            else {
                                $date_last_updated = null;
                            }                    
                        @endphp
                        @if($date_last_updated)
                            <td  class="d-flex flex-column gap-2">
                                <span> {{ $date->toDayDateTimeString() }}  </span>
                                <span> {{ $date_last_updated->toDayDateTimeString() }} <small> (Faculty Name Last Updated) </small> </span>
                            </td>
                        @else
                            <td>
                                {{ $date->toDayDateTimeString() }}
                            </td>
                        @endif

                        <td>
                            @php
                            $count_subject = $facultylist->subjects()->count();
                            @endphp
                            {{ $count_subject }}
                        @if($count_subject > 0)
                            <a href="#" data-target="pop_up_subject_names_{{ $facultylist->id }}" class="show_subjects"> <i class="fa-solid fa-list"></i> </a>
                            <div id="pop_up_subject_names_{{ $facultylist->id }}" class="d-none">
                                <h5 class="text-decoration-underline"> List of Subject Name Under {{ $facultylist->Faculty_Name }} </h5>
                                <ul class="list-unstyled text-center">
                                    @foreach($facultylist->subjects as $key => $subject)
                                        <li>  {{ $key + 1 }}. {{ $subject->Subject_Name }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </td>
 
                        <td>
                        <h4 class="d-flex flex-column flex-md-row gap-2">
                            <a class="edit_faculty btn btn-sm btn-info @if($facultylist->Status === '0') disabled @endif" data-name="{{ $facultylist->Faculty_Name }}" href="{{ route('manage_faculty_individual_edit',['id' =>$facultylist->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Edit </a>
                            <a class="delete_faculty btn btn-sm btn-danger @if($facultylist->Status === '0') disabled @endif"  data-name="{{ $facultylist->Faculty_Name }}"  href="{{ route('manage_faculty_individual',['id' =>$facultylist->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Delete </a>
                        </h4>
                    </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
        <div class="d-flex gap-2 justify-content-between mb-2">
            <form method="get" action="{{ route('admin_manage_faculties') }}">
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
            @if ($faculty_list->total() !== 0)
                @if ($faculty_list->total() >= $perPage)
                    <p class="mb-0"> Showing 1 to {{ $perPage }} of {{ $faculty_list->total() }} items </p>
                @else
                    <p class="mb-0"> Showing 1 to {{ $faculty_list->total()  }} of {{ $faculty_list->total() }} items </p>
                @endif
            @else
                <p class="mb-0"> Showing 0 items </p>
            @endif
        </div>
        <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
        {{-- {{ $faculty_list->links() }} --}}
        {{-- {{ $faculty_list->links('custom-pagination') }} --}}
        {{ $faculty_list->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }}
        </div>
        </div>
    </div>

@endif
<script>
    let add_faculty_route = "{{ route('admin_add_faculties') }}";
    let mass_manage = "{{ route('mass_manage') }}";
    let faculty_route_list = "{{ route('admin_manage_faculties') }}";
    let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
    // let csrf_token = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/custom/faculty.js') }}">  </script>
@endsection
