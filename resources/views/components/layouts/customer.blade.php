<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS for Design -->

    @stack('styles')
    @livewireStyles
</head>

<body>
    {{-- <div class="loader" id="loader">
        <div class="spinner">
            <img src="{{ \App\Models\Setting::where('key', 'site_logo')->value('value') ? asset('storage/' . \App\Models\Setting::where('key', 'site_logo')->value('value')) : asset('assets/imgs/logo/Screenshot_3-removebg-preview.png') }}" alt="logo">
        </div>
    </div> --}}

    <main>
        {{ $slot }}
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar.style.width === '250px') {
                sidebar.style.width = '70px';
                mainContent.style.marginLeft = '70px';
            } else {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '250px';
            }
        }
    </script>

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
    @stack('scripts')
    @livewireScripts
</body>

</html>
