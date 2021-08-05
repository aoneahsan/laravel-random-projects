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
                    Sign in
                </h1>

                <!-- Subheading -->
                <p class="text-muted text-center mb-5">
                    Login into PR Rage DMS!
                </p>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email address -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>Email Address</label>

                        <!-- Input -->
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                            <div class="col-auto">

                                <!-- Help text -->
                                @if (Route::has('password.request'))
                                <a class="form-text small text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                                @endif

                            </div>
                        </div> <!-- / .row -->

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-lg btn-block btn-primary mb-3">
                        Sign in
                    </button>

                    <!-- Link -->
                    <div class="text-center">
                        <small class="text-muted text-center">
                            Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
                        </small>
                    </div>

                </form>

            </div>
        </div> <!-- / .row -->
    </div>
</div>
@include('dashboard.footer')