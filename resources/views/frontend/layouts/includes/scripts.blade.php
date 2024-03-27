<script src="{{ asset('assets/frontend/js/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/fancybox.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/frontend/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/inTelInput.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/custom-dropdown.js') }}"></script>
<script src="{{ asset('assets/frontend/js/multi-select.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.21.1/jquery.daterangepicker.min.js"></script>
<script src="{{ asset('assets/helper.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{!! Toastr::message() !!}


@stack('script')
<script>
    $(document).ready(function() {
        $('.select-search').select2({
            theme: "classic"
        });
    });
</script>
@if (session()->has('warning'))
    <script type="text/javascript">
        $(document).ready(function() {
            var errorMessage = '{{ Session::get('warning') }}';
            swal(errorMessage, {
                icon: "warning",
            });
        });
    </script>
@endif
