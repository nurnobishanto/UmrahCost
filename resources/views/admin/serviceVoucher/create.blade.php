@extends('admin.layouts.app')
@push('title')
    Service Voucher Create
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Service Voucher Create</h5>
                <div>
                    @if (check_permission('Service Voucher List'))
                        <a href="{{ route('admin.serviceVoucher.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i>
                            Service Voucher List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.serviceVoucher.store') }}" enctype="multipart/form-data"
                        class="ams-form">
                        @csrf
                        @method('POST')
                        <div class="">

                            <div class="row mb-2">
                                <div class="col-5">
                                    <fieldset class="ams-input">
                                        <label for="client">Select Client<sup class="required">*</sup></label>
                                        <select name="client" id="client" class="form-control select2 select-search" required>
                                            <option value="">Select One</option>
                                            @foreach ($clients as $client)
                                                <option @if ($client->id == old('client')) selected @endif
                                                    value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('client')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-5">
                                    <fieldset class="ams-input">
                                        <label for="serial_no">Serial No<sup class="required">*</sup></label>
                                        <input type="text" name="serial_no" value="{{ old('serial_no') }}"
                                            class="form-control" required id="serial_no">
                                        @error('serial_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            @php
                                $companyTitles = $serviceVoucherSetting->company_title ? json_decode($serviceVoucherSetting->company_title) : [];
                                $companyNames = $serviceVoucherSetting->company_name ? json_decode($serviceVoucherSetting->company_name) : [];
                            @endphp

                            <div id="companies">
                                @foreach ($companyTitles as $key => $companyTitle)
                                    <div class="row">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_title{{ $key }}">Company Title:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $companyTitle }}" name="company_title[]"
                                                    id="company_title{{ $key }}"  placeholder="Enter Company Title"
                                                    required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_name{{ $key }}">Company Name:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $companyNames[$key] }}"
                                                    name="company_name[]" id="company_name{{ $key }}"
                                                    placeholder="Enter Company Name" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeCompany($(this))" value="{{ $key }}"
                                                type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendCompany()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Company</button>


                            <div id="guests">
                                <div class="row">
                                    <div class="col-5">
                                        <fieldset class="ams-input">
                                            <label for="guest_name0">Guest Name:<sup class="required">*</sup> </label>
                                            <input type="text" value="{{old('guest_name.0')}}" name="guest_name[]" id="guest_name0"
                                                placeholder="Enter Guest Name" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-5">
                                        <fieldset class="ams-input">
                                            <label for="passport_no0">Passport No:<sup class="required">*</sup> </label>
                                            <input type="text" value="{{old('passport_no.0')}}" name="passport_no[]" id="passport_no0"
                                                placeholder="Enter Passport No" required>
                                        </fieldset>
                                    </div>

                                    <div class="col-2 my-auto">
                                    </div>
                                    <div class="col-5">
                                        <fieldset class="ams-input input-verticle">
                                            <img src="{{ asset(get_static_option('logo') ?? 'assets/no_image.jpg') }}" id="visha_review"
                                                 alt="Preview Banner" width="150" height="150" />

                                            <label for="guest_visha">Guest Visha<sup class="required">*</sup></label>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="guest_visha[]" id="guest_visha"
                                                   onchange="document.getElementById('visha_review').src = window.URL.createObjectURL(this.files[0])">
                                            @error('guest_vish.0a')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="col-5">
                                        <fieldset class="ams-input input-verticle">
                                            <img src="{{ asset(get_static_option('logo') ?? 'assets/no_image.jpg') }}" id="passport_review"
                                                 alt="Preview Banner" width="150" height="150" />

                                            <label for="guest_passport">Guest Visha<sup class="required">*</sup></label>
                                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="guest_passport[]" id="guest_passport"
                                                   onchange="document.getElementById('passport_review').src = window.URL.createObjectURL(this.files[0])">
                                            @error('passport_review.0')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="col-2 my-auto">
                                    </div>
                                </div>
                            </div>
                            <button onclick="appendGuest()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Guest</button>

                            <div id="accommodations">

                            </div>
                            <button onclick="appendAccommodation()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Accommodation</button>


                            <div id="transport_details">

                            </div>
                            <button onclick="appendTransportDetails()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Transport Details</button>

                            @php
                                $careers = $serviceVoucherSetting->career ? json_decode($serviceVoucherSetting->career) : [];
                                $flight_nos = $serviceVoucherSetting->flight_no ? json_decode($serviceVoucherSetting->flight_no) : [];
                                $froms = $serviceVoucherSetting->from ? json_decode($serviceVoucherSetting->from) : [];
                                $tos = $serviceVoucherSetting->to ? json_decode($serviceVoucherSetting->to) : [];
                                $etds = $serviceVoucherSetting->etd ? json_decode($serviceVoucherSetting->etd) : [];
                                $etas = $serviceVoucherSetting->eta ? json_decode($serviceVoucherSetting->eta) : [];
                            @endphp
                            <div id="flight_details">
                                @foreach ($careers as $key => $career)
                                    <div class="row">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="date{{ $key }}">Date:<sup class="required">*</sup>
                                                </label>
                                                <input type="date" value="{{old('date.0')}}" name="date[]"
                                                    id="date{{ $key }}" placeholder="Enter Date" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="career{{ $key }}">Career:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $careers[$key] }}" name="career[]"
                                                    id="career{{ $key }}" placeholder="Enter Career" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="flight_no{{ $key }}">Flight No:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $flight_nos[$key] }}" name="flight_no[]"
                                                    id="flight_no{{ $key }}" placeholder="Enter Flight No"
                                                    required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="from{{ $key }}">From:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $froms[$key] }}" name="from[]"
                                                    id="from{{ $key }}" placeholder="From Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="to{{ $key }}">To:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $tos[$key] }}" name="to[]"
                                                    id="to{{ $key }}" placeholder="To Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="etd{{ $key }}">Estimated Time of Departure:<sup
                                                        class="required">*</sup> </label>
                                                <input type="time" value="{{ $etds[$key] }}" name="etd[]"
                                                    id="etd{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="eta{{ $key }}">Estimated Time of Arrival:<sup
                                                        class="required">*</sup> </label>
                                                <input type="time" value="{{ $etas[$key] }}" name="eta[]"
                                                    id="eta{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5"></div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeFlightDetail($(this))" value="{{ $key }}"
                                                type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendFlightDetail()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Flight Detail</button>

                            @php
                                $helpline_locations = $serviceVoucherSetting->helpline_location ? json_decode($serviceVoucherSetting->helpline_location) : [];
                                $helpline_numbers = $serviceVoucherSetting->helpline_number ? json_decode($serviceVoucherSetting->helpline_number) : [];
                            @endphp
                            <div id="helplines">

                                @foreach ($helpline_locations as $key => $helpline_location)
                                    <div class="row">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="helpline_location{{ $key }}">Helpline Location:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $helpline_locations[$key] }}"
                                                    name="helpline_location[]" id="helpline_location{{ $key }}"
                                                    placeholder="Enter Helpline Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="helpline_number{{ $key }}">Helpline Number:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $helpline_numbers[$key] }}"
                                                    name="helpline_number[]" id="helpline_number{{ $key }}"
                                                    placeholder="Enter Helpline Number" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeHelpline($(this))" value="{{ $key }}"
                                                type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendHelpline()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Helpline</button>


                            <div class="row">
                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="service_included">Service Included</label>
                                        <textarea name="service_included" id="service_included" cols="30" class="ckeditor" rows="2">{!! old('service_included', $serviceVoucherSetting->service_included) !!}</textarea>
                                        @error('service_included')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="service_excluded">Service Excluded</label>
                                        <textarea name="service_excluded" id="service_excluded" cols="30" class="ckeditor" rows="2">{!! old('service_excluded', $serviceVoucherSetting->service_excluded) !!}</textarea>
                                        @error('service_excluded')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="support_staf">Support Staff</label>
                                        <textarea name="support_staf" id="support_staf" cols="30" class="ckeditor" rows="2">{!! old('support_staf', $serviceVoucherSetting->support_staf) !!}</textarea>
                                        @error('support_staf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="terms_and_conditions">Terms & Condition</label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" cols="30" class="ckeditor" rows="2">{!! old('terms_and_conditions', $serviceVoucherSetting->terms_and_conditions) !!}</textarea>
                                        @error('terms_and_conditions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                        </div>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        const DELETE_SERVICE_VOUCHER_ELEMENT = "{!! route('admin.serviceVoucherSetting.delete.element', ['type', '#']) !!}";

        function appendCompany() {
            let count = 0;
            $.each($('#companies .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `<div class="row">
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="company_title${count}">Company Title:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="company_title[]" id="company_title${count}" placeholder="Enter Company Title" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="company_name${count}">Company Name:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="company_name[]" id="company_name${count}" placeholder="Enter Company Name" required>
                                </fieldset>
                            </div>
                            <div class="col-2 my-auto">
                                <button onclick="removeCompany($(this))" type="button" class="btn btn-danger" style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>`;
            $('#companies').append(html);
        }

        function removeCompany(element) {
            var count = 0;
            $.each($('#companies .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }

        function appendHelpline() {
            let count = 0;
            $.each($('#helplines .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `<div class="row">
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="helpline_location${count}">Helpline Location:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="helpline_location[]" id="helpline_location${count}" placeholder="Enter Helpline Location" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="helpline_number${count}">Helpline Number:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="helpline_number[]" id="helpline_number${count}" placeholder="Enter Helpline Number" required>
                                </fieldset>
                            </div>
                            <div class="col-2 my-auto">
                                <button onclick="removeHelpline($(this))" type="button" class="btn btn-danger" style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>`;
            $('#helplines').append(html);
        }

        function removeHelpline(element) {
            var count = 0;
            $.each($('#helplines .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }


        function appendFlightDetail() {
            let count = 0;
            $.each($('#flight_details .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `
                        <div class="row">
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="date${count}">Date:<sup class="required">*</sup> </label>
                                    <input type="date" value="" name="date[]" id="date${count}"
                                        placeholder="Enter Date" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="career${count}">Career:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="career[]" id="career${count}"
                                        placeholder="Enter Career" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="flight_no${count}">Flight No:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="flight_no[]" id="flight_no${count}"
                                        placeholder="Enter Flight No" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="from${count}">From:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="from[]" id="from${count}"
                                        placeholder="From Location" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="to${count}">To:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="to[]" id="to${count}"
                                        placeholder="To Location" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="etd${count}">Estimated Time of Departure:<sup class="required">*</sup> </label>
                                    <input type="time" value="" name="etd[]" id="etd${count}" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="eta${count}">Estimated Time of Arrival:<sup class="required">*</sup> </label>
                                    <input type="time" value="" name="eta[]" id="eta${count}" required>
                                </fieldset>
                            </div>
                            <div class="col-5"></div>
                            <div class="col-2 my-auto">
                                <button onclick="removeFlightDetail($(this))" type="button" class="btn btn-danger"
                                    style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>`;
            $('#flight_details').append(html);
        }

        function removeFlightDetail(element) {
            var count = 0;
            $.each($('#flight_details .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }


        function appendGuest() {
            let count = 0;
            $.each($('#guests .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `<div class="row">
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="guest_name${count}">Guest Name:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="guest_name[]" id="guest_name${count}" placeholder="Enter Guest Name" required>
                                </fieldset>
                            </div>
                            <div class="col-5">
                                <fieldset class="ams-input">
                                    <label for="passport_no${count}">Passport No:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="passport_no[]" id="passport_no${count}" placeholder="Enter Passport No" required>
                                </fieldset>
                            </div>
                            <div class="col-2 my-auto">
                                <button onclick="removeGuest($(this))" type="button" class="btn btn-danger" style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>`;
            $('#guests').append(html);
        }

        function removeGuest(element) {
            var count = 0;
            $.each($('#guests .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }


        function appendAccommodation() {
            let count = 0;
            $.each($('#accommodations .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `
                        <div class="row">
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="city${count}">City:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="city[]" id="city${count}"
                                        placeholder="Enter City" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="hotel${count}">Hotel:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="hotel[]" id="hotel${count}"
                                        placeholder="Enter Hotel" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="room_type${count}">Room Type:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="room_type[]" id="room_type${count}"
                                        placeholder="Enter Room Type" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="room${count}">Room:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="room[]" id="room${count}"
                                        placeholder="Enter Room" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="check_in${count}">Check-in:<sup class="required">*</sup> </label>
                                    <input type="date" value="" name="check_in[]" id="check_in${count}"
                                        placeholder="Check In Date" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="check_out${count}">Check-out:<sup class="required">*</sup> </label>
                                    <input type="date" value="" name="check_out[]" id="check_out${count}"
                                        placeholder="Check Out Date" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="night${count}">Night:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="night[]" id="night${count}"
                                        placeholder="Enter Night" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="hotel_by${count}">Hotel By:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="hotel_by[]" id="hotel_by${count}"
                                        placeholder="Enter Hotel By" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="confirm${count}">Confirm:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="confirm[]" id="confirm${count}"
                                        placeholder="Confirm" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="meals${count}">Meals:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="meals[]" id="meals${count}"
                                        placeholder="Meals" required>
                                </fieldset>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-2 my-auto">
                                <button onclick="removeAccommodation($(this))" type="button" class="btn btn-danger"
                                    style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>`;
            $('#accommodations').append(html);
        }

        function removeAccommodation(element) {
            var count = 0;
            $.each($('#accommodations .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }

        function appendTransportDetails() {
            let count = 0;
            $.each($('#transport_details .row'), function(index, val) {
                count++;
            });
            /* html */

            let html = `
                        <div class="row">
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="transport_date${count}">Date:<sup class="required">*</sup> </label>
                                    <input type="date" value="" name="transport_date[]" id="transport_date${count}"
                                        placeholder="Date" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="transport_from${count}">From:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="transport_from[]" id="transport_from${count}"
                                        placeholder="From" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="from_location${count}">From Location:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="from_location[]" id="from_location${count}"
                                        placeholder="From Location" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="transport_to${count}">To:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="transport_to[]" id="transport_to${count}"
                                        placeholder="To" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="to_location${count}">To Location:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="to_location[]" id="to_location${count}"
                                        placeholder="To Location" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="movement${count}">Movement:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="movement[]" id="movement${count}"
                                        placeholder="Movement" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="vehicle${count}">Vehicle:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="vehicle[]" id="vehicle${count}"
                                        placeholder="Vehicle" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="qty${count}">Qty:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="qty[]" id="qty${count}"
                                        placeholder="Qty" required>
                                </fieldset>
                            </div>
                            <div class="col-4">
                                <fieldset class="ams-input">
                                    <label for="transport${count}">Transport:<sup class="required">*</sup> </label>
                                    <input type="text" value="" name="transport[]" id="transport${count}"
                                        placeholder="Transport" required>
                                </fieldset>
                            </div>
                            <div class="col-10"></div>
                            <div class="col-2 my-auto">
                                <button onclick="removeTransportDetails($(this))" type="button" class="btn btn-danger"
                                    style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>`;
            $('#transport_details').append(html);
        }

        function removeTransportDetails(element) {
            var count = 0;
            $.each($('#transport_details .row'), function(index, val) {
                count++;
            });
            element.parent().parent().remove();
        }
    </script>

    <script>
        $(document).ready(function() {
            // Get references to the client select and guest name input
            var $clientSelect = $('#client');
            var $guestNameInput = $('#guest_name0');

            // Store the initial value of the guest name input
            var initialGuestName = $guestNameInput.val();

            // Listen for the change event on the client select
            $clientSelect.on('change', function() {
                // Get the selected client's name
                var selectedClientName = $clientSelect.find('option:selected').text();

                // Update the guest name input value with the selected client's name
                $guestNameInput.val(selectedClientName);
            });

            // Reset the guest name input value when the form is reset
            $('form').on('reset', function() {
                $guestNameInput.val(initialGuestName);
            });
        });
    </script>
@endpush
