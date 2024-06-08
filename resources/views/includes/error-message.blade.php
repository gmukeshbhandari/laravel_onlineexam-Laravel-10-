@if ($errors->any() || Session::has('errormsg') || Session::has('warning'))
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
            {!! Session::has('errormsg') ? Session::get("errormsg") : '' !!}
            {!! Session::has('warning') ? Session::get("warning") : '' !!}
        </ul>
    </div>
@endif


{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif --}}



