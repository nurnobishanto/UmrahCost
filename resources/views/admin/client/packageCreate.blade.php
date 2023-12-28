@extends('admin.layouts.app')
@push('title')
    Package Create
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
     <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Package Create </h5>
                <div>
                    @if (check_permission('Custom Package List'))
                        <a href="{{ route('admin.customPackage.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i>Custom Package List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.client.package.store', $user->id) }}" enctype="multipart/form-data" class="ams-form" >
                        @csrf
                        @method('POST')
                        <input type="hidden" name="package_id" value="1">
                        <div class="input-group">
                            <fieldset class="ams-input">
                                <label for="client_name">Client Name<sup class="required">*</sup> </label>
                                <input type="text" value="{{ old('client_name', $user->name) }}" name="client_name" id="client_name" placeholder="Enter Client Name" readonly >
                                @error('client_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="package_type">Package Type</label>
                                <select required class="form-control " name="package_type" id="package_type">
                                    <option value="">Select One</option>
                                    @foreach ($packageTypes as $packageType)
                                        <option @if (old('package_type') == $packageType->id) selected @endif
                                            value="{{ $packageType->id }}">{{ $packageType->name }}</option>
                                    @endforeach
                                </select>
                                @error('package_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="travel_date">Travel Date(Tentative)</label>
                             <input type="date" value="{{ old('travel_date') }}" name="travel_date" id="travel_date">
                                @error('travel_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="nos_of_traveler">Nos Of Travelers</label>
                                <select name="nos_of_traveler" id="nos_of_traveler" class="form-control" required onchange="changeHotelOrTravelerNumber()" >
                                    <option value="">Select One</option>
                                    @foreach (number_range_to_array(1,10) as $number)
                                        <option @if($number == old('nos_of_traveler')) selected @endif value="{{ $number }}">{{ $number }} </option>
                                    @endforeach
                                </select>
                                @error('nos_of_traveler')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="visa">Visa</label>
                                <select name="visa" id="visa" class="form-control">
                                    <option value="">Select One</option>
                                    <option @selected(old('visa') === 1) selected value="1">Included
                                    </option>
                                    <option @selected(old('visa') === 0) value="0">Not Included
                                    </option>
                                </select>
                                @error('visa')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="airline">Select Airlines</label>
                                <select required class="form-control" name="airline" id="airline">
                                    <option value="">Select One</option>
                                    @foreach ($airlines as $airline)
                                        <option @if (old('airline') == $airline->id) selected @endif
                                            value="{{ $airline->id }}">{{ $airline->name }}</option>
                                    @endforeach
                                </select>
                                @error('airline')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            @foreach($locations as $key => $location)
                                <fieldset class="ams-input">
                                    <input type="hidden" value="{{ $location->id }}" name="location_ids[]">
                                    <label for="hotel{{ $key }}">{{ $location->name }} Hotel</label>
                                    <select onchange="changeHotelOrTravelerNumber()" id="hotel{{ $key }}" class="hotel form-control" name="hotel[]" required>
                                        <option value="">Select One</option>
                                    </select>
                                    @error('hotel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            @endforeach
                            @foreach ($locations as $key => $location)
                                <fieldset class="ams-input">
                                    <label for="room_type{{ $key }}">{{ $location->name }} Room Type</label>
                                    <select id="room_type{{ $key }}" class="room_type form-control" name="room_type[]" required>
                                        <option value="">Select One</option>
                                    </select>
                                    @error('room_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            @endforeach
                            @foreach ($locations as $key => $location)
                                <fieldset class="ams-input">
                                    <label for="stay{{ $location->id }}">{{ $location->name }} Stay (Days)</label>
                                    <select class="stay_class form-control" onchange="countTotalStay()"
                                        id="stay{{ $location->id }}" name="stay[]" required>
                                        <option value="">Select One</option>
                                        @foreach (number_range_to_array(2, 10) as $number)
                                            <option @selected($number == old('stay'[$key]))
                                                value="{{ $number }}"> {{ $number }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('stay')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            @endforeach
                            <fieldset class="ams-input">
                                <label for="total_stay">Total Stay (Days)</label>
                                <input type="number" step="any" value="{{ old('total_stay', ) }}" name="total_stay" id="total_stay" class="form-control" placeholder="Enter Total Stay" >
                                @error('total_stay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                            
                            </fieldset>

                            <fieldset class="ams-input">
                                <label for="transport_included">Transport</label>
                                <select name="transport_included" id="transport_included" class="form-control">
                                    <option value="">Select One</option>
                                    <option @selected(old('transport_included') === 1) selected value="1">Included
                                    </option>
                                    <option @selected(old('transport_included') === 0) value="0">Not Included
                                    </option>
                                </select>
                                @error('transport_included')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="transport">Transport Type(Required if included)</label>
                                <select required class="form-control" name="transport" id="transport">
                                    <option value="">Select One</option>
                                    @foreach ($transports as $transport)
                                        <option @if (old('transport') == $transport->id) selected @endif
                                            value="{{ $transport->id }}">{{ $transport->name }}</option>
                                    @endforeach
                                </select>
                                @error('transport')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="ams-input">
                                <label for="guide_included">Guide</label>
                                <select name="guide_included" id="guide_included" class="form-control">
                                    <option value="">Select One</option>
                                    <option @selected(old('guide_included') === 1) selected value="1">Included
                                    </option>
                                    <option @selected(old('guide_included') === 0) value="0">Not Included
                                    </option>
                                </select>
                                @error('guide_included')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                           
                            

                            <fieldset class="ams-input">
                                <label for="guide">Guide Type(Required if included)</label>
                                <select class="unit-select-box" name="guide[]" id="guide" multiple>
                                    <!--<option value="">Select One</option>-->
                                    @foreach ($guides as $guide)
                                        <option @if (old('guide') == $guide->id) selected @endif
                                            value="{{ $guide->id }}">{{ $guide->name }}</option>
                                    @endforeach
                                </select>
                                @error('guide')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="ams-input">
                                <label for="sightseeing_included">Sightseeing</label>
                                <select name="sightseeing_included" id="sightseeing_included" class="form-control">
                                    <option value="">Select One</option>
                                    <option @selected(old('sightseeing_included') == 1) value="1">Included
                                    </option>
                                    <option @selected(old('sightseeing_included') == 0) value="0">Not Included
                                    </option>
                                </select>
                                @error('sightseeing_included')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            @foreach ($locations as $key => $location)
                                <fieldset class="ams-input">
                                    <label for="sightseeing{{ $key }}">Sightseeing in {{ $location->name }} (Required if included)</label>
                                    <select class="sightseeing_class form-control"
                                        id="sightseeing{{ $key }}" name="sightseeing[]">
                                        <option value="">Select One</option>
                                        @foreach ($location->sightseeings->where('status', 1) as $sightseeing)
                                            <option @selected($sightseeing->id == old('sightseeing'[$key]))
                                                value="{{ $sightseeing->id }}">{{ $sightseeing->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sightseeing')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            @endforeach

                            <fieldset class="ams-input">
                            
                            </fieldset>

                            
                            <fieldset class="ams-input">
                                <label for="food">Food</label>
                                <select name="food" id="food" class="form-control">
                                    <!--<option value="">Select One</option>-->
                                    <option @selected(old('food') == 1) value="1" disabled>Included
                                    </option>
                                    <option @selected(old('food') == 0) value="0" >Not Included
                                    </option>
                                </select>
                                <!--<input type="text" value="0" name="food" id="food" placeholder="Enter Client Name" readonly >-->
                                @error('food')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input">
                                <label for="note">Notes<sup class="required">*</sup> </label>
                                <textarea name="note" id="note" cols="30" rows="2">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
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
    <script type="text/javascript">
        const LOCATIONS = {!! $locations !!};

        function countTotalStay() {
            let sum = 0;
            $('.stay_class').each(function() {
                if (!isNaN(parseFloat($(this).val()))) {
                    sum += parseFloat($(this).val());
                }
            });
            $('#total_stay').val(sum);
        }

        $(document).ready(function() {
            $('#transport_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('#transport').prop('required', true);
                } else {
                    $('#transport').prop('required', false);
                }
            });

            $('#guide_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('#guide').prop('required', true);
                } else {
                    $('#guide').prop('required', false);
                }
            });
            
            $('#sightseeing_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('.sightseeing_class').prop('required', true);
                } else {
                    $('.sightseeing_class').prop('required', false);
                }
            });

            $('#package_type').change(function() {
                var packageType = $(this).val();
               
                if (packageType) {
                    LOCATIONS.forEach((location, key) => {
                        $("#hotel" + key).empty();
                        $("#hotel" + key).append('<option value="">Searching....</option>');
                        $.ajax({
                            type: "GET",
                            url: "{{ url('ajax/hotel-by-package-type-and-location') }}/" +packageType + "/" + location.id,
                            success: function(res) {
                                if (res) {
                                    $("#hotel" + key).empty();
                                    // $("#hotel" + key).append('<option value="">Select One</option>');
                                    $.each(res, function(childKey, value) {
                                        $("#hotel" + key).append('<option value="' + value.id +'">' + value.name + '</ option>');
                                    });
                                } else {
                                    $("#hotel" + key).empty();
                                }
                            }
                        });
                    });
                } else {
                    $(".hotel").empty();
                }
            });
        });


        function changeHotelOrTravelerNumber() {
            let nosOfTraveler = $('#nos_of_traveler').val();
            
            if (nosOfTraveler) {
               
                LOCATIONS.forEach((location, key) => {
                    let hotelId = $("#hotel" + key).val();
                    let roomTypeValue = $("#room_type" + key).val();
                    if (hotelId) {
                        
                        $("#room_type" + key).empty();
                        $("#room_type" + key).append('<option value="">Searching....</option>');
                        $.ajax({
                            type: "GET",
                            url: "{{ url('ajax/room-type-by-traveler-and-hotel') }}/" + nosOfTraveler +
                                "/" + hotelId,
                            success: function(res) {
                                if (res) {
                                    $("#room_type" + key).empty();
                                    // $("#room_type" + key).append('<option value="" >Select One</option>');
                                    $.each(res, function(childKey, value) {
                                        
                                        $("#room_type" + key).append('<option value="' + value.id + '">' + value.name + '</option>');
                                        
                                        
                                    });
                                    
                                } 
                                else {
                                    
                                    $("#room_type" + key).empty();
                                }
                            }
                        });
                    }
                });
            } else {
                $(".hotel").empty();
            }
        }
    </script>
@endpush
