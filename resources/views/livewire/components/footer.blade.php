<div>
    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            {{-- <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email" src="{{ ("assets/imgs/theme/icons/icon-email.svg") }}" alt="" />
                                <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">
                                    ...and receive
                                    <strong>$25 coupon for first shopping.</strong>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small"
                                placeholder="Enter your email" />
                            <button class="btn bg-dark text-white" type="submit">
                                Subscribe
                            </button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div> --}}
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="{{ route('home') }}" wire:navigate><img
                                        src="{{ \App\Models\Setting::where('key', 'site_logo')->value('value') ? asset('storage/' . \App\Models\Setting::where('key', 'site_logo')->value('value')) : asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}"
                                        alt="logo" /></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">
                                Contact
                            </h5>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>
                                <span class="text-info">Tutul Furniture, In Front of Haji Jalmamud Degree College
                                    Gate,
                                    Chandrakona Road, Nakla, Sherpur, Bangladesh.</span>
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>
                                <a href="tel:+8801718700510">+88 017 187 005 10</a>
                            </p>

                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>
                                <a href="mailto:tutulmian1995@gmail.com">tutulmian1995@gmail.com</a>
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">
                                Follow Us
                            </h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg"
                                        alt="" /></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg"
                                        alt="" /></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg"
                                        alt="" /></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg"
                                        alt="" /></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg"
                                        alt="" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">About</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">My Account</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="my-account.html">My Account</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Order</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Install App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">
                                    From App Store or Google Play
                                </p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                            src="
                                            {{ asset('assets/imgs/theme/app-store.jpg') }}"
                                            alt="" /></a>
                                    <a href="#" class="hover-up"><img
                                            src="{{ asset('assets/imgs/theme/google-play.jpg') }}" alt="" /></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">
                                    Secured Payment Gateways
                                </p>
                                <img class="wow fadeIn animated"
                                    src="{{ asset('assets\imgs\icon\payments-method.png') }}" alt="payments-method" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="privacy-policy.html">Privacy Policy</a> |
                        <a href="terms-conditions.html">Terms & Conditions</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        &copy; <strong class="text-brand">Developer:</strong> <a
                            href="https://www.facebook.com/developershadin">
                            Shadin Sharkar</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>

    <!-- Template JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>

    {{-- <script>
        function reloadAllJsFiles() {
            console.log("🔄 Reloading JS Files...");

            let scripts = [
                "assets/js/vendor/modernizr-3.6.0.min.js",
                "assets/js/vendor/jquery-3.6.0.min.js",
                "assets/js/vendor/jquery-migrate-3.3.0.min.js",
                "assets/js/vendor/bootstrap.bundle.min.js",
                "assets/js/plugins/slick.js",
                "assets/js/plugins/jquery.syotimer.min.js",
                "assets/js/plugins/wow.js",
                "assets/js/plugins/jquery-ui.js",
                "assets/js/plugins/perfect-scrollbar.js",
                "assets/js/plugins/magnific-popup.js",
                "assets/js/plugins/select2.min.js",
                "assets/js/plugins/waypoints.js",
                "assets/js/plugins/counterup.js",
                "assets/js/plugins/jquery.countdown.min.js",
                "assets/js/plugins/images-loaded.js",
                "assets/js/plugins/isotope.js",
                "assets/js/plugins/scrollup.js",
                "assets/js/plugins/jquery.vticker-min.js",
                "assets/js/plugins/jquery.theia.sticky.js",
                "assets/js/plugins/jquery.elevatezoom.js",
                "assets/js/main.js?v=3.3",
                "assets/js/shop.js?v=3.3"
            ];

            scripts.forEach(filePath => {
                let oldScript = document.querySelector(`script[src="${filePath}"]`);
                if (oldScript) oldScript.remove();

                let script = document.createElement("script");
                script.src = `/${filePath}`;
                script.type = "text/javascript";
                script.defer = true;
                document.body.appendChild(script);
            });

            console.log("✅ JS Files Reloaded!");
        }
    </script> --}}
