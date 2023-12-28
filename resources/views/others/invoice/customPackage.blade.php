@extends('others.invoice.main')
@push('title')
    Package Invoice
@endpush
@section('print')
    <section class="page" style="position: relative;">
        <div class="inv-heading">
            <div>
                <img src="{{ asset('assets/frontend/images/logo.png') }}" class="logo" alt="" height="60px">
            </div>
            <div class="heading-text">
                <h5>{{ $customPackage?->packageType?->package?->name }} {{ Carbon\Carbon::parse($customPackage->created_at)->format('Y') }}</h5>
                <h6>Created on : {{ common_full_month_date_format($customPackage->created_at) }}</h6>
                <h6>Valid till {{ common_full_month_date_format(Carbon\Carbon::parse($customPackage->created_at)->addDays(4)) }}</h6>
            </div>
        </div>
        <div class="inv-body">
            <div class="inv-sec">
                <h6>Package For</h6>
                <div class="content">
                    <p><span>Name</span><span>: {{ $customPackage?->client?->name }}</span></p>
                    <p><span>Cell No.</span><span>: {{ $customPackage?->client?->phone }}</span></p>
                    <p><span>Email ID</span><span>:  {{ $customPackage?->client?->email }}</span></p>
                </div>
            </div>
            <div class="inv-summary">
                <h6>Package Summary</h6>
                <div class="content">
                    <p><span>Package Name</span><span>- {{ $customPackage?->packageType?->name }}</span><span></span></p>
                    <p><span>Total Stay</span><span>- {{ $customPackage->total_stay }} Days - 
                        @foreach ($customPackage->packageHotels as $key => $packageHotel)
                            @if($key != 0)
                                {{ '+' }}
                            @endif
                            {{ $packageHotel?->location?->name.' '.$packageHotel->stay_in }}  Days   
                        @endforeach
                      </span><span></span></p>

                    @php
                      $totalHotelCost = 0;
                    @endphp
                    @foreach ($customPackage->packageHotels as $key => $packageHotel)
                        @php
                            $perDayCost = $packageHotel->room_cost / $customPackage?->nos_of_traveler;
                            $totalCost = $perDayCost * $packageHotel->stay_in;
                            $totalHotelCost += $totalCost;
                        @endphp
                        <p><span>{{ $packageHotel?->location?->name }} Hotel</span><span>- {{ $packageHotel?->hotel?->name }}</span><span>{{ currency_convertion($totalCost, $customPackage->conversion_rate).' Tk' }}</span></p>
                        <p><span></span><span>
                            Room Cost * Conversion Rate
                            <br>
                            {{ $packageHotel->room_cost }} {{ $customPackage?->packageType?->package?->currency?->name .'('.$customPackage?->packageType?->package?->currency?->sign.')' }}  * {{ $customPackage->conversion_rate }}
                            <br>
                            @if($customPackage?->nos_of_traveler > 1)
                                Per Day Cost = {{ currency_convertion($packageHotel->room_cost, $customPackage->conversion_rate).' Tk' }} / {{ $customPackage?->nos_of_traveler }} =
                                {{ currency_convertion($perDayCost, $customPackage->conversion_rate).' Tk' }}
                            @else
                                Per Day Cost = {{ currency_convertion($perDayCost, $customPackage->conversion_rate).' Tk' }}
                            @endif
                            <br>
                            Total Cost = Per Day Cost * Total Stay = {{ currency_convertion($perDayCost, $customPackage->conversion_rate).' Tk' }} *
                            {{ $packageHotel->stay_in }} =
                            {{ currency_convertion($totalCost, $customPackage->conversion_rate).' Tk' }}
                        </span><span></span></p>
                        <p><span>Room Type</span><span>- {{ $packageHotel?->roomType?->name}}</span><span></span></p>
                    @endforeach
                    
                    <p><span>Visa Fee</span><span>- </span><span> {{ common_number_format($customPackage->visa_cost).' Tk' }}</span></p>
                    <p><span>Air Ticket</span><span>- {{ $customPackage?->airline?->name }}</span><span>{{ common_number_format($customPackage?->airline_cost).' Tk' }}</span></p>
                    <p><span>Transport</span><span>- {{ $customPackage?->transport?->name }}</span><span>{{ currency_convertion($customPackage?->transport_cost, $customPackage->conversion_rate).' Tk' }}</span></p>

                    @foreach ($customPackage->packageGuides as $key => $packageGuide)
                        <p><span>Guide </span><span>- {{ $packageGuide?->guide?->name }}</span><span>{{ currency_convertion($packageGuide?->guide_cost, $customPackage->conversion_rate).' Tk' }}</span></p>
                    @endforeach

                    @foreach ($customPackage->packageHotels as $key => $packageHotel)
                        <p><span>Sightseeing ({{ $packageHotel?->location?->name }})</span><span>- {{ $packageHotel?->sightseeing?->name }}</span><span>{{ currency_convertion($packageHotel?->sightseeing_cost, $customPackage->conversion_rate).' Tk' }}</span></p>
                    @endforeach


                    <p><span>Food</span><span>- </span><span>{{ currency_convertion($customPackage?->food_cost, $customPackage->conversion_rate).' Tk' }}</span></p>

                    @php
                        $finalCost = $totalHotelCost+$customPackage->transport_cost+$customPackage->packageHotels->sum('sightseeing_cost')+$customPackage->packageGuides->sum('guide_cost')+$customPackage->food_cost;

                        $finalCostAfterConversion = ($finalCost * $customPackage->conversion_rate) + $customPackage->visa_cost + $customPackage->airline_cost;
                    @endphp
                    <p><b>Cost Per Person</b><b>- BDT {{ common_number_format($finalCostAfterConversion).' Tk' }}</b></p>
                </div>
            </div>
            <div class="inv-notes">
                <b>Notes:</b>
                <div>
                    {!! $customPackage?->packageType?->package?->invoice_note !!}
                </div>

            </div>
            <div class="inv-info">
                <b>Regards</b>
                <p>Rafiq</p>
                <p>8801705401059</p>
                <p>rafiq@zamzamtravelsbd.com</p>
            </div>
            <table class="table table-bordered address-tbl">
                <tbody>
                    <tr>
                        <td>
                            <b>Dhaka Office</b>
                            <p>32 Purana Paltan, Sultan Ahmed Plaza,</p>
                            <p>11th floor, Suite No 1202, Dhaka-1000</p>
                            <p>01733391826, 01705401060</p>
                            <p>www.zamzamtravelsbd.com</p>
                        </td>
                        <td>
                            <b>Makkah Office</b>
                            <p>North al Aziziyah. Makkah</p>
                            <p>+966569907242</p>
                            <p>+966509803009</p>
                            <p>zamzamtravelsbd.com@hotmail.com</p>
                        </td>
                        <td>
                            <b>UK Office</b>
                            <p>524 Conventry Road,</p>
                            <p>Small Heath, Birmingham,</p>
                            <p>UK. 01217735101</p>
                            <p>www.zamzamtravels.org.uk</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-sign" style="margin-top: 5rem!important;">
            <div>
                <p class="signature">Received By</p>
            </div>
            <div>
                <p class="signature">Authorised By</p>
            </div>
        </div>
    </section>
@endsection
