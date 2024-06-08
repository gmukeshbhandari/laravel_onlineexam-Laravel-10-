
<input type="hidden" name="per_page_search" value="{{ $perPage }}">
<input type="hidden" name="page_search" value="{{ $page }}">

<table class="table table-hover caption-top">
    <caption class="display-6 mb-2 text-white"> List of Added Subjects <p> <button class="btn btn-primary" onclick="getCheckboxValues_subjects_search()"> Mass Delete </button> </p> </caption>
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $subject_list->id}}" value="{{ $subject_list->id}}">
                    </div>
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
                    <form id="form_search_{{ $subject_list->id }}" method="post" action="{{ route('admin_manage_questions_selected') }}">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject_list->id }}">
                        <button type="submit" data-search-subject-id="{{ $subject_list->id }}" class="btn btn-primary manage-question-search-btn" @if($subject_list->Status === '0') disabled @endif"> Manage Question </button>
                    </form>
                    <a class="edit_subject btn btn-sm btn-info @if($subject_list->Status === '0') disabled @endif"  data-facultyid="{{ $subject_list->Faculty_ID }}" data-facultyname="{{ $subject_list->Faculty_Name }}" data-name="{{ $subject_list->Subject_Name }}" href="{{ route('manage_subject_individual_edit',['id' =>$subject_list->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Edit </a>
                    <a class="delete_subject btn btn-sm btn-danger @if($subject_list->Status === '0') disabled @endif" data-name="{{ $subject_list->Subject_Name }}"  href="{{ route('manage_subject_individual',['id' =>$subject_list->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Delete </a>
                </h4>
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
