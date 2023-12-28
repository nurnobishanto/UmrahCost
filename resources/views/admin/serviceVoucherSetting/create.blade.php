@extends('admin.layouts.app')
@push('title')
    Service Voucher Setting
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Service Voucher Setting</h5>
                <div>
                    {{-- @if (check_permission('Client List'))
                        <a href="{{ route('admin.serviceVoucherSetting.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Client List</a>
                    @endif --}}
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.serviceVoucherSetting.store') }}"
                        enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('POST')
                        <div class="">
                            @php
                                $companyTitles = $serviceVoucherSetting->company_title ? json_decode($serviceVoucherSetting->company_title) : [];
                                $companyNames = $serviceVoucherSetting->company_name ? json_decode($serviceVoucherSetting->company_name) : [];
                            @endphp

                            <div id="companies"> 
                                @foreach ($companyTitles as $key => $companyTitle)
                                    <div class="row">
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_title{{ $key }}">Company Title:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $companyTitle }}" name="company_title[]" id="company_title{{ $key }}" placeholder="Enter Company Title" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="company_name{{ $key }}">Company Name:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $companyNames[$key] }}" name="company_name[]" id="company_name{{ $key }}" placeholder="Enter Company Name" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldCompany($(this))" value="{{ $key }}" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button onclick="appendCompany()" type="button" class="btn btn-success"> <i
                                    class="fa fa-plus"></i> Add Company</button>

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
                                                <label for="career{{ $key }}">Career:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $careers[$key] }}" name="career[]" id="career{{ $key }}"
                                                    placeholder="Enter Career" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="flight_no{{ $key }}">Flight No:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $flight_nos[$key] }}" name="flight_no[]" id="flight_no{{ $key }}"
                                                    placeholder="Enter Flight No" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="from{{ $key }}">From:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $froms[$key] }}" name="from[]" id="from{{ $key }}"
                                                    placeholder="From Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="to{{ $key }}">To:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $tos[$key] }}" name="to[]" id="to{{ $key }}"
                                                    placeholder="To Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="etd{{ $key }}">Estimated Time of Departure:<sup class="required">*</sup> </label>
                                                <input type="time" value="{{ $etds[$key] }}" name="etd[]" id="etd{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="eta{{ $key }}">Estimated Time of Arrival:<sup class="required">*</sup> </label>
                                                <input type="time" value="{{ $etas[$key] }}" name="eta[]" id="eta{{ $key }}" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldFlightDetail($(this))" value="{{ $key }}" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</button>
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
                                                <label for="helpline_location{{ $key }}">Helpline Location:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $helpline_locations[$key] }}" name="helpline_location[]" id="helpline_location{{ $key }}" placeholder="Enter Helpline Location" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-5">
                                            <fieldset class="ams-input">
                                                <label for="helpline_number{{ $key }}">Helpline Number:<sup class="required">*</sup> </label>
                                                <input type="text" value="{{ $helpline_numbers[$key] }}" name="helpline_number[]" id="helpline_number{{ $key }}" placeholder="Enter Helpline Number" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <button onclick="removeOldHelpline($(this))" value="{{ $key }}" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</button>
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
        const DELETE_SERVICE_VOUCHER_ELEMENT = "{!! route('admin.serviceVoucherSetting.delete.element', ['type','#']) !!}";
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

            let html = `<div class="row">
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
            $.get(DELETE_SERVICE_VOUCHER_ELEMENT.replace("#", content_id).replace('type','flight'),function(res) {
                if(res.status == 200){
                    removeFlightDetail(element)
                }else{
                    alert(res.message);
                }
            });
        }
    </script>
@endpush
