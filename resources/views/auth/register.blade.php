@include('dashboard.header')

<div class="d-flex align-items-center border-top border-top-2 border-primary" style="padding-top: 100px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

                <!-- Image -->
                <div class="text-center">
                    <img src="{{ asset('img/illustrations/happiness.svg') }}" alt="..." class="img-fluid">
                </div>

            </div>
            <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">

                <!-- Heading -->
                <h1 class="display-4 text-center mb-3">
                    Sign Up
                </h1>

                <!-- Subheading -->
                <p class="text-muted text-center mb-5">
                    Register for PR Rage DMS!
                </p>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf


                    <!-- Name -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>Your Name</label>

                        <!-- Input -->
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <!-- Email address -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>Email Address</label>

                        <!-- Input -->
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <div class="row">
                            <div class="col">
                                <!-- Label -->
                                <label>Password</label>
                            </div>
                        </div> <!-- / .row -->

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">

                        <div class="row">
                            <div class="col">
                                <!-- Label -->
                                <label>Confirm Password</label>
                            </div>
                        </div> <!-- / .row -->

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">

                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-3">
                        Register
                    </button>

                    <!-- Link -->
                    <div class="text-center">
                        <small class="text-muted text-center">
                            Already have an account? <a href="{{ route('login') }}">Login</a>.
                        </small>
                    </div>

                </form>

            </div>
        </div> <!-- / .row -->
    </div>
</div>
@include('dashboard.footer')