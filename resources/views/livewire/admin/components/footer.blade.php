<div>
    <!-- JavaScript Libraries -->
    @push('scripts')
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
        <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
        <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
        <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('admin/js/main.js') }}"></script>

        <script>
            document.addEventListener("livewire:load", () => {
                document.querySelectorAll(".dropdown-toggle").forEach((dropdown) => {
                    console.log(dropdown);
                });
            });
        </script>
    @endpush



    @push('scripts')
    @endpush


</div>
