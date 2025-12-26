@section('title', 'Register')

<div>
    {{-- <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" wire:navigate style="color: #6E6E6E">Home</a><span
                        style="color: #F15412">Register</span>
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
                                        <form wire:submit.prevent='register'>
                                            <div class="form-group">
                                                <input type="text" wire:model='name' name="name"
                                                    placeholder="Name">
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" wire:model='email' name="email"
                                                    placeholder="Email">
                                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" wire:model='mobile' name="mobile"
                                                    placeholder="+0000000000">
                                                <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input wire:model='password' type="password" name="password"
                                                    placeholder="Password">
                                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input wire:model='password_confirmation' type="password"
                                                    name="password_confirmation" placeholder="Confirm password">
                                            </div>
                                            comment kora lagbe ei div
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                                            id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I
                                                                agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="privacy-policy.html"><i
                                                        class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                    name="register">Submit &amp; Register</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">Already have an account? <a
                                                href="{{ route('login') }}" wire:navigate>Login</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main> --}}



</div>
