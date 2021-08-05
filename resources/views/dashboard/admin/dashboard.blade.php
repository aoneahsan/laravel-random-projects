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
                                Admin Dashboard
                            </h1>

                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl">

                    <!-- Value  -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Total Users
                                    </h6>

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{-- {{ \App\User::userCount()}} --}}
                                    </span>

                                    <!-- Badge -->
                                    <span class="badge badge-soft-success mt-n1">
                                        <span class="fe fe-trending-up"></span>
                                    </span>
                                </div>
                                <div class="col-auto">

                                    <!-- Icon -->
                                    <span class="h2 fe fe-users text-muted mb-0"></span>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-6 col-xl">

                    <!-- Hours -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Total Domains
                                    </h6>

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{-- {{ \App\Domain::domainsCount()}} --}}
                                    </span>

                                </div>
                                <div class="col-auto">

                                    <!-- Icon -->
                                    <span class="h2 fe fe-aperture text-muted mb-0"></span>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-6 col-xl">

                    <!-- Exit -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Total Templates
                                    </h6>

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{-- {{ \App\Template::templateCount()}} --}}
                                    </span>

                                </div>
                                <div class="col-auto">

                                    <!-- Icon -->
                                    <span class="h2 fe fe-grid text-muted mb-0"></span>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-6 col-xl">

                    <!-- Time -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Total Shortcodes
                                    </h6>

                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{-- {{ \App\Template::shortcodeCount()}} --}}
                                    </span>

                                </div>
                                <div class="col-auto">

                                    <!-- Icon -->
                                    <span class="h2 fe fe-code text-muted mb-0"></span>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div> <!-- / .row -->

</div>
@endsection