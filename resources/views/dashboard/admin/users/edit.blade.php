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
                                Edit User
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-primary float-right">
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
                            <form method="post" action="{{route('admin.user.update', $user->id)}}">
                                {{-- CSRF Token --}}
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>User Membership Plan</label>
                                    <select class="custom-select" name="plan_id" value="" required>
                                        <option value="">Choose a plan</option>
                                        @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}"
                                            {{ ($plan->id === $user_plan->id) ? 'selected' : ''}}>{{ $plan->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Purchased Templates Status</label>
                                    <select class="custom-select" name="purchased_templates" value="" required>
                                        <option value="1" {{ ($user->purchased_templates) ? 'selected' : ''}}> Active
                                            Templates
                                        </option>
                                        <option value="0" {{ (!$user->purchased_templates) ? 'selected' : ''}}> Disabled
                                            Templates
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>User Password</label>
                                    <input type="password" name="password" class="form-control" value="">
                                </div>


                                <button type="submit" class="btn btn-success"> <i class="fe fe-save"></i> Update
                                    User</button>
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