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
                                Add New Domain
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
                            <form method="post" action="{{route('user.domain.update', $domain->id)}}">
                                {{-- CSRF Token --}}
                                @csrf

                                <div class="form-group">
                                    <label>Domain/site-link</label>
                                    <input type="text" name="domain_name" class="form-control" placeholder="https://example.com"
                                        value="{{ $domain->domain }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{ $domain->username }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" value="{{ $domain->password }}" class="form-control" required>
                                </div>

                                <div class="alert alert-secondary" role="alert">
                                    <i class="fe fe-info"></i> &nbsp;
                                    A valid domain name will have protocol either 'http' or 'https' as well, an example will be: 'https://test.com' without any trailing slash.
                                </div>


                                <button type="submit" class="btn btn-success"> <i class="fe fe-save"></i> Update
                                    Domain</button>
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