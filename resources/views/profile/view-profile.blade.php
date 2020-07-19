@extends('layouts.layout')
@section('title', "Profile")
@section('content')
<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <div class="row">

            @include('layouts.partials.sidebar')

            <!-- Middle Panel
        ============================================= -->
            <div class="col-lg-9">

                <!-- Personal Details
          ============================================= -->
                <div class="bg-light shadow-sm rounded p-4 mb-4">
                    <h3 class="text-5 font-weight-400 mb-3">Personal Details</h3>
                    <div class="row">
                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                        <p class="col-sm-9">{{ $user->first_name." ".$user->last_name }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                        <p class="col-sm-9">{{ $user->dob }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
                        <p class="col-sm-9">{{ $user->address }}</p>
                    </div>
                </div>

                <!-- Personal Details End -->

                <div class="bg-light shadow-sm rounded p-4 mb-4">
                    <h3 class="text-5 font-weight-400 mb-3">Contact Information</h3>
                    <div class="row">
                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email Address</p>
                        <p class="col-sm-9">{{ $user->email }}</p>
                    </div>
                    <div class="row">
                        <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Phone</p>
                        <p class="col-sm-9">{{ $user->phone }}</p>
                    </div>

                </div>
                <!-- Email Addresses End -->

            </div>
            <!-- Middle Panel End -->

        </div>
    </div>
</div>
<!-- Content end -->

@include('layouts.partials.footer')

</div>
<!-- Document Wrapper end -->

<!-- Back to Top
============================================= -->

@endsection
