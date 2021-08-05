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
                                All Articles
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('user.post.create')}}" class="btn btn-xs btn-primary float-right">
                                <i class="fe fe-plus-circle"></i> Create New Article
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
                            <form action="{{route('user.post.index')}}" method="get">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('domain'))
                                            value="{{ Request::get('domain') }}" @endif id="domain" name="domain"
                                            placeholder="Search By Article Title">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" @if(Request::get('username'))
                                            value="{{ Request::get('username') }}" @endif id="username" name="username"
                                            placeholder="Search Article By Domain">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="fe fe-sliders mr-1"></span>
                                            Filter
                                        </button>
                                        @if(Request::get('domain') || Request::get('username'))
                                        <a href="{{route('user.post.index')}}" class="btn btn-danger ml-2">
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
                                            <th scope="col">Title</th>
                                            {{-- <th scope="col">Article Link</th> --}}
                                            <th scope="col">Article Domain</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                        <tr>
                                            <th>
                                                <a href="{{$post->domain->domain}}/{{Str::slug($post->title,'-')}}" target="_blank">{{ $post->title }}</a>
                                            </th>

                                            <th><a href="{{$post->domain->domain}}" target="_blank">{{$post->domain->domain}}</a></th>
                                            
                                            <th>
                                                <a class="btn btn-sm btn-secondary edit-plan"
                                                    href="{{$post->domain->domain}}/{{Str::slug($post->title,'-')}}" target="_blank">
                                                    <span class="fe fe-eye mr-1"></span>
                                                </a>
                                                <a class="btn btn-sm btn-primary edit-plan ml-2"
                                                    href="{{route('user.post.edit', $post->post_id)}}">
                                                    <span class="fe fe-edit mr-1"></span>
                                                </a>
                                                <form action="{{route('user.post.destroy', $post->post_id)}}" method="POST"
                                                    class="form-inline" style="display: inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger ml-2 delete-user" >
                                                        <span class="fe fe-delete mr-1"></span>
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- {{ $domains->links() }} --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- / .row -->
</div>
@endsection