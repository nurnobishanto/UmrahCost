@extends('frontend.layouts.app')
@push('title')
    Build Umrah Package
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content">
        @include('frontend.layouts.partials.banner')

        @include('frontend.layouts.partials.container')

        <section class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-9">
                        <div class="package-selection-box">
                            <h4>Build Your Umrah Package in a few easy steps</h4>
                            <div class="traveler-details-card">
                                <div class="card-body">
                                    <div class="personal-details">
                                        <form class="personal-info-form info-form" method="POST"
                                            action="{{ route('frontend.customPackage.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="package_id" value="1">
                                                    <fieldset class="input-grp">
                                                        <label for="package_type" class="required">Package Type</label>
                                                        <select class="nice-select" id="package_type" name="package_type">
                                                            <option value="">Select One</option>
                                                            @foreach ($packageTypes as $packageType)
                                                                <option @selected($packageType->id == old('package_type'))
                                                                    value="{{ $packageType->id }}">
                                                                    {{ $packageType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('package_type')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <fieldset class="input-grp">
                                                                <label for="from_travel_date" class="required">From Travel
                                                                    Date(Tentative)</label>
                                                                <input type="text" readonly value="{{ old('from_travel_date',$today) }}"
                                                                       id="from_travel_date" name="from_travel_date">
                                                                @error('from_travel_date')
                                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                                @enderror
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-6">
                                                            <fieldset class="input-grp">
                                                                <label for="travel_date" class="required">Between Travel
                                                                    Date(Tentative)</label>
                                                                <input type="text" readonly value="{{ old('travel_date',$afterSevenDays) }}"
                                                                       id="travel_date" name="travel_date">
                                                                @error('travel_date')
                                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                                @enderror
                                                            </fieldset>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <fieldset class="input-grp">
                                                        <label for="nos_of_traveler" class="required">Nos Of
                                                            Travelers</label>
                                                        <select class="nice-select" id="nos_of_traveler" name="nos_of_traveler" onchange="changeHotelOrTravelerNumber()">
                                                            <option value="">Select One</option>
                                                            @foreach ($travelers as $number)
                                                                <option @selected($number == old('nos_of_traveler'))
                                                                    value="{{ $number }}">{{ $number }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('nos_of_traveler')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <fieldset class="input-grp">
                                                        <label for="visa" class="required">Visa</label>
                                                        <select class="nice-select" name="visa" id="visa">
                                                            <option value="">Select One</option>
                                                            <option @selected(old('visa',1) == 1) value="1">Included
                                                            </option>
                                                            <option @selected(old('visa',1) == 0) value="0">Not Included
                                                            </option>
                                                        </select>
                                                        @error('visa')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <fieldset class="input-grp">
                                                        <label for="airline" class="required">Airlines</label>
                                                        <select class="nice-select" id="airline" name="airline">
                                                            <option value="">Select One</option>
                                                            @foreach ($airlines as $airline)
                                                                <option @selected($airline->id == old('airline'))
                                                                    value="{{ $airline->id }}">{{ $airline->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('airline')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>

                                            </div>
                                            <div class="row">
                                                @foreach ($locations as $key => $location)
                                                    <div class="col-lg-6">
                                                        <fieldset class="input-grp">
                                                            <input type="hidden" value="{{ $location->id }}"
                                                                name="location_ids[]">
                                                            <label for="hotel{{ $key }}"
                                                                class="required">{{ $location->name }} Hotel</label>
                                                            <select class="nice-select" onchange="changeHotelOrTravelerNumber()"
                                                                id="hotel{{ $key }}" class="hotel"
                                                                name="hotel[]" required>
                                                                <option value="">Select One</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                @endforeach

                                                @foreach ($locations as $key => $location)
                                                    <div class="col-lg-6">
                                                        <fieldset class="input-grp">
                                                            <label for="room_type{{ $key }}"
                                                                class="required">{{ $location->name }} Room Type</label>
                                                            <select class="nice-select" name="room_type[]" id="room_type{{ $key }}" required>
                                                                <option value="">Select One</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                @endforeach
                                                @foreach ($locations as $key => $location)
                                                    <div class="col-lg-6">
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
                                                    </div>

                                                @endforeach
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="total_stay" class="required">Total Stay</label>
                                                        <input type="number" readonly step="any" id="total_stay"
                                                            value="{{ old('total_stay') }}" name="total_stay">
                                                        @error('total_stay')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="transport_included" class="required">Transport</label>
                                                        <select class="nice-select" name="transport_included" id="transport_included">
                                                            <option value="">Select One</option>
                                                            <option @selected(old('transport_included',1) == 1) value="1">Included
                                                            </option>
                                                            <option @selected(old('transport_included',1) == 0) value="0">Not Included</option>
                                                        </select>
                                                        @error('transport_included')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="transport" id="transport-label">Transport Type(Required if included)</label>
                                                        <select class="nice-select" name="transport" id="transport" required>
                                                            <option value="">Select One</option>
                                                            @foreach ($transports as $transport)
                                                                <option @selected(old('transport') == $transport->id)
                                                                    value="{{ $transport->id }}">{{ $transport->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('transport')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="guide_included" class="required">Guide</label>
                                                        <select name="guide_included" id="guide_included" class="form-control">
                                                            <option value="">Select One</option>
                                                            <option @selected(old('guide_included') === 1) selected value="1">Included
                                                            </option>
                                                            <option @selected(old('guide_included') === 0) value="0">Not Included
                                                            </option>
                                                        </select>
                                                        @error('guide_included')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="guide" id="guide-label">Guide Type(Required if included)</label>
                                                        <select name="guide[]" id="custom-multiple-select" multiple>
                                                            <option value="">Select One</option>
                                                            @foreach ($guides as $guide)
                                                                <option @selected(old('guide') == $guide->id || $guide->id==1)
                                                                    value="{{ $guide->id }}">{{ $guide->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('guide')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="sightseeing_included" class="required">Sightseeing</label>
                                                        <select class="nice-select" name="sightseeing_included" id="sightseeing_included">
                                                            <option value="">Select One</option>
                                                            <option @selected(old('sightseeing_included') == 1) value="1">Included
                                                            </option>
                                                            <option @selected(old('sightseeing_included') == 0) value="0">Not
                                                                Included</option>
                                                        </select>
                                                        @error('sightseeing_included')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                @foreach ($locations as $key => $location)
                                                    <div class="col-lg-6">
                                                        <fieldset class="input-grp">
                                                            <label for="sightseeing{{ $key }}" >Sightseeing in {{ $location->name }} (Required if included)</label>
                                                            <select class="nice-select" class="sightseeing_class" id="sightseeing{{ $key }}" name="sightseeing[]">
                                                                <option value="">Select One</option>
                                                                @foreach ($location->sightseeings->where('status', 1) as $sightseeing)
                                                                    <option @selected($sightseeing->id == old('sightseeing'[$key]))
                                                                        value="{{ $sightseeing->id }}">{{ $sightseeing->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="food" class="required">Food</label>
                                                        <select class="nice-select" name="food" id="food">
                                                            <option value="">Select One</option>
                                                            <option @selected(old('food') == 1) value="1" disabled>Included
                                                            </option>
                                                            <option @selected(old('food') == 0) value="0" >Not
                                                                Included</option>
                                                        </select>
                                                        @error('food')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6">
                                                    <fieldset class="input-grp">
                                                        <label for="note">Note</label>
                                                        <textarea id="note" placeholder="Notes" name="note">{{ old('note') }}</textarea>
                                                        @error('note')
                                                            <p class="text-danger alert-margin">{{ $message }}</p>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="package-submit-btn">Generate Umrah Package</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="sidebar-widget">
                            <a href="#" class="video-btn">How to use? Watch this video</a>
                            <div class="conatct-form">
                                <h5>Send Specific Query</h5>
                                <form class="p-3">
                                    <input type="text" placeholder="Name">
                                    <input type="phone" placeholder="Mobile No">
                                    <input type="email" placeholder="Email">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                            <div class="tag tag-blue">Free Consultation</div>
                            <div class="tag tag-grn">Pre-Build Umrah Package</div>
                            <div class="blogs mt-4">
                                <div class="single-blog">
                                    <a href="#">
                                        <img src="{{ asset('assets/frontend/images/banner/Kaaba.jpg') }}" alt="Kabba">
                                    </a>
                                </div>
                                <div class="single-blog">
                                    <a href="#">
                                        <img src="{{ asset('assets/frontend/images/banner/hajj.jpg') }}" alt="Hajj">
                                    </a>
                                </div>
                                <div class="single-blog">
                                    <a href="#">
                                        <img src="{{ asset('assets/frontend/images/banner/Umrah.jpg') }}" alt="Umrah">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('script')
    <script>
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


        function changeHotelOrTravelerNumber() {
            let nosOfTraveler = $('#nos_of_traveler').val();
            if (nosOfTraveler) {
                LOCATIONS.forEach((location, key) => {
                    let hotelId = $("#hotel" + key).val();
                    let roomTypeValue = $("#room_type" + key).val();
                    let from_travel_date = $('#from_travel_date').val();
                    let travel_date = $('#travel_date').val();
                    console.log(from_travel_date);
                    console.log(travel_date);
                    if (hotelId ) {
                        $("#room_type" + key).empty();
                        $("#room_type" + key).append('<option value="">Searching....</option>');
                        $('#room_type' + key).niceSelect('update');
                        $.ajax({
                            type: "GET",
                            url: "{{ url('ajax/room-type-by-traveler-and-hotel') }}/" + nosOfTraveler +
                                "/" + hotelId ,
                            data:{
                                'travel_date':travel_date,
                                'from_travel_date':from_travel_date,
                            },
                            success: function(res) {
                                if (res) {
                                    $("#room_type" + key).empty();
                                    // $("#room_type" + key).append('<option value="">Select One</option>');
                                    $.each(res, function(childKey, value) {
                                        $("#room_type" + key).append('<option value="' + value.id + '">' + value.name +'</option>');
                                    });
                                    $('#room_type' + key).niceSelect('update');
                                } else {
                                    $("#room_type" + key).empty();
                                    $('#room_type' + key).niceSelect('update');
                                }
                            }
                        });
                    }
                });
            } else {
                $(".hotel").empty();
                $('.hotel').niceSelect('update');
            }
        }

        $(document).ready(function() {
            $('#travel_date').datepicker({
                dateFormat: 'yy-mm-d',
                minDate: 1,
                maxDate: '{{$latestToDate}}',
                onSelect: function (){
                    changeHotelOrTravelerNumber();
                }
            });

            $('#from_travel_date').datepicker({
                dateFormat: 'yy-mm-d',
                minDate: 1,
                maxDate: '{{$latestToDate}}',
                onSelect: function(selectedDate) {
                    // Update maxDate of 'travel_date' datepicker
                    var travelDate = $.datepicker.parseDate('yy-mm-d', selectedDate);
                    travelDate.setDate(travelDate.getDate() + 7);
                    $('#travel_date').datepicker('option', 'minDate', selectedDate);
                    $('#travel_date').datepicker('setDate', travelDate);
                    changeHotelOrTravelerNumber()
                },
            });
            $('#package_type').change(function() {
                var packageType = $(this).val();
                if (packageType) {
                    LOCATIONS.forEach((location, key) => {
                        $("#hotel" + key).empty();
                        $("#hotel" + key).append('<option value="">Searching....</option>');
                        $('#hotel' + key).niceSelect('update');
                        $.ajax({
                            type: "GET",
                            url: "{{ url('ajax/hotel-by-package-type-and-location') }}/" +
                                packageType + "/" + location.id,
                            success: function(res) {
                                if (res) {
                                    $("#hotel" + key).empty();
                                    // $("#hotel" + key).append('<option value="">Select One</option>');
                                    $.each(res, function(childKey, value) {
                                        $("#hotel" + key).append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</ option>'
                                        );
                                    });
                                    $('#hotel' + key).niceSelect('update');
                                } else {
                                    $("#hotel" + key).empty();
                                    $('#hotel' + key).niceSelect('update');
                                }
                            }
                        });
                    });
                } else {
                    $(".hotel").empty();
                    $('.hotel').niceSelect('update');
                }
            });


            $('#transport_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('#transport').prop('required', true).niceSelect('update');
                } else {
                    $('#transport').prop('required', false).niceSelect('update');
                }
            });

            $('#guide_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('#guide').prop('required', true).niceSelect('update');
                } else {
                    $('#guide').prop('required', false).niceSelect('update');
                }
            });

            $('#sightseeing_included').on('change', function() {
                if ($(this).val() === '1') {
                    $('.sightseeing_class').prop('required', true).niceSelect('update');
                } else {
                    $('.sightseeing_class').prop('required', false).niceSelect('update');
                }
            });
        });
    </script>
@endpush
