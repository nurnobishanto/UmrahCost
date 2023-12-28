<!DOCTYPE html>
<html lang="en">


<head>
    <style>

        .table td, .table th {
            padding: .05rem !important;
            border-top: 1px solid #fff !important;
/*            border-bottom: 1px solid #585858 !important;*/

        }
    </style>
    <title>Package Print</title>


<body>
    <main role="main" class="container" style="margin-top: 100px">
        <div class="row">

            <div class="col-3">

                <div class="row">
                    <div class="col-12 text-center">
                    <img src="{{asset('img/zamzamlogofinal.png')}}" height="150px" width="150px" alt="">
                    </div>
                </div>
            </div>
            <div class="col-9">
                 <div class="row">
                    <div class="col-12 mt-4 border border-dark text-black text-center">
                        <h3 class="" style="color:Green;"><b>Umrah Package 2021</b></h3>
                        <h5><b>Created on : {{$package->created_at}}</b></h5>
                        <h5 class="text-danger"><b>Valid till </b></h5>
                    </div>
                </div>
           </div>

        </div>

        <hr />
        <columns column-count="2" vAlign="J" column-gap="7" />
        <div class="row text-center">
            <div class="col-12">
                <h6 class="text-left"> <b><u>Package For</u></b></h6>
            </div>
        </div>
        <table class="table">

            <tbody>
                    <tr>
                        <td class="w-25">Name</td>
                        <td>:</td>
                        <td>{{$package->client->givenName}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Cell No.</td>
                        <td>:</td>
                        <td>{{$package->client->Mobile}}</td>
                    </tr>
                    <tr>
                        <td class="w-25">Email ID</td>
                        <td>:</td>
                        <td>{{$package->client->email}}</td>
                    </tr>
            </tbody>
        </table>
        <columnbreak />
        <div class="row text-center">
            <div class="col-12" style="margin-top: 50px">
                <h6 class="text-left"> <b><u>Package Summary</u></b></h6>

            </div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td class="w-25">Package Name</td>
                    <td>-</td>
                    <td>{{$package->packageInfo->name}}</td>
                </tr>
                <tr>
                    <td class="w-25">Total Stay</td>
                    <td>-</td>
                    <td>{{$package->total_stays}}</td>
                </tr>
                <tr>
                    <td class="w-25">Makkah Hotel</td>
                    <td>-</td>
                    <td>{{$package->mak_stays}}</td>
                </tr>
                <tr>
                    <td class="w-25">Madinah Hotel</td>
                    <td>-</td>
                    <td>{{$package->mad_stays}}</td>
                </tr>
                <tr>
                    <td class="w-25">Room Type</td>
                    <td>-</td>
                    <td>{{$package->mak_room_type}}</td>
                </tr>
                <tr>
                    <td class="w-25">Visa Fee</td>
                    <td>-</td>
                    <td>Included</td>
                </tr>
                <tr>
                    <td class="w-25">Travel Insurance</td>
                    <td>-</td>
                    <td>Included</td>
                </tr>
                <tr>
                    <td class="w-25">Air Ticket</td>
                    <td>-</td>
                    <td>{{$package->flightInfo->name}}</td>
                </tr>
                <tr>
                    <td class="w-25">Transport</td>
                    <td>-</td>
                    <td>All ground transport in KSA  ( Bus / Private Car)</td>
                </tr>
                <tr>
                    <td class="w-25">PCR Test in KSA</td>
                    <td>-</td>
                    <td>Included</td>
                </tr>
                <tr>
                    <td class="w-25">PCR Test in BD</td>
                    <td>-</td>
                    <td>Excludes</td>
                </tr>

                <tr>
                    <td class="w-25">Sightseeing</td>
                    <td>-</td>
                    <td>Not Included / Optional</td>
                </tr>
                <tr>
                    <td class="w-25">Food</td>
                    <td>-</td>
                    <td>Not Included / Optional</td>
                </tr>
                <tr>
                    <td class="w-25">Guide</td>
                    <td>-</td>
                    <td>Optional (Due to MOH permission)</td>
                </tr>
                <tr>
                    <td class="w-25"> <h4><b>Cost Per Person</b></h4></td>
                    <td><h4><b>-</b></h4></td>
                    <td><h4><b>BDT {{$package->total_bdt}}</b></h4></td>
                </tr>
            </tbody>
        </table>


        <columnbreak />
        <div class="row text-center">
            <div class="col-12">
                <h6 class="text-left"> <b>Notes :</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Requirements:<br><br>&bull; &nbsp; &nbsp;COVID-19 Vaccination Certificate.<br>&bull; &nbsp; &nbsp;Bangladeshi passport valid for at least 6 months.<br>&bull; &nbsp; &nbsp;2 copies passport size white background photographs<br><br>Payment Policy:<br><br>&bull; &nbsp; &nbsp;Phase-1 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 75% of the total package amount at the time of booking.<br>&bull; &nbsp; &nbsp;Phase-2 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 25% of total package amount at the time of package confirmation<br><br>Cancellation Policy<br>&bull; &nbsp; &nbsp;Package cost completely NON Refundable, Non Changeable &amp; Non Transferable. Only Air fare may partial returnable / Adjustable.<br><br>Itinerary<br>&bull; &nbsp; &nbsp;Will be provided after confirmation booking.<br><br>Others Information:<br>&bull; &nbsp; &nbsp;Package price applicable for Numbers of Person Group basis.<br>&bull; &nbsp; &nbsp;Similar category of hotel will be provided in case of quoted hotel room not available.<br>&bull; &nbsp; &nbsp;Pilgrims must be over 18 years old.<br>&bull; &nbsp; &nbsp;Travel Must be after 14 Days (Minimum) on taking the vaccine<br>&bull; &nbsp; &nbsp;COVID-19 Vaccination certificate MUST along with the passport.<br>&bull; &nbsp; &nbsp;PCR test has to be done within 48 hours of arrival in KSA and COVID-19 negative certificate MUST hold along with.<br>&bull; &nbsp; &nbsp;Pilgrims must always be connected to the internet. Download two apps Tawakkalna and Eatmarna ( available in Play Store and Apple Store )<br>&bull; &nbsp; &nbsp;Performing Holy Umrah is allowed for one time only with prior permission obtains through Mobile Apps.<br>&bull; &nbsp; &nbsp;Maximum two people can stay in one room.<br>&bull; &nbsp; &nbsp;All services depend on subject to availability at the time of booking and package cost can be changed upon room/hotel availability.<br>&bull; &nbsp; &nbsp;Any changes can occur without prior notice.<br>&bull; &nbsp; &nbsp;ZamZam Travels BD reserves the right to charge an extra amount for any tour package inclusion<br>&bull; &nbsp; &nbsp;Pilgrim has to pay any unexpected charges are added by the legal authorities (KSA &amp; BD).</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h6 class="text-center"></h6>
            </div>
        </div>


        <div class="row text-center">
            <div class="col-12" style="margin-top: 50px">
                <h6 class="text-left"> <b>Regards</b></h6>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h6 class="text-left"> <b></b></h6>
            </div>
        </div>


        <h6 class="text-left"></h6>
        <h6 class="text-left"></h6>
        <h6 class="text-left"></h6>


        <div class="row">
           <div class="col-12">
            <h6 class="text-right text-danger"><b>* Condition Apply</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mt-4">
                <div class="row">
                    <div class="col-12 border border-dark text-center">
                       <h6 class="text-left"><u><b>Dhaka Office</b></u></h6>
                        <p class="text-left">
                            32 Purana Paltan, Sultan Ahmed Plaza, <br>
                            11th floor, Suite No 1202, Dhaka-1000 <br>
                            01733391826, 01705401060 <br>
                            www.zamzamtravelsbd.com <br>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-4 mt-4">
                <div class="row">
                    <div class="col-12 border border-dark text-center">
                       <h6 class="text-left"><u><b>Makkah Office</b></u></h6>
                        <p class="text-left">
                            North al Aziziyah. Makkah<br>
                            +966569907242<br>
                            +966509803009<br>
                            zamzamtravelsbd.com@hotmail.com<br>
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-4 mt-4">
                <div class="row">
                    <div class="col-12 border border-dark text-center">
                       <h6 class="text-left"><u><b>UK Office</b></u></h6>
                        <p class="text-left">
                            524 Conventry Road,<br>
                            Small Heath, Birmingham,<br>
                            UK. 01217735101<br>
                            www.zamzamtravels.org.uk<br>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>

</html>
