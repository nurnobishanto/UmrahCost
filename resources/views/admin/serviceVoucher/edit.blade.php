@extends('admin.layouts.app')
@push('title')
    Service Voucher Edit
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Service Voucher Edit</h5>
                <div>
                    @if (check_permission('Service Voucher List'))
                        <a href="{{ route('admin.serviceVoucher.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i>
                            Service Voucher List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.serviceVoucher.update', $serviceVoucher->id) }}" enctype="multipart/form-data"
                        class="ams-form">
                        @csrf
                        @method('PATCH')
                        <div class="">

                            <div class="row mb-2">
                                <div class="col-5">
                                    <fieldset class="ams-input">
                                        <label for="client">Select Client<sup class="required">*</sup></label>
                                        <select name="client" id="client" class="form-control select2" required>
                                            <option value="">Select One</option>
                                            @foreach ($clients as $client)
                                                <option @if ($client->id == old('client', $serviceVoucher->client_id)) selected @endif
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
                                        <input type="text" name="serial_no" value="{{ old('serial_no', $serviceVoucher->serial_no) }}" class="form-control" required id="serial_no" >
                                        @error('serial_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div id="companies">
                                @foreach ($serviceVoucher->voucherCompanies as $key => $company)
                                    <div class="row">
                                        <input type="hidden" value="{{ $company->id }}" name="company_ids[]">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_title{{ $key }}">Company Title:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $company->company_title }}" name="company_title[]"
                                                    id="company_title{{ $key }}" placeholder="Enter Company Title"
                                                    required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_name{{ $key }}">Company Name:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $company->company_title }}"
                                                    name="company_name[]" id="company_name{{ $key }}"
                                                    placeholder="Enter Company Name" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldCompany($(this))" value="{{ $company->id }}"
                                                type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendCompany()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Company</button>


                            <div id="guests">
                                @foreach ($serviceVoucher->voucherGuests as $key => $voucherGuest)
                                    <div class="row">
                                        <input type="hidden" value="{{ $voucherGuest->id }}" name="guest_ids[]">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="guest_name{{ $key }}">Guest Name:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherGuest->name }}" name="guest_name[]"
                                                    id="guest_name{{ $key }}" placeholder="Enter Guest Name" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="passport_no{{ $key }}">Passport No:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherGuest->passport_no }}" name="passport_no[]"
                                                    id="passport_no{{ $key }}" placeholder="Enter Passport No" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            @if($key != 0)
                                                <button onclick="removeOldGuest($(this))" value="{{ $voucherGuest->id }}" type="button" class="btn btn-danger"
                                                    style="margin-top: 0; margin-bottom:5px;"><i class="fa fa-trash"></i>
                                                    Remove</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendGuest()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Guest</button>

                            <div id="accommodations">
                                @foreach ($serviceVoucher->voucherAccommodations as $key => $voucherAccommodation)
                                    <div class="row">
                                        <input type="hidden" value="{{ $voucherAccommodation->id }}" name="accommodation_ids[]">
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="city{{ $key }}">City:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherAccommodation->city }}" name="city[]" id="city{{ $key }}"
                                                    placeholder="Enter City" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="hotel{{ $key }}">Hotel:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherAccommodation->hotel }}" name="hotel[]" id="hotel{{ $key }}"
                                                    placeholder="Enter Hotel" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="room_type{{ $key }}">Room Type:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherAccommodation->room_type }}" name="room_type[]"
                                                    id="room_type{{ $key }}" placeholder="Enter Room Type" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="room{{ $key }}">Room:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherAccommodation->room }}" name="room[]" id="room{{ $key }}"
                                                    placeholder="Enter Room" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="check_in{{ $key }}">Check-in:<sup class="required">*</sup>
                                                </label>
                                                <input type="date" value="{{ $voucherAccommodation->check_in }}" name="check_in[]"
                                                    id="check_in{{ $key }}" placeholder="Check In Date" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="check_out{{ $key }}">Check-out:<sup class="required">*</sup>
                                                </label>
                                                <input type="date" value="{{ $voucherAccommodation->check_out }}" name="check_out[]"
                                                    id="check_out{{ $key }}" placeholder="Check Out Date" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="night{{ $key }}">Night:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherAccommodation->night }}" name="night[]" id="night{{ $key }}"
                                                    placeholder="Enter Night" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="hotel_by{{ $key }}">Hotel By:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherAccommodation->hotel_by }}" name="hotel_by[]"
                                                    id="hotel_by{{ $key }}" placeholder="Enter Hotel By" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="confirm{{ $key }}">Confirm:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherAccommodation->confirm }}" name="confirm[]"
                                                    id="confirm{{ $key }}" placeholder="Confirm" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="meals{{ $key }}">Meals:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherAccommodation->meals }}" name="meals[]" id="meals{{ $key }}"
                                                    placeholder="Meals" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-6"></div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldAccommodation($(this))" value="{{ $voucherAccommodation->id }}" type="button"
                                                class="btn btn-danger" style="margin-top: 0; margin-bottom:5px;"><i
                                                    class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendAccommodation()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Accommodation</button>


                            <div id="transport_details">
                                @foreach ($serviceVoucher->voucherTransportations as $key => $voucherTransportation)
                                    <div class="row">
                                        <input type="hidden" value="{{ $voucherTransportation->id }}" name="transportation_ids[]">
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="transport_date{{ $key }}">Date:<sup class="required">*</sup>
                                                </label>
                                                <input type="date" value="{{ $voucherTransportation->date }}" name="transport_date[]"
                                                    id="transport_date{{ $key }}" placeholder="Date" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="transport_from{{ $key }}">From:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->from }}" name="transport_from[]"
                                                    id="transport_from{{ $key }}" placeholder="From" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="from_location{{ $key }}">From Location:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherTransportation->from_location }}" name="from_location[]"
                                                    id="from_location{{ $key }}" placeholder="From Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="transport_to{{ $key }}">To:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->to }}" name="transport_to[]"
                                                    id="transport_to{{ $key }}" placeholder="To" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="to_location{{ $key }}">To Location:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->to_location }}" name="to_location[]"
                                                    id="to_location{{ $key }}" placeholder="To Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="movement{{ $key }}">Movement:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->movement }}" name="movement[]"
                                                    id="movement{{ $key }}" placeholder="Movement" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="vehicle{{ $key }}">Vehicle:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->vehicle }}" name="vehicle[]"
                                                    id="vehicle{{ $key }}" placeholder="Vehicle" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="qty{{ $key }}">Qty:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherTransportation->qty }}" name="qty[]" id="qty{{ $key }}"
                                                    placeholder="Qty" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-4">
                                            <fieldset class="ams-input">
                                                <label for="transport{{ $key }}">Transport:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherTransportation->transport }}" name="transport[]"
                                                    id="transport{{ $key }}" placeholder="Transport" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-10"></div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldTransportDetails($(this))" value="{{ $voucherTransportation->id }}" type="button"
                                                class="btn btn-danger" style="margin-top: 0; margin-bottom:5px;"><i
                                                    class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendTransportDetails()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Transport Details</button>

                            <div id="flight_details">
                                @foreach ($serviceVoucher->voucherFlightDetails as $key => $voucherFlightDetail)
                                    <div class="row">
                                        <input type="hidden" value="{{ $voucherFlightDetail->id }}" name="flight_detail_ids[]">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="date{{ $key }}">Date:<sup class="required">*</sup>
                                                </label>
                                                <input type="date" value="{{ $voucherFlightDetail->date }}" name="date[]"
                                                    id="date{{ $key }}" placeholder="Enter Date" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="career{{ $key }}">Career:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherFlightDetail->career }}" name="career[]"
                                                    id="career{{ $key }}" placeholder="Enter Career" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="flight_no{{ $key }}">Flight No:<sup
                                                        class="required">*</sup> </label>
                                                <input type="text" value="{{ $voucherFlightDetail->flight_no }}" name="flight_no[]"
                                                    id="flight_no{{ $key }}" placeholder="Enter Flight No"
                                                    required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="from{{ $key }}">From:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherFlightDetail->from }}" name="from[]"
                                                    id="from{{ $key }}" placeholder="From Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="to{{ $key }}">To:<sup class="required">*</sup>
                                                </label>
                                                <input type="text" value="{{ $voucherFlightDetail->to }}" name="to[]"
                                                    id="to{{ $key }}" placeholder="To Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="etd{{ $key }}">Estimated Time of Departure:<sup
                                                        class="required">*</sup> </label>
                                                <input type="time" value="{{ $voucherFlightDetail->etd }}" name="etd[]"
                                                    id="etd{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="eta{{ $key }}">Estimated Time of Arrival:<sup
                                                        class="required">*</sup> </label>
                                                <input type="time" value="{{ $voucherFlightDetail->eta }}" name="eta[]"
                                                    id="eta{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5"></div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldFlightDetail($(this))" value="{{ $voucherFlightDetail->id }}"
                                                type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendFlightDetail()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Flight Detail</button>

                            <div id="helplines">
                                @php
                                    $helpline_locations = $serviceVoucher->helpline_location ? json_decode($serviceVoucher->helpline_location) : [];
                                    $helpline_numbers = $serviceVoucher->helpline_number ? json_decode($serviceVoucher->helpline_number) : [];
                                @endphp
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
                                            <button onclick="removeOldHelpline($(this))" value="{{ $key }}"
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
                                        <textarea name="service_included" id="service_included" cols="30" class="ckeditor" rows="2">{!! old('service_included', $serviceVoucher->service_included) !!}</textarea>
                                        @error('service_included')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="service_excluded">Service Excluded</label>
                                        <textarea name="service_excluded" id="service_excluded" cols="30" class="ckeditor" rows="2">{!! old('service_excluded', $serviceVoucher->service_excluded) !!}</textarea>
                                        @error('service_excluded')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="support_staf">Support Staff</label>
                                        <textarea name="support_staf" id="support_staf" cols="30" class="ckeditor" rows="2">{!! old('support_staf', $serviceVoucher->support_staf) !!}</textarea>
                                        @error('support_staf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset class="ams-input">
                                        <label for="terms_and_conditions">Terms & Condition</label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" cols="30" class="ckeditor" rows="2">{!! old('terms_and_conditions', $serviceVoucher->terms_and_conditions) !!}</textarea>
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
        let voucher_id = '{{ $serviceVoucher->id }}'
        console.log('voucher_id', voucher_id);
        const URL = "{!! route('admin.serviceVoucher.delete.element', ['type', '#','voucher_id']) !!}";
        const DELETE_SERVICE_VOUCHER_ELEMENT = URL.replace('voucher_id', voucher_id);

        DELETE_SERVICE_VOUCHER_ELEMENT.
        console.log('DELETE_SERVICE_VOUCHER_ELEMENT', DELETE_SERVICE_VOUCHER_ELEMENT);

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
        function removeOldCompany(element){
            let content_id = $(element).val();

            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','company'),function(res) {

                if(res.status == 200){
                    removeCompany(element)
                }else{
                    alert(res.message);
                }
            });
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
        function removeOldHelpline(element){
            let content_id = $(element).val();
            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','helpline'),function(res) {
                if(res.status == 200){
                    removeHelpline(element)
                }else{
                    alert(res.message);
                }
            });
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
        function removeOldFlightDetail(element){
            let content_id = $(element).val();
            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','flight_details'),function(res) {
                if(res.status == 200){
                    removeFlightDetail(element)
                }else{
                    alert(res.message);
                }
            });
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
        function removeOldGuest(element){
            let content_id = $(element).val();

            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','guest'),function(res) {

                if(res.status == 200){
                    removeGuest(element)
                }else{
                    alert(res.message);
                }
            });
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
        function removeOldAccommodation(element){
            let content_id = $(element).val();
            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','accommodation'),function(res) {
                if(res.status == 200){
                    removeAccommodation(element)
                }else{
                    alert(res.message);
                }
            });
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
        function removeOldTransportDetails(element){
            let content_id = $(element).val();
            console.log('DELETE_SERVICE_VOUCHER_ELEMENT',DELETE_SERVICE_VOUCHER_ELEMENT)
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','transport_details'),function(res) {
                if(res.status == 200){
                    removeTransportDetails(element)
                }else{
                    alert(res.message);
                }
            });
        }
    </script>
@endpush
