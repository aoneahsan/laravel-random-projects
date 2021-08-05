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
                                Edit Plan
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('admin.plans.index')}}" class="btn btn-sm btn-primary float-right">
                                <i class="fe fe-arrow-left mr-2"></i> Back to plans
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
                            <form method="post" action="{{route('admin.plan.update', $plan->id)}}">
                                {{-- CSRF Token --}}
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" name="plan_name" class="form-control" value="{{ $plan->name }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Plan Site</label>
                                    <input type="text" name="sites" class="form-control" value="{{ $plan->sites }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Plan Price</label>
                                    <input type="text" name="price" class="form-control" value="{{ $plan->price }}"
                                        required>
                                </div>


                                <button type="submit" class="btn btn-success"> <i class="fe fe-save"></i> Update
                                    Plan</button>
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