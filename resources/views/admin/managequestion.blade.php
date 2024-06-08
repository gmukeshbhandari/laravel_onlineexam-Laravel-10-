@extends('admindashboard')
@section('headsectiondashboard')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('title','Admin Dashboard - Manage Questions')
@section('content')

<script>
    let add_question_route = "{{ route('admin_add_questions') }}";
</script>
<script src="{{ asset('js/custom/managequestion.js') }}"> </script>
@endsection