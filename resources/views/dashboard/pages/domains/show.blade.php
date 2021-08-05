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
                                Domain Detail Page
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('user.domain.index')}}" class="btn btn-sm btn-primary float-right">
                                <i class="fe fe-arrow-left mr-2"></i> Back to domains
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
                            <h2>Domain Information</h2>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Domain</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $domain->domain}}</th>
                                            <th scope="row">{{ $domain->username}}</th>
                                            <th scope="row">{{ $domain->password}} </th>
                                            <td>
                                                <a class="btn btn-sm btn-primary edit-user"
                                                    href="{{route('user.domain.edit', $domain->id)}}">
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
            </div>
        </div>
    </div> <!-- / .row -->
</div>
@endsection