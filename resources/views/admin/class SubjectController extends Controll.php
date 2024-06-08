class SubjectController extends Controller
{
public function addSubjects(Request $request)
{
    $admin_username = Auth::guard('admin')->user()->institute_username;
    $faculty_id = $request->input('faculty_id');
    $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admin_username)->count();
    $subject_name = trim($request->input('subject_name'));
    $subject_added = Subject::create([
    'Subject_Name' => $subject_name,
    'Faculty_ID' =>  $faculty_id,
    'Date_Added' => now(),
    ]);
    return  response()->json(['msg' => 'Subject Added Successfully.','subject_count' => 'Greater than 0']);
}

public function manageSubjectIndividualEdit($id, Request $request)
    {
        $faculty_id = $request->input('faculty_id');

        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1); //Default page is 1

        $admin_username = Auth::guard('admin')->user()->institute_username;
        $subject = Subject::find($id);

        if($subject)
        {
            $subject->Subject_Name = $request->input('new_subject_name');
            $subject->Subject_Name_Last_Updated_Date = now();
            $is_subject_updated = $subject->save();
            if($is_subject_updated)
            {
                $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admin_username)->count();
                return response()->json(['message' => 'successful','subject_count' => 'Greater than 0','per_page' => $per_page,'page' => $page]);
            }
            else
            {
                return response()->json(['message' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
            }
        }
    }
}

<form action="#" method="post" class="w-75" id="add_subject">
@csrf
<div class="mb-2 w-100 w-md-50 flex-grow-1">
    <label for="faculty_list" class="form-label"> Select Faculty <span style="color: red"> * </span> </label>
    <select id="faculty_list" name="faculty_list" class="form-select">
        <option style="display:none" disabled selected value> Select Faculty </option>
        @foreach ($faculty_list as $facultylist)
            <option value="{{ $facultylist->id }}"> {{ $facultylist->Faculty_Name }} </option>
        @endforeach
    </select>
    <span class="text-danger" id="faculty_selection_error">   </span>
</div>
<div class="mb-2 w-100 w-md-50 flex-grow-1">
    <label class="form-label" for="subject_name"> Subject Name <span style="color: red"> * </span> </label>
    <input type="text" class="form-control" name="subject_name" id="subject_name" maxlength="100" value="{{ old('subject_name')}}">
    <span class="text-danger" id="subject_name_error">  </span>
</div>
<div class="mb-2">
    <button type="submit" class="btn btn-primary w-100"> Add Subject </button>
</div>
</form>

<div class="w-75 mt-2">
    <input type="text" maxlength="20" id="search_subjects" class=" mb-2 form-control" placeholder="Search...">
</div>

<div class="d-flex flex-column p-2" id="listofsubjectsadded">
    <div class="table-responsive">
        <div id="search_subjects_results">
        </div>
        <div id="original_subjects_table">
        <table class="table table-hover caption-top">
            <thead>
        <tr>
            <th> </th>
            <th scope="col"> S.N </th>
            <th scope="col"> Subject Name </th>
            <th scope="col"> Added Under Faculty </th>
            <th scope="col"> Action </th>
        </tr>
            </thead>
            <tbody>
            @foreach($total_subject_list as $key => $subject_list)
            <tr>
            <td>
                        @if($subject_list->Status === '1')
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{ $subject_list->id}}" value="{{ $subject_list->id}}" @if($subject_list->Status === '0') disabled @endif>
                            </div>
                        @endif
                    </td>
                    <th scope="row"> {{ $key + $total_subject_list->firstItem() }} </th>
                    <td> {{ $subject_list->Subject_Name }}</td>
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
        </div>
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
    {{ $total_subject_list->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }}
    </div>
    </div>
</div>

<script>
    let add_subject_route = "{{ route('admin_add_subjects') }}";
    let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
</script>

Route::post('/admin/manage-subjects/add',[SubjectController::class,'addSubjects'])->name('admin_add_subjects');

$('#add_subject').on('submit', function (e) {
        e.preventDefault();
        let faculty_id = $('#faculty_list').val();
        let subject_name =  $('#subject_name').val().trim();
        let _token = $('input[name="_token"]').val();
        $.ajax({
                type: 'POST',
                url: add_subject_route,
                data: {_token:_token,faculty_id:faculty_id,subject_name:subject_name},
                dataType: 'json',
                success: function(result)
                {
                    $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                }
});



$(document).on('click', '.edit_subject', function(e) {
        e.preventDefault();
        e.stopPropagation();


        let url_edit = $(this).attr('href');
        let faculty_id = $(this).data('facultyid');
        let faculty_name = $(this).data('facultyname');
        let subject_name = $(this).data('name');
        let _token =  document.head.querySelector('meta[name="csrf-token"]').content;

        Swal.fire({
            title: 'Update Subject Name of ' + subject_name + '<br>(under faculty ' + faculty_name + ')',
            input: 'text',
            inputValue: subject_name,
            showCancelButton: true,
            confirmButtonText: 'Update',
            showLoaderOnConfirm: true,
            inputAttributes: {
                maxlength: 100,
                required:true
            },
            preConfirm: (new_subject_name) => {
                return $.ajax({
                    url: url_edit,
                    type: 'POST',
                    data: {
                        _token: _token,
                        new_subject_name: new_subject_name,
                        old_subject_name: subject_name,
                        faculty_id: faculty_id
                    },
                    success: function(response){

                        if(response.message === "successful")
                        {
                            $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                            $('#search_subjects').trigger('input');
                            Swal.fire({
                                title: "Updated!",
                                text: "Subject name updated successfully.",
                                icon: "success"
                            });
                        }
                        else if(response.message === "Something went wrong.")
                        {

                        $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                        $('#search_subjects').trigger('input');

                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while updating the subject name",
                                icon: "error"
                            });
                        }
                    },

                });
            }
        });
        });
