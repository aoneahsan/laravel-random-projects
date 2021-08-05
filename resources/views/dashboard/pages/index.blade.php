@extends('dashboard.layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h1 class="header-title">
                                Account Information
                            </h1>

                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('email_exists'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                {{ session('email_exists') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('message'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('email_updated'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success">
                                {{ session('email_updated') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (session('password_updated'))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success">
                                {{ session('password_updated') }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Current Plan Name
                                    </h6>
                                    <!-- Heading -->
                                    <span class="h2 mb-0 text-capitalize">
                                        {{$plan->name}} </span>

                                </div>
                                <div class="col-auto">

                                    <!-- Icon -->
                                    <div class="mt-3">

                                        @if($plan->name === "pro")
                                        <a href="https://www.jvzoo.com/b/94627/348617/1" target="new"
                                            class="btn btn-sm btn-success change-plan" data-plan-id="3">Upgrade to
                                            Unlimited</a>
                                        @endif

                                    </div>

                                </div>
                            </div> <!-- / .row -->

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Your License
                                    </h6>

                                </div>
                                <div class="col-auto">

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        Up to {{ $plan->sites}} </span>

                                </div>
                            </div> <!-- / .row -->

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Your Domains
                                    </h6>

                                </div>
                                <div class="col-auto">

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{-- {{ $total_domains }} of {{$allowed_sites}} --}}
                                    </span>

                                </div>
                            </div> <!-- / .row -->

                        </div>
                    </div>

                </div>
            </div>
            <form method="post" action="{{route('user.email.update')}}">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12">
                        <!-- Email address -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="mb-1">
                                Email address
                            </label>
                            <!-- Input -->
                            <input name="email" type="email" class="form-control" value="{{ auth()->user()->email}}">
                        </div>
                    </div>
                </div> <!-- / .row -->

                <!-- Button -->
                <button type="submit" class="btn btn-primary">
                    <i class="fe fe-save"></i>
                    Update Email
                </button>

                <!-- Divider -->
                <hr class="my-5">

            </form>

        </div>
    </div> <!-- / .row -->

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-12 col-xl-10">

            <!-- Heading -->
            <h2 class="mb-2">
                Change your password
            </h2>

            <!-- Text -->
            <p class="text-muted mb-xl-0">
                We will email you a confirmation when changing your password, so please expect that email after
                submitting.
            </p>

        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-12 col-xl-10">

            <div class="row">
                <div class="col-12 col-md-6 order-md-2">

                    <!-- Card -->
                    <div class="card bg-light border ml-md-4">
                        <div class="card-body">

                            <!-- Text -->
                            <p class="mb-2">
                                Password requirements
                            </p>

                            <!-- Text -->
                            <p class="small text-muted mb-2">
                                To create a new password, you have to meet all of the following requirements:
                            </p>

                            <!-- List group -->
                            <ul class="small text-muted pl-4 mb-0">
                                <li>
                                    Minimum 8 character
                                </li>

                                <li>
                                    Can’t be the same as a previous password
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6">

                    <!-- Form -->
                    <form method="post" action="{{route('user.password.update')}}">
                        @csrf
                        <!-- Password -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                Current password
                            </label>

                            <!-- Input -->
                            <input name="old_password" type="password" class="form-control">

                        </div>

                        <!-- New password -->
                        <div class="form-group">

                            <!-- Label -->
                            <label>
                                New password
                            </label>

                            <!-- Input -->
                            <input name="new_password" type="password" class="form-control">

                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary lift" type="submit">
                            <i class="fe fe-save"></i>
                            Update password
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- Divider -->
    <hr class="my-5">

</div>
@endsection