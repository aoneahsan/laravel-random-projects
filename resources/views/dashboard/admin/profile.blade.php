@extends('dashboard.layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <!-- Title -->
                            <h1 class="header-title">
                                Admin Profile
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="/admin/users" class="btn btn-sm btn-primary float-right">
                                <i class="fe fe-arrow-left mr-2"></i> Back to users
                            </a>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 div_alert">
                    @include('dashboard.admin.parts.alerts')
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/admin/profile/update">
                                {{-- CSRF Token --}}
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Your Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Your Password</label>
                                    <input type="password" name="password" class="form-control" value="">
                                </div>


                                <button type="submit" class="btn btn-success"> <i class="fe fe-save"></i> Update
                                    Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- / .row -->
</div>
@endsection