
<input type="hidden" name="per_page_search" value="{{ $perPage }}">
<input type="hidden" name="page_search" value="{{ $page }}">

<table class="table table-hover caption-top">
  <caption class="display-6 mb-2 text-white"> Student Information <p> <button class="btn btn-primary" onclick="getCheckboxValues_subjects_search()"> Alter Activation Status of Selected Box </button> </p> </caption>
        <thead>
          <tr>
            <th> </th>
            <th scope="col"> S.N </th>
            {{-- <th scope="col"> Image </th> --}}
            <th scope="col"> Name </th>
            {{-- <th scope="col"> Username </th> --}}
            <th scope="col"> Gender </th>
            <th scope="col"> Account Status </th>
            <th scope="col"> Action </th>
          </tr>
        </thead>
        <tbody>
          @foreach($studentinfo as $key => $student_info)
          <tr>
            <td>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="{{ $student_info->id}}" value="{{ $student_info->id}}">
              </div>
            </td>
            <th scope="row">{{ $key + $studentinfo->firstItem() }}</th>
            <td>
              <div class="d-flex align-items-center">
              {{-- <img src="{{ asset( $student_info->image_file_path) }}" class="rounded-circle" alt="" style="width: 32px; height: 32px"/> --}}
                <img src="{{ asset( $student_info->image_file_path) }}" alt="" style="width:32px;height:32px;object-fit:cover;border-radius:50%">
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{ $student_info->First_Name }} {{ $student_info->Middle_Name }}  {{ $student_info->Last_Name }}</p>
                  <p class="text-muted mb-0">{{ $student_info->user_username }}</p>
                </div>
              </div>
            </td>
            <td> {{ $student_info->Gender }} </td>
            <td> {!! $student_info->flag_en_dis == '1' ?
              '<span class="badge text-bg-success rounded-pill">Active</span>': '<span class="badge text-bg-danger rounded-pill">Inactive</span>' !!} </td>
              <td>
                <h4>
                    @if($student_info->flag_en_dis == 1)
                        <a class="btn btn-sm btn-info" href="{{ route('change_student_account_status',['id' =>$student_info->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Inactivate </a>
                    @else
                        <a class="btn btn-sm btn-info" href="{{ route('change_student_account_status',['id' =>$student_info->id,'per_page' => request('per_page', 10), 'page' => request('page', 1)] )}}"> Activate </a>
                    @endif
                </h4>
            </td>
          </tr>
      @endforeach
        </tbody>
</table>
