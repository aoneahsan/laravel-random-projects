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
                                All Plans
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('admin.plan.create')}}" class="btn btn-xs btn-primary float-right">
                                <i class="fe fe-plus-circle"></i> Add New Plan
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
                            <form action="{{route('admin.plans.index')}}" method="get">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('plan_name'))
                                            value="{{ Request::get('plan_name') }}" @endif id="plan_name" name="plan_name"
                                            placeholder="Search By Plan Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('sites'))
                                            value="{{ Request::get('sites') }}" @endif id="sites" name="sites"
                                            placeholder="Search By Plan Site">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="fe fe-sliders mr-1"></span>
                                            Filter
                                        </button>
                                        @if(Request::get('plan_name') || Request::get('sites'))
                                        <a href="{{route('admin.plans.index')}}" class="btn btn-danger ml-2">
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
                                            <th scope="col">Site</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($plans as $plan)
                                        <tr>
                                            <th scope="row">{{ $plan->name}}</th>
                                            <td>{{ $plan->sites}}</td>
                                            <td>{{$plan->price}}</td>
 
                                            <td>
                                                <a class="btn btn-sm btn-secondary edit-plan"
                                                    href="{{route('admin.plan.show', $plan->id)}}">
                                                    <span class="fe fe-eye mr-1"></span>
                                                </a>
                                                <a class="btn btn-sm btn-primary edit-plan ml-2"
                                                    href="{{route('admin.plan.edit', $plan->id)}}">
                                                    <span class="fe fe-edit mr-1"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $plans->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
@endsection