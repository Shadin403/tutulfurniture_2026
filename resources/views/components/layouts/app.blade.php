<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tutul Furniture - @yield('title') </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ $description ?? 'Tutul Furniture' }}">
    <meta name="title" content="{{ $meta_title ?? 'Tutul Furniture' }}">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">




    <style>
        body {
            font-family: "Nunito Sans", sans-serif !important;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 250px;
            height: 250px;
            margin-top: 10%
        }

        @media screen and (max-width: 1024px) {
            #scrollUp {
                bottom: 80px
            }
        }
    </style>
    {{-- @vite('resources/js/app.js') --}}
    @stack('styles')
    @livewireStyles
</head>

<body>
    {{-- @dump(session()->get('success')) --}}

    <div class="loader" id="loader">
        <div class="spinner">
            <img src="{{ asset('assets\imgs\logo\Screenshot_3-removebg-preview.png') }}" alt="">
        </div>
    </div>


    @if (session('logout-success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('logout-success') }}',
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    @endif




    <div id="app">
        @livewire('components.navigation')
        <main>
            {{ $slot }}
        </main>
        @livewire('components.footer')
    </div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Declare Toast once globally
        window.Toast = window.Toast || Swal.mixin({
            toast: true,
            position: 'center',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        document.addEventListener('livewire:navigated', function() {
            // Success popup
            Livewire.on('success', message => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message,
                    showConfirmButton: false,
                    timer: 2500
                });
            });
            // Error popup
            Livewire.on('error', message => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                    showConfirmButton: false,
                    timer: 2500
                });
            });

            // Alert toasts
            Livewire.on('alert-success', message => {
                Toast.fire({
                    icon: 'success',
                    title: message,
                    position: "bottom-end",
                    showCloseButton: true,
                    timer: 2500,
                });
            });

            Livewire.on('alert-error', message => {
                Toast.fire({
                    icon: 'error',
                    title: message,
                    position: "bottom-end",
                    showCloseButton: true,
                    timer: 2500,
                });
            });

            Livewire.on('alert-warning', message => {
                Toast.fire({
                    icon: 'warning',
                    title: message,
                    position: "bottom-end",
                    showCloseButton: true,
                    timer: 2500,
                });
            });
        });

        // Loader during Livewire navigation
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("livewire:navigating", function() {
                document.getElementById("loader").style.display = "flex";
                console.log("Navigating");
            });

            window.addEventListener("livewire:navigated", function() {
                document.getElementById("loader").style.display = "none";
                console.log("Navigated");
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
