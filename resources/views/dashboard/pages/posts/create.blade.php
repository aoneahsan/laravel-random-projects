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
                                Create New Article
                            </h1>
                        </div>
                        <div class="col-6">
                            <a href="{{route('user.post.index')}}" class="btn btn-sm btn-primary float-right">
                                <i class="fe fe-arrow-left mr-2"></i> Back to articles
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
                            <form method="post" action="{{route('user.post.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Domain/site-link</label>
                                    <select class="form-control" name="domain" id="exampleFormControlSelect1" required>
                                      <option value="">Choose Domain</option>
                                        @foreach ($domains as $domain)
                                        <option value="{{$domain->id}}">{{$domain->domain}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Post</label>
                                    <textarea name="content" id="content" cols="30" class="form-control" required></textarea>
                                </div>


                                <button type="submit" class="btn btn-success"> <i class="fe fe-save"></i> Submit </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- http://localhost/dms/public/post/image/upload?_token=cRx2Syrz8u9QAJ4HNU8Q6rwiwcwJ1xUEcWFLvMAl&CKEditor=content&CKEditorFuncNum=1&langCode=en --}}
</div> <!-- / .row -->
</div>
@endsection
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

@section('scripts')
    <script>
        CKEDITOR.replace('content', {
            height: 500,
            filebrowserUploadUrl: "{{route('user.post.image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>
@endsection