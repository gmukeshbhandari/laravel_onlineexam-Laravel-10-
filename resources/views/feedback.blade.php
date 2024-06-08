@extends('layouts.master')
@section('title','Feedback - Online Examination System')
@section('content')

<div class="container-fluid d-flex flex-column justify-content-center align-items-center">
    <div class="p-2 rounded" style="background-color: rgba(255, 255, 255, 0.5);width:75vw;">
        <form action="{{ route('checkingFeedback') }}" method="post" enctype="multipart/form-data">
            @include('includes.error-message')
        @csrf
            {{-- <div> --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger"> * </span> </label>
                    <input type="email" maxlength="200" value="{{ old('email') }}" class="form-control" name="email" id="email" placeholder="Enter Email" autofocus>
                </div>
                <div class="mb-3">
                    <label for="feedbacktopic" class="form-label">Topic <span class="text-danger"> * </span> </label>
                    <input type="text" maxlength="100" value="{{ old('feedbacktopic') }}" class="form-control" name="feedbacktopic" id="feedbacktopic" placeholder="What is your feedback about?">
                </div>
                <div class="mb-3">
                    <label for="feedbackdescription" class="form-label"> Description <span class="text-danger"> * </span> </label>
                    <textarea placeholder="Shortly describe your problem here" class="form-control" maxlength="10000" name="feedbackdescription" id="feedbackdescription" cols="30" rows="4">{{ old('feedbackdescription') }}</textarea>
                    <div id="feedback_description_character_counter" class="text-success"> Characters remaining: 10000 </div>
                </div>

                <!--Image-->
                <div class="mb-3">
                    <label class="form-label" for="feedbackimage"> Upload Screenshot/Photo Describing Your Problem </label>
                    <div class=" mt-2 mb-4 d-flex justify-content-center">

                    @if(session('old_feedbackimage'))
                       <!-- Display the previously uploaded image -->
                       <img id="selectedImage" class="img-fluid" src="{{ session('old_feedbackimage') }}" alt="" style="width: 300px;">
                       <input type="hidden" name="oldimage" value="{{ session('old_feedbackimage') }}">
                       <input type="hidden" name="imagepath" value="{{ session('image_path') }}">
                    @else
                        <img id="selectedImage" class="img-fluid" src="{{ asset('images/imageupload.jpg') }}" alt="" style="width: 300px;">
                    @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="feedbackimage">Choose Photo</label>
                            <input type="file"  accept=".jpg, .jpeg, .bmp, .png" class="form-control d-none" name="feedbackimage" id="feedbackimage" onchange="displaySelectedImage(event, 'selectedImage')" />
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
        </form>
    </div>
</div>
@endsection

<script src="{{ asset('js/custom/character_counter.js') }}"> </script>