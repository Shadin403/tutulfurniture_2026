@section('title', 'Reset Password')

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" wire:navigate rel="nofollow">Home</a>
                    <span></span> reset-password
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
                                            <h3 class="mb-30">Reset Password</h3>

                                            @if (session('status'))
                                                <p class="alert alert-success">{{ session('status') }}</p>
                                            @endif
                                        </div>
                                        <form wire:submit.prevent='resetPassword'>

                                            <div class="form-group">
                                                <input type="text" wire:model='email' name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Your Email" />
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" wire:model='password' name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Your Password" />
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" wire:model='password_confirmation'
                                                    name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Confirm Password" />
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button wire:loading.attr='disabled' type="submit"
                                                    class="btn btn-fill-out btn-block hover-up" name="login">
                                                    <span wire:loading.remove wire:target='sentResetLink'> Reset
                                                        Paasword </span>

                                                    <span wire:loading wire:target='sentResetLink'>
                                                        Processing....</span>
                                                </button>

                                            </div>

                                            <div class="form-group">
                                                <p class="text-muted">Back To Login <a href="{{ route('login') }}"
                                                        wire:navigate class="signup-link" ">Log in</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-1"></div>
                            <div class="col-lg-6 login-image">
                                <img src="assets/imgs/login.png" />
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


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
