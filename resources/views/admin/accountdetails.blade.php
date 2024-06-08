@extends('admindashboard')
@section('title', 'Account Details - Online Examination System')
@section('content')
<div class="d-flex flex-column p-2">
  <div class="w-75">
    <input type="text" maxlength="20" id="search_login" class=" mb-2 form-control" placeholder="Search...">
  </div>
    <div class="mb-2">
      <h4> Account Details</h4>
    </div>
    <div class="table-responsive">
      <div id="search_login_details_result">

      </div>
      <div id="original_login_details_table">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col"> S.N </th>
                <th scope="col"> Date </th>
                <th scope="col"> Time </th>
                <th scope="col"> Mobile/PC </th>
                <th scope="col"> Platform </th>
                <th scope="col"> Browser </th>
                {{-- <th scope="col"> Device Name </th> --}}
                <th scope="col"> IP Address </th>
                <th scope="col"> Activity </th>
              </tr>
            </thead>
          <input type="hidden" name="per_page_search_login_details" value="{{ $perPage }}">
          <input type="hidden" name="page_search_login_details" value="{{ $page }}">
            <tbody>
                {{-- @php
                    $count = 1;
                @endphp --}}
                {{-- @foreach($logindetails as $logininfo) --}}
                @foreach($logindetails as $key => $logininfo)
                @php
                    $date = $logininfo->Login_DateandTime;
                    $carbonDate = \Carbon\Carbon::parse($date);
                    $formatteddate = $carbonDate->format('Y F j');
                    // $formattedtime = $carbonDate->format('H:i:s');
                    $formattedtime = $carbonDate->format('h:i:s A');
                    if ($logininfo->Login_Type == "Account Creation")
                    {
                        $activity = "New Account Created";
                    }
                    if ($logininfo->Login_Type == "Log In with Password")
                    {
                        $activity = "Log in";
                    }
                    if ($logininfo->Login_Type == "Log Out")
                    {
                        $activity = "Log out";
                    }
                    if ($logininfo->Login_Type == "Log Out - Change Password")
                    {
                        $activity = "Change Password";
                    }
                    if ($logininfo->Login_Type == "Log Out - Reset Password")
                    {
                        $activity = "Reset Password";
                    }
                    if ($logininfo->Login_Type == "Reset Password Without Log Out")
                    {
                        $activity = "Reset Password";
                    }
                    if ($logininfo->Login_Type == "Log Out - Disable by SuperAdmin")
                    {
                        $activity = "Disabled by System";
                    }
                    if ($logininfo->Login_Type == "Disable by SuperAdmin Without Log Out")
                    {
                        $activity = "Disabled by System";
                    }
                
                 $userAgent = $logininfo->User_Agent;
                  $isMobile = strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false;
                  $devicetype = $isMobile ? 'Mobile' : 'PC';
                @endphp
              
                <tr>
                {{-- <th scope="row">@php echo $count @endphp</th> --}}
                {{-- @php $count++; @endphp --}}
                <th scope="row"> {{  $key + $logindetails->firstItem() }} </th>
                <td> {{ $formatteddate }}  </td>
                <td> {{ $formattedtime }}  </td>
                <td> {{ $devicetype }}  </td>
                <td> {{ $logininfo->Platform }}  </td>
                <td> {{ $logininfo->Browser }}  </td>
                {{-- <td> {{ $logininfo->Device }}  </td> --}}
                <td> {{ $logininfo->IP_Address }} </td>
                <td> {{ $activity }} </td>
              </tr>
          @endforeach
            </tbody>
          </table>
        </div>
          <div class="d-flex gap-2 justify-content-between mb-2" id="original_login_details_table_per_page">
            <form method="get" action="{{ route('account_details_admin') }}">
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
          @if ($logindetails->total() !== 0)
            @if ($logindetails->total() >= $perPage)
              <p class="mb-0"> Showing 1 to {{ $perPage }} of {{ $logindetails->total() }} items </p>
            @else
              <p class="mb-0"> Showing 1 to {{ $logindetails->total()  }} of {{ $logindetails->total() }} items </p>
            @endif
          @else
            <p class="mb-0"> Showing 0 items </p>
          @endif
            
          </div>
          <div class="d-flex flex-column gap-2 align-items-center justify-content-center" id="original_login_details_table_next_previous">
          {{-- {{ $logindetails->links() }} --}}
          {{-- {{ $logindetails->links('custom-pagination') }} --}}
          {{ $logindetails->appends(['per_page' => Request::input('per_page')])->links('custom-pagination') }}
          </div>
    </div>
</div>

<script>
  let account_details_route = "{{ route('account_details_admin') }}";
</script>
<script src="{{ asset('js/custom/accountdetails.js') }}">  </script>
@endsection




