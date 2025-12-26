<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons@1.4.1/font/bootstrap-icons.css">


    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ asset('build/assets/app-D7vUusv7.css') }}" as="style" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vite for Laravel Assets -->

    <!-- Quill -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @livewireStyles
</head>

<body>
    <div class="container">
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '{{ $error }}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>
    <div class="p-0 bg-white container-fluid position-relative d-flex">
        <!-- Spinner Start -->
        <div id="spinner"
            class="bg-white show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @livewire('admin.components.sideNavigation')

        <!-- Content Start -->
        <div class="content">
            @livewire('admin.components.navigation')
            {{ $slot }}
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @livewire('admin.components.footer')

    @stack('scripts')

    @livewireScripts




</body>

</html>
