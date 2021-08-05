@if(Auth::user()->status == 'active')

<script>
window.location = "/home";
</script>

@endif
@include('dashboard.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">

            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-6">

                            <!-- Title -->
                            <h1 class="header-title text-danger">
                                Oops! Your account has been blocked!
                            </h1>

                        </div>
                        <div class="col-6">
                            <a href="http://umo.zendesk.com" class="btn btn-primary float-right">
                                <i class="fe fe-phone"></i> Conact Support
                            </a>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

        </div>
    </div> <!-- / .row -->
</div>
@include('dashboard.footer')