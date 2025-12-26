@section('title', 'Login')

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" wire:navigate rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                            @if (session('status'))
                                                <p class="text-success">{{ session('status') }}</p>
                                            @endif
                                        </div>
                                        <form wire:submit.prevent='loginSave'>

                                            <div class="form-group">
                                                <input type="text" wire:model='email' name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Your Email" />
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input wire:model='password' type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" />
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                                            id="exampleCheckbox1" value="remember"
                                                            wire:model='remember' />
                                                        <label class="form-check-label"
                                                            for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-danger" href="{{ route('password.email') }}"
                                                    wire:navigate>Forgot
                                                    password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button wire:loading.attr='disabled' type="submit"
                                                    class="btn btn-fill-out btn-block hover-up" name="login">
                                                    <span wire:loading.remove wire:target='loginSave'>Log in</span>

                                                    <span wire:loading wire:target='loginSave'>Processing....</span>
                                                </button>
                                            </div>

                                            <div class="form-group">
                                                <p class="text-muted">Don't have an account? <a href="#"
                                                        wire:click='showModalOrHideModal' class="signup-link"
                                                        data-bs-toggle="modal" data-bs-target="#signupModal"
                                                        data-bs-dismiss="modal">Sign
                                                        up</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6 login-image">
                                <img src="assets/imgs/login.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- <div class="form-group">
        <p class="text-muted">Don't have an account? <a href="#" class="signup-link" data-bs-toggle="modal"
                data-bs-target="#signupModal" data-bs-dismiss="modal">Sign
                up</a>
        </p>
    </div> --}}
    <div wire:ignore.self class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel"
        style="backdrop-filter: blur(20px);" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign up</h5>
                    <button wire:click='showModalOrHideModal' type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='registerSave'>
                    <div class="modal-body">
                        <!-- Continue with Google Button -->
                        <button class="google-btn mb-3">
                            <img src="https://www.google.com/favicon.ico" alt="Google Icon">
                            Continue with Google
                        </button>

                        <!-- Divider -->
                        <hr> or
                        <hr />

                        <!-- Signup Form Fields -->
                        <div class="mb-3">
                            <input type="text" wire:model.live.debounce.1000ms='name' name="name"
                                placeholder="Name">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.live.debounce.1000ms='email' name="email"
                                placeholder="Email">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.live.debounce.1000ms='mobile' name="mobile"
                                placeholder="+0000000000">
                            <p class="text-danger">{{ $errors->first('mobile') }}</p>
                        </div>
                        <div class="mb-3 input-group">
                            <input type="password" class="form-control password-input"
                                wire:model.live.debounce.1000ms='password' type="password" name="password"
                                placeholder="Password">
                            <span class="input-group-text toggle-password">
                                <i class="bi bi-eye"></i>
                            </span>

                        </div>
                        <div style="margin-top: -15px;">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>

                        <div class="mb-3 input-group" style="margin-top: 23px">
                            <input type="password" class="form-control password-input"
                                wire:model.live.debounce.1000ms='password_confirmation' type="password"
                                name="password_confirmation" placeholder="Confirm password">
                            <span class="input-group-text toggle-password">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>

                        <!-- Sign Up Button -->
                        <button class="btn btn-action"><span wire:loading.remove wire:target='registerSave'>Sign
                                up</span>
                            <span><img height="30px" width="30px"
                                    src="https://api.iconify.design/codex:loader.svg" wire:loading
                                    wire:target='registerSave'></span>
                        </button>

                        <!-- Back to Login Link -->
                        <div class="text-center mt-3">
                            <span>Already have an account? </span>
                            <a href="#" class="signup-link" data-bs-toggle="modal"
                                data-bs-target="#loginModal" wire:click='showModalOrHideModal'
                                data-bs-dismiss="modal">Log in</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Log in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Continue with Google Button -->
                    <button class="google-btn mb-3">
                        <img src="https://www.google.com/favicon.ico" alt="Google Icon">
                        Continue with Google
                    </button>

                    <!-- Divider -->
                    <div class="divider">or</div>

                    <!-- Email and Password Fields -->
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3 input-group">
                        <input type="password" class="form-control password-input" placeholder="Password" required>
                        <span class="input-group-text toggle-password">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="forgot-password">
                        <a href="#">Forgot password? Reset it</a>
                    </div>

                    <!-- Log in Button -->
                    <button class="btn btn-action">Log in</button>

                    <!-- Sign Up Link -->
                    <div class="text-center mt-3">
                        <span>Don't have an account? </span>
                        <a href="#" class="signup-link" data-bs-toggle="modal" data-bs-target="#signupModal"
                            data-bs-dismiss="modal">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <style>
        @media screen and (max-width: 600px) {
            .login-image {
                display: none;
            }

        }
    </style>


    <script>
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    </script>
</div>
