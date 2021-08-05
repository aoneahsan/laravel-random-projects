@extends('dashboard.layout')

@section('content')
<div class="container-fluid admin-pages">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-12">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <!-- Title -->
                            <h1 class="header-title">
                                All Users
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('admin.user.create')}}" class="btn btn-xs btn-primary float-right">
                                <i class="fe fe-plus-circle"></i> Add New User
                            </a>


                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 div_alert">
                    @include('dashboard.admin.parts.alerts')
                </div>

                <div class="col-12 ">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.users.index')}}" method="get">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('user_name'))
                                            value="{{ Request::get('user_name') }}" @endif id="name" name="user_name"
                                            placeholder="Search By User Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('user_email'))
                                            value="{{ Request::get('user_email') }}" @endif id="email" name="user_email"
                                            placeholder="Search By User Email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="fe fe-sliders mr-1"></span>
                                            Filter
                                        </button>
                                        @if(Request::get('user_name') || Request::get('user_email'))
                                        <a href="{{route('admin.users.index')}}" class="btn btn-danger ml-2">
                                            <span class="fe fe-delete mr-1"></span> Clear
                                        </a>
                                        @endif
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->name}}</th>
                                            <td>{{ $user->email}}</td>
                                            <td>
                                                @if($user->status === "active")
                                                <span class="badge badge-success dispaly-2">active</span>
                                                @else
                                                <span class="badge badge-danger">disabled</span>
                                                @endif

                                            </td>
                                            <td>{{ \App\Models\Plan::get_user_plan_by_id($user->id)->name}}
                                                ({{ \App\Models\Plan::get_user_plan_by_id($user->id)->sites}})
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-secondary edit-user"
                                                    href="{{route('admin.user.show', $user->id)}}">
                                                    <span class="fe fe-eye mr-1"></span>
                                                </a>
                                                <a class="btn btn-sm btn-primary edit-user ml-2"
                                                    href="{{route('admin.user.edit', $user->id)}}">
                                                    <span class="fe fe-edit mr-1"></span>
                                                </a>
                                                @if($user->status === "active")
                                                <a class="btn btn-sm btn-warning disable-user ml-2"
                                                    href="/admin/user/{{ $user->id}}/disable">
                                                    <span class="fe fe-edit mr-1"></span> Disable
                                                </a>
                                                @else
                                                <a class="btn btn-sm btn-success enable-user ml-2"
                                                    href="/admin/user/{{ $user->id}}/enable">
                                                    <span class="fe fe-edit mr-1"></span> Enable
                                                </a>
                                                @endif
                                                <form action="{{route('admin.user.destroy', $user->id)}}" method="POST"
                                                    class="form-inline" style="display: inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger ml-2 delete-user" >
                                                        <span class="fe fe-delete mr-1"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $users->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
@endsection