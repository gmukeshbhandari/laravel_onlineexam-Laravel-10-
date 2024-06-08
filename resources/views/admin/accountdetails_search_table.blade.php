<input type="hidden" name="per_page_search" value="{{ $perPage }}">
<input type="hidden" name="page_search" value="{{ $page }}">


<table class="table">
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
            if ($logininfo->Login_Type == "Log Out-Disable by SuperAdmin")
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
