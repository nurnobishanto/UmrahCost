<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} -Service Voucher</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Service Voucher | {{ config('app.name') }}</title>
    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .text-center {
            text-align: center
        }
        ul, ol {
            margin-left: 20px !important; /* Adjust as needed */
        }

        .invoice {
            box-sizing: border-box;
        }

        .inv-heading {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
        }

        .inv-heading .inv-col {
            border: 1px solid black
        }

        .inv-heading .inv-col div:first-child {
            background-color: #217a03;
            font-weight: 700;
            border-bottom: 1px solid black;
            color: white
        }

        .inv-heading .inv-col .title {
            font-size: 32px;
            font-weight: 700;
        }

        .inv-company-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 20px 0px 15px !important;
            border-bottom: 1px solid lightslategray;
        }

        .inv-company-info div {
            border: 1px solid black;
            font-size: 12px;
        }

        .inv-table-container {
            margin-top: 15px !important;
        }

        .inv-table-title {
            text-align: center;
            font-weight: 700;
            font-size: 15px;
        }

        .inv-table {
            width: 100%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .inv-table td,
        .inv-table th {
            padding: 4px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            font-size: 12px;
        }

        .inv-terms,
        .inv-vehicle-time {
            margin-top: 10px !important;
            font-size: 12px
        }

        .inv-terms .title {
            background: #217a03;
            font-size: 14px;
            padding: 2px !important;
            color: white;
        }

        .inv-vehicle-time .title {
            text-decoration: underline;
            font-size: 14px;
            padding: 2px !important;
        }

        .inv-helpline {
            margin-top: 15px !important;
            font-size: 12px;
        }

        .inv-helpline .title {
            font-size: 14px;
            font-weight: bold;
        }

        .inv-helpline .help-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding-top: 5px;
        }

        .help-grid .help-border {
            border: 1px solid black;
            padding: 5px;
            /* font-size: 12px; */
        }

        .service-incl {
            padding: 5px;
        }
    </style>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i);

        .page,
        .page * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
            color: #232c3d;
        }

        .page {
            width: 21cm;
            max-width: 21cm;
            min-height: 29.7cm;
            margin: 90px auto 10px;
            padding: 40px;
            background-color: white;
            box-shadow: 0 0px 8px 0 rgb(0 0 0 / 6%), 0 1px 0px 0 rgb(0 0 0 / 2%);
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
        }

        @media print {
            @page {
                size: A4;
            }

            .page {
                width: 100%;
                max-width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .page,
            .page * {
                color: black;
            }
        }

        .page img {
            max-width: 100%;
        }

        .page .title {
            font-weight: bolder;
            letter-spacing: 0.1px;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .page .subtitle {
            letter-spacing: 0.1px;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .page .property {
            font-size: 13px;
            color: black;
        }

        .page .property .key {
            font-weight: bold;
            margin-right: 2px;
            font-size: 13px;
            color: black;
        }

        .print-btn {
            position: fixed;
            bottom: 10px;
            right: 40%;
            z-index: 1000;
        }

        .page div[class^="col-"] {
            padding-right: 8px;
        }
    </style>

    <style type="text/css" media="print">
        body {
            font-weight: bold;
        }

        @page {
            /* size: auto; */
            /* auto is the initial value */
            /* margin: 0mm; */
            /* this affects the margin in the printer settings */
        }

        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body @if ($onload == true) onload="window.print();" @endif>
    <div class="print-btn d-print-none">
        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-print"></i> Print
        </a>
    </div>


    <div style="margin-top: 50px;">
        <section class="page" style="position: relative;">
            <div class="invoice">
                <div class="inv-heading text-center">
                    <div class="inv-col">
                        <div class="">Program #</div>
                        <div>{{ $serviceVoucher->serial_no }}</div>
                    </div>
                    <div class="inv-col">
                        <h3 class="title">
                            Service Voucher
                        </h3>
                        <p class="sub-title">
                            [Umrah Season {{ Carbon\Carbon::parse($serviceVoucher->created_at)->format('Y') }}]
                        </p>

                    </div>
                    <div class="inv-col">
                        <div>Pilgrim By</div>
                        <div>Ref:</div>
                    </div>
                </div>

                {{-- company info  --}}
                <div class="inv-company-info text-center">
                    @foreach ($serviceVoucher->voucherCompanies as $key => $voucherCompany)
                        <div>{{ strtoupper($voucherCompany->company_title) }}:
                            {{ strtoupper($voucherCompany->company_name) }}</div>
                    @endforeach
                </div>

                {{-- Guest contract table  --}}
                @php
                    $totalGuest = $serviceVoucher->voucherGuests->count();
                    $half = ceil($totalGuest / 2);
                    
                    // dd($totalGuest,$half);
                    
                @endphp
                <div class="inv-table-container">
                    <h5 class="inv-table-title">Guest contract & accepted/confirmed itinerary</h5>
                    @if ($totalGuest <= 5)
                        <table class="inv-table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Guest/s Name</th>
                                    <th>Passport No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceVoucher->voucherGuests as $key => $voucherGuest)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $voucherGuest->name }}</td>
                                        <td>{{ $voucherGuest->passport_no }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="row">
                            <div class="col-6">
                                <table class="inv-table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Guest/s Name</th>
                                            <th>Passport No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($serviceVoucher->voucherGuests as $key => $voucherGuest)
                                            @if ($half >= $key + 1)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $voucherGuest->name }}</td>
                                                    <td>{{ $voucherGuest->passport_no }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="inv-table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Guest/s Name</th>
                                            <th>Passport No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($serviceVoucher->voucherGuests as $key => $voucherGuest)
                                            @if ($half < $key + 1)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $voucherGuest->name }}</td>
                                                    <td>{{ $voucherGuest->passport_no }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Accommodation table  --}}
                <div class="inv-table-container">
                    <h5 class="inv-table-title">Accommodation Details</h5>
                    <table class="inv-table">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>Hotel</th>
                                <th>Room Type</th>
                                <th>Room</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Night</th>
                                <th>Hotel by</th>
                                <th>Confirm</th>
                                <th>Meals</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceVoucher->voucherAccommodations as $accommodation)
                                <tr>
                                    <td>{{ $accommodation->city }}</td>
                                    <td>{{ $accommodation->hotel }}</td>
                                    <td>{{ $accommodation->room_type }}</td>
                                    <td>{{ $accommodation->room }}</td>
                                    <td>{{ $accommodation->check_in }}</td>
                                    <td>{{ $accommodation->check_out }}</td>
                                    <td>{{ $accommodation->night }}</td>
                                    <td>{{ $accommodation->hotel_by }}</td>
                                    <td>{{ $accommodation->confirm }}</td>
                                    <td>{{ $accommodation->meals }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Transportation Details --}}
                <div class="inv-table-container">
                    <h5 class="inv-table-title">Transportation Details</h5>
                    <table class="inv-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>From</th>
                                <th>Location</th>
                                <th>To</th>
                                <th>Location</th>
                                <th>Movement</th>
                                <th>Vehicle</th>
                                <th>Qty</th>
                                <th>Transport</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceVoucher->voucherTransportations as $transportation)
                                <tr>
                                    <td>{{ $transportation->date }}</td>
                                    <td>{{ $transportation->from }}</td>
                                    <td>{{ $transportation->from_location }}</td>
                                    <td>{{ $transportation->to }}</td>
                                    <td>{{ $transportation->to_location }}</td>
                                    <td>{{ $transportation->movement }}</td>
                                    <td>{{ $transportation->vehicle }}</td>
                                    <td>{{ $transportation->qty }}</td>
                                    <td>{{ $transportation->transport }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Flight Details --}}
                <div class="inv-table-container">
                    <h5 class="inv-table-title">Flight Details</h5>
                    <table class="inv-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Carrier</th>
                                <th>NO</th>
                                <th>From</th>
                                <th>To</th>
                                <th>ETD</th>
                                <th>ETA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceVoucher->voucherFlightDetails as $flightDetail)
                                <tr>
                                    <td>{{ $flightDetail->date }}</td>
                                    <td>{{ $flightDetail->career }}</td>
                                    <td>{{ $flightDetail->flight_no }}</td>
                                    <td>{{ $flightDetail->from }}</td>
                                    <td>{{ $flightDetail->to }}</td>
                                    <td>{{ $flightDetail->etd }}</td>
                                    <td>{{ $flightDetail->eta }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Terms and conditions  --}}
                <div class="inv-terms">
                    <h3 class="title">Terms & Conditions : HOTEL CHECK-IN & CHECK-OUT TIMINGS :</h3>
                    <div>{!! $serviceVoucher->terms_and_conditions !!}</div>    
                </div>

                {{-- Guest Helpline  --}}
                <div class="inv-helpline">
                    @php
                        $helpline_locations = $serviceVoucher->helpline_location ? json_decode($serviceVoucher->helpline_location) : [];
                        $helpline_numbers = $serviceVoucher->helpline_number ? json_decode($serviceVoucher->helpline_number) : [];
                    @endphp
                    <h3 class="title">Guest Helpline:</h3>
                    <div class="row">
                        @foreach ($helpline_locations as $key => $helpline_location)
                            <div class="text-center col-6" style="border: 1px solid black; padding: 5px; font-size: 12px;">{{ $helpline_location }} - {{ $helpline_numbers[$key] }}</div>     
                        @endforeach
                    {{-- </div>
                    <div class="row"> --}}
                        <div class="col-6" style="border: 1px solid black; padding: 5px; font-size: 12px;">
                            <h3 class="title">Service Included :</h3>
                            <div>{!! $serviceVoucher->service_included !!}</div>    
                        </div>
                        <div class="col-6" style="border: 1px solid black; padding: 5px; font-size: 12px;">
                            <div class="text-center">
                                <h3 class="title">Service Excluded:</h3>
                                <div>{!! $serviceVoucher->service_excluded !!}</div>    
                            </div>
                        </div>
                        <div class="text-center col-6" style="border: 1px solid black; padding: 5px; font-size: 12px;">{!! $serviceVoucher->support_staf !!}</div>     
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
