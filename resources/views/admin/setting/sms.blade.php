@extends('admin.layouts.app')
@push('title')
    Information
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  Information -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">SMS Setting</h5>
                <div>
                    {{-- <a href="#" class="btn add-btn"><i class="fas fa-list-ul"></i> Holiday List</a> --}}
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.setting.smsUpdate') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        <fieldset class="ams-input input-verticle">
                            <label for="bulksmsbd_sender_id">Bulk SMS BD Sender ID<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_static_option('bulksmsbd_sender_id') }}" name="bulksmsbd_sender_id"
                                id="bulksmsbd_sender_id" placeholder="Enter Bulk SMS BD Sender ID">
                            @error('bulksmsbd_sender_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="bulksmsbd_api">Bulk SMS BD API<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_static_option('bulksmsbd_api') }}" name="bulksmsbd_api"
                                   id="bulksmsbd_api" placeholder="Enter Bulk SMS BD APO">
                            @error('bulksmsbd_api')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="get_balance_bulksmsbd">Bulk SMS BD Balance<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_balance_bulksmsbd() }}" name="get_balance_bulksmsbd"
                                   id="get_balance_bulksmsbd" readonly>
                        </fieldset>
                        <pre class="bg-dark text-light p-2" style="font-size: 18px">bulksmsbd_sms_send(number,msg)</pre>


                        <fieldset class="text-end">
                            <button type="submit" class="submit-btn btn"><i class="far fa-save"></i> Save</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endpush
