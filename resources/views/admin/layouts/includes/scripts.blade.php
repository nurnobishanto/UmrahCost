<!-- Start JS -->
<script src="{{ asset('assets/backend/js/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('assets/backend/js/popper.min.js') }}"></script> --}}
<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>

{{-- ajax datatable  --}}
<script src="{{ asset('assets/backend/js/ajax-datatables-cdn.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/apexchart.js') }}"></script>

@stack('chart_script')

<script src="{{ asset('assets/backend/js/toaster.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/sweetalert.min.js') }}"></script>
{!! Toastr::message() !!}
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<audio id="audiotag1" src="{{ asset('assets/sounds/sound-1.mp3') }}" preload="auto"></audio>

@stack('script')
<script src="{{ asset('assets/backend/js/main.js') }}"></script>
@stack('helper_script')

<script src="{{ asset('assets/helper.js') }}"></script>
<script>
    $(document).ready(function() {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        var channel = pusher.subscribe('requisition-create-channel');
        channel.bind('requisition-create-event', function(response) {
            if (response.user_id == {{ auth()->user()->id }}) {
                document.getElementById('audiotag1').muted = false;
                document.getElementById('audiotag1').play();
                let oldContent = parseInt($('#notification-count').attr('data-content'));
                $('#notification-count').attr('data-content', oldContent + 1);
                swal(response.message, {
                    icon: "success",
                });
            }
        });
    });
</script>
