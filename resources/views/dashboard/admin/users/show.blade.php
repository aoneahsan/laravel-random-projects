@extends('dashboard.layout')

@section('content')
<div class="container-fluid admin-pages">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <!-- Title -->
                            <h1 class="header-title">
                                User Detail Page
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
                            <h2>Personal Information</h2>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Membership Plan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $user->name}}</th>
                                            <th scope="row">{{ $user->email}}</th>
                                            <th scope="row">{{ $plan->name}} ({{$plan->sites}})</th>
                                            <td>
                                                @if($user->status === "active")
                                                <span class="badge badge-success dispaly-2">active</span>
                                                @else
                                                <span class="badge badge-danger">disabled</span>
                                                @endif

                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary edit-user"
                                                    href="{{route('admin.user.edit', $user->id)}}">
                                                    <span class="fe fe-edit mr-1"></span> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h2>User Domains ({{count($domains)}})</h2>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Date - Time</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($domains as $dom)
                                        <tr>
                                            <th scope="row">{{ $dom->id}}</th>
                                            <th scope="row">{{ $dom->created_at}}</th>
                                            <th scope="row">{{ $dom->title}}</th>
                                            <th scope="row">{{ $dom->slug}}</th>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
@endsection