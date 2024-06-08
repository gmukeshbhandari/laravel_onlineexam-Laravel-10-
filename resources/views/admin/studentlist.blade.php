@extends('admindashboard')
@section('title','Admin Dashboard - Online Examination System')
@section('content')
<div class="d-flex flex-column p-2 customtable">
    {{-- <div class="mb-2">
      <h4> Student Information </h4>
    </div> --}}
    <div class="w-75">
      <input type="text" maxlength="20" id="search_student" class=" mb-2 form-control" placeholder="Search...">
    </div>

      <div class="table-responsive">
      <div id="search_students_results">
      </div>
      <div id="original_student_table">
      <table class="table table-hover caption-top" id="abcdefg">
        <caption class="display-6 mb-2 text-white"> Student Information <p> <button class="btn btn-primary" onclick="getCheckboxValues()"> Alter Activation Status of Selected Box </button> </p> </caption>
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
    
        <input type="hidden" name="per_page" value="{{ $perPage }}">
        <input type="hidden" name="page" value="{{ $page }}">
        <tbody>
            {{-- @php
                $count = 1;
            @endphp --}}
            @foreach($studentinfo as $key => $student_info) {{-- If we dont want S.N we can remove this and write below --}}
           {{--  @foreach($studentinfo as $key => $student_info) --}}  {{-- If we dont want S.N we can do this --}}
          <tr>
            <td>
              <div class="form-check">
                  {{-- <input class="form-check-input" type="checkbox" name="{{ $student_info->user_username }}" value="{{ $student_info->user_username}}"> --}}
                  <input class="form-check-input" type="checkbox" name="{{ $student_info->id}}" value="{{ $student_info->id}}">
                </div>
           </td>
            {{-- <th scope="row">@php echo $count @endphp</th>
            @php $count++; @endphp --}}
            <th scope="row">{{ $key + $studentinfo->firstItem() }}</th>
            {{-- <td> <img src="{{ asset( $student_info->image_file_path) }}" alt="" style="width:32px;height:32px;object-fit:cover;border-radius:50%"> </td> --}}
            {{-- <td> {{ $student_info->First_Name }} {{ $student_info->Middle_Name }}  {{ $student_info->Last_Name }} </td> --}}
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
            {{-- <td> {{ $studentinfo->user_username }} </td> --}}
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
    </div>
      <div class="d-flex gap-2 justify-content-between mb-2" id="original_student_table_per_page">
        <form method="get" action="{{ route('student_list') }}">
          <label for="per_page">Items per page:</label>
          <select name="per_page" id="per_page" onchange="this.form.submit()">
              <option value="5" {{ Request::input('per_page') == 5 ? 'selected' : '' }}>5</option>
              <option value="10" {{ Request::input('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
              <option value="20" {{ Request::input('per_page') == 20 ? 'selected' : '' }}>20</option>
              <option value="50" {{ Request::input('per_page') == 50 ? 'selected' : '' }}>50</option>
              <option value="100" {{ Request::input('per_page') == 100 ? 'selected' : '' }}>100</option>
          </select>
        </form>
        @if ($studentinfo->total() !== 0)
          @if ($studentinfo->total() >= $perPage)
            <p class="mb-0"> Showing 1 to {{ $perPage }} of {{ $studentinfo->total() }} items </p>
          @else
            <p class="mb-0"> Showing 1 to {{ $studentinfo->total()  }} of {{ $studentinfo->total() }} items </p>
          @endif
        @else
          <p class="mb-0"> Showing 0 items </p>
        @endif
      </div>
      <div class="d-flex flex-column gap-2 align-items-center justify-content-center" id="original_student_table_next_previous">
      {{-- {{ $studentinfo->links() }} --}}
      {{-- {{ $studentinfo->links('custom-pagination') }} --}}
      {{-- {{ $studentinfo->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }} --}}
      {{ $studentinfo->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }}
      </div>
    </div>
   
</div>
 <script>
        let mass_inactivate_activate = "{{ route('mass_inactivate_activate_student') }}";
        let student_list_route = "{{ route('student_list') }}";
        let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
</script>
<script src="{{ asset('js/custom/studentlist.js') }}">  </script>

@endsection
