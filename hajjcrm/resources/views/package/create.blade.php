
@extends('layouts.app')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{isset($package) ? 'Update' : 'Add'}} Package</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Package add</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

    @if ($errors->any())
        <div class="row alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
  <form action="{{isset($package) ? route('package.update', $package->id) : route('package.store')}}" method="post">
                @csrf
        <div class="container-fluid">

            <div class="row">
                @if($client)
                    <input type="hidden" name="client_id" value="{{$client->id}}">

                @else
                <label class="p-2 col-sm-1 offset-sm-2 text-right">Client</label>
                    <div class="form-group col-md-3">
                        <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror " >
                            <option value="">Select Client</option>
                            @foreach($clients as $cl)
                            <option @selected(($package->client_id ?? old('client_id'))==$cl->id) value="{{$cl->id}}">{{$cl->givenName}} {{$cl->surName}} ({{$cl->groupNo}})</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <label class="p-2 col-sm-1  text-right">Package</label>
                    <div class="form-group col-md-3">
                        <select name="packageinfo_id" id="package_info_id" class="form-control @error('packageinfo_id') is-invalid @enderror " >
                            <option value="">Select Package</option>
                            @foreach($packageInfos as $pi)
                            <option value="{{$pi->id}}" >{{$pi->name}} </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="row" id="namegroup" style="display: none;">
                <label class="col-sm-4 text-right offset-sm-2">Name: <span id="name"></span></label>
                <label class="col-sm-4 text-left">Phone: <span id="phone"></span></label>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12 mb-3">
                    <ul id="progressbar">
                        <li class="active">Air Ticket</li>
                        <li>Hotel Detail</li>
                        <li>Transport</li>
                        <li>Sightseen</li>
                        <li>Guide</li>
                        <li>Visa & Charge</li>
                        <li>Finish</li>
                    </ul>
                </div>

                <div class="col-sm-8 offset-2 border p-3 text-center section">

                    <h3>Air Ticket</h3>

                    <select name="flight_id" id="flight_id" class="form-control m-3" id>
                        <option value="" disabled>Select Air Ticket</option>
                        @foreach($flight_infos as $fl)
                        <option value="{{$fl->id}}" cost="{{$fl->cost}}">{{$fl->name}}</option>
                        @endforeach

                    </select>
                    <button class="btn btn-success next">Next</button>
                </div>
                <div class="col-sm-12  border p-3 text-center section " style="display:none">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Hotel Detail Makkah</h3>
                            <select name="hotel_mak" class="form-control mt-3 mb-3" id="hotel_mak">
                                <option value="" >Select Option</option>

                            </select>
                            <label for="">Stays</label>
                            <input type="text" name="mak_stays" id="mak_stays" class="form-control">
                            <label for="">Room Type</label>
                            <select name="mak_room_type" class="form-control mb-3 mt-0" id="mak_room_type">
                                <option value="" >Select Option</option>
                                <option value="double">Double</option>
                                <option value="triple">Triple</option>
                                <option value="quad">Quad</option>

                            </select>
                            <label for="">Food</label>
                            <select name="mak_food_type" class="form-control mb-3 mt-0" id="mak_food_type">
                                <option value="" >Select Option</option>
                                <option value="ro">None</option>
                                <option value="bb">Breakfast</option>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinnar</option>
                                <option value="full">Full Board </option>
                            </select>
                        </div>

                        <div class="col-sm-6">

                            <h3>Hotel Detail Madinah</h3>
                            <select name="hotel_mad" class="form-control mt-3 mb-3" id="hotel_mad">
                                <option value="" >Select Option</option>

                            </select>
                            <label for="">Stays</label>
                            <input type="text" name="mad_stays" id="mad_stays" class="form-control">
                            <label for="">Room Type</label>
                            <select name="mad_room_type" class="form-control mb-3 mt-0" id="mad_room_type">
                                <option value="" >Select Option</option>
                                <option value="double">Double</option>
                                <option value="triple">Triple</option>
                                <option value="quad">Quad</option>

                            </select>
                            <label for="">Food</label>
                            <select name="mad_food_type" class="form-control mb-3 mt-0" id="mad_food_type">
                                <option value="" >Select Option</option>
                                <option value="ro">None</option>
                                <option value="bb">Breakfast</option>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinnar</option>
                                <option value="full">Full Board </option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success next">Next</button>

                </div>
                <div class="col-sm-8 offset-2 border p-3 text-center section  " style="display:none">
                    <h3>Transportation</h3>
                    <p>Route : JED-MAK-MED-MED/JED Airport </p>
                    <select name="transportation" class="form-control" id="transportation">

                        <option  cost="0" pax="1">None</option>
                        @foreach($transports as $trans)
                        <option value="{{$trans->id}}" cost="{{$trans->cost}}" pax="{{$trans->pax}}">{{$trans->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success next">Next</button>
                </div>
                <div class="col-sm-8 offset-2 border p-3 text-center section  " style="display:none">
                    <h3>Sightseeing</h3>
                    <p>Makkah & Madinah  </p>
                    <select name="sightseeing" class="form-control" id="sightseeing">
                        <option cost="0" pax="1">None</option>
                        @foreach($transports as $tr)
                        <option value="{{$tr->id}}" cost="{{$tr->sightcost}}" pax="{{$tr->paxsight}}">{{$tr->name}}</option>
                        @endforeach

                    </select>

                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success next">Next</button>
                </div>
                <div class="col-sm-8 offset-2 border p-3 text-center section  " style="display:none">
                    <h3>Guide</h3>
                    <p>Makkah & Madinah</p>
                    <select name="" multiple class="form-control" id="guide">
                        <option value="" disabled>Select Option</option>
                        <option>None</option>
                        @foreach($supportcost as $gd)
                            <option value="{{$gd->id}}" cost="{{$gd->cost}}" pax="{{$gd->pax}}">{{$gd->name}}</option>
                        @endforeach

                    </select>
                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success next">Next</button>
                </div>
                <div class="col-sm-8 offset-2 border p-3 text-center section  " style="display:none">
                    <h3>Visa & Charge</h3>
                    <label for="">Visa</label>
                    <input type="text" class="form-control" name="visa_charge" id="visa_charge" value="{{$gSetting->visa_cost}}" disabled>
                    <label for="" class=" d-none">No of Person</label>
                    <select name="no_person" class="form-control d-none" id="no_person">

                        <option value="1">1</option>

                    </select>
                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success next">Next</button>
                </div>
                <div class="col-sm-8 offset-2 border p-3 text-center section  " style="
                display:none
                ">
                    <h3>Summery</h3>
                    <p>Client: <span id="clientName"></span></p>
                    <p>Package: <span id="packageName"></span></p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr></tr>
                            <tr>
                                <th width="15%">Item</th>
                                <th>Desc</th>
                                <th width="15%">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Air Ticket
                                </td>
                                <td>
                                    <span id="airTicket">Direct Flight Regular</span>
                                </td>
                                <td>
                                    <span id="airTicketCost">15,000.00</span>៛
                                    <input type="hidden" name="flight_value" id="airTicketCostVal">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Hotel Details - Makkah</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span id="makHotel">Emaar al Andalusiya / Similar</span> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Room Type</td>
                                <td>
                                    <span id="makRoomType">Double</span>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>Food Type</td>
                                <td>
                                    <span id="makFoodType">Double</span>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>Makkah Stays</td>
                                <td>
                                <span id="makstays">3</span> Days
                                </td>
                                <td>
                                    <span id="makHotelCost">70,000.00</span>៛
                                    <input type="hidden" name="mak_hotel_value" id="makHotelCostVal">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Hotel Details - Madinah</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span id="madHotel">Zower International / ODST / Similar</span>  </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Room Type</td>
                                <td>
                                    <span id="madRoomType">Double</span>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>Food Type</td>
                                <td>
                                    <span id="madFoodType">Double</span>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>Madinah Stays</td>
                                <td>
                                <span id="madStays">3</span> Days
                                </td>
                                <td>
                                    <span id="madHotelCost">70,000.00</span>៛
                                    <input type="hidden" name="mad_hotel_value" id="madHotelCostVal">
                                </td>
                            </tr>
                            <tr>
                                <td>Total Stays</td>
                                <td>
                                <span id="totalStays">3</span> Days
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>Transportation </td>
                                <td><span id="trasport">ar - Maximum 3 Pax</span></td>
                                <td>
                                    <span id="trasportcost">1,500.00</span>៛
                                    <input type="hidden" name="transportation_value" id="trasportcostVal">
                                </td>
                            </tr>
                            <tr>
                                <td>Sightseeing </td>
                                <td><span id="sight">ar - Maximum 3 Pax</span></td>
                                <td>
                                    <span id="sightcost">1,500.00</span>៛
                                    <input type="hidden" name="sightseeing_value" id="sightcostVal">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Guide
                                </td>
                                <td><span id="guideT">Meet & Assist,
                                With Sightseeing,
                                During Umrah Perform</span>
                                <input type="hidden" name="guide" id="guideTVal">
                            </td>
                                <td>
                                    <span id="guideCost">1,800.00</span>៛
                                    <input type="hidden" name="guide_charge" id="guideCostVal">
                                </td>
                            </tr>
                            <tr>
                                <td>Visa</td>
                                <td>Visa Charge</td>
                                <td>
                                    <span id="visaCost">27,000.00</span>៛
                                    <input type="hidden" name="visa_charge" id="visaCostVal">
                                </td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td>Service Charge</td>
                                <td>
                                    <span id="serviceCost">3,000.00</span>៛
                                    <input type="hidden" name="serice_charge" id="serviceCostVal">
                                </td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Total</th>

                                <th>
                                    <span id="grandtotalCost">2,00,000.00</span>៛
                                    <input type="hidden" name="total_rel" id="grandtotalCostVal">
                                </th>
                            </tr>
                            <tr>
                                <th  class="text-right">BDT</th>
                                <th>@ {{$gSetting->conversion_rate}} ৳</th>

                                <th>
                                    <span id="grandtotalCostBdt">2,00,000.00</span>৳
                                    <input type="hidden" name="total_bdt" id="grandtotalCostBdtVal">
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    <button class="btn btn-secondary previous">Previous</button>
                    <button class="btn btn-success">Submit</button>
                </div>

            </div>
        </div>
    </form>





        </sectioin>

        @endsection


@push('css')

<style>
    #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}

#progressbar li {
    list-style-type: none;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    width: 14.2%;
    float: left;
    position: relative;
    letter-spacing: 1px;
}

#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: block;
    font-size: 14px;
    color: #333;
    background: white;
    border-radius: 25px;
    margin: 0 auto 10px auto;
}

/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}

#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none;
}

/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #ee0979;
    color: white;
}

</style>

@endpush

@push('js')
<script>

    let conversion_rate = {{$gSetting->conversion_rate}}
    let service_charge = {{$gSetting->service_charge}}
$(function () {
    $('#ppIssueDate, #ppExpiryDate, #dateofBirth').datetimepicker({
        format: 'L'
    });


})

$('#client_id').change(function(){
    console.log('client id', $(this).val())
    $.get("/admin/client/"+ $(this).val() +"/show", function(data, status){
        console.log(data, data.givenName)
        $('#name').text(data.givenName + ' ' +data.surName)

        $('#phone').text(data.Mobile)
        $('#namegroup').show()
        $('#clientName').text(data.givenName + ' ' +data.surName + ' ' + data.Mobile)
    });
})

$('#package_info_id').change(function(){
    // console.log('package_info_id', $(this).val())
    $('#packageName').text($('#package_info_id option:selected').text())

    $.get("/admin/hotelinfo/Makkah/"+ $(this).val(), function(data, status){
        console.log(data)
        let op="<option>Select Option</option>"
        data.map(function (d){
            console.log(d)
             op +=`<option value="${d.id}" double="${d.double_price}" quad="${d.quad}" triple="${d.triple}" bb="${d.bb}" lunch="${d.lunch}" dinner="${d.dinner}" full="${d.full}">${d.name}</option>`
            $('#hotel_mak').empty().append(op);
        })


    });
    $.get("/admin/hotelinfo/Madinah/"+ $(this).val(), function(data, status){
        console.log(data)
        let op="<option>Select Option</option>"
        data.map(function (d){
            console.log(d)
            op +=`<option value="${d.id}" double="${d.double_price}" quad="${d.quad}" triple="${d.triple}">${d.name}</option>`
            $('#hotel_mad').empty().append(op);
        })
    });
})
$('#mak_room_type').change(function(){
    $('#mad_room_type').val($('#mak_room_type').val()).attr('disabled', true)
})

function getClient(){
}

function calsot(){
    let flight_name = $('#flight_id option:selected').text()
    let flight_cost = $('#flight_id option:selected').attr('cost')
    $('#airTicket').text(flight_name)
    $('#airTicketCost').text(parseFloat(flight_cost/conversion_rate).toFixed(2))
    $('#airTicketCostVal').val(parseFloat(flight_cost/conversion_rate))
    let hotel_mak = $('#hotel_mak option:selected').text()
    let mak_stays=$('#mak_stays').val()
    let mak_room_type = $('#mak_room_type  option:selected').text()

    let mak_food_type = $('#mak_food_type  option:selected').text()
    let hotel_mak_singlecost=$('#hotel_mak option:selected').attr($('#mak_room_type').val())

    let hotel_mak_food_singlecost=0

    if($('#mak_food_type').val()!='ro'){
        hotel_mak_food_singlecost=$('#hotel_mak option:selected').attr($('#mak_food_type').val())
    }

    let hotel_mak_cost = parseFloat(hotel_mak_singlecost + hotel_mak_food_singlecost) * parseInt(mak_stays)

    $('#makHotel').text(hotel_mak)
    $('#makRoomType').text(mak_room_type)
    $('#makFoodType').text(mak_food_type)
    $('#makstays').text(mak_stays)
    $('#makHotelCost').text(hotel_mak_cost.toFixed(2))
    $('#makHotelCostVal').val(hotel_mak_cost)

    let hotel_mad = $('#hotel_mad option:selected').text()
    let mad_stays=$('#mad_stays').val()
    let mad_room_type = $('#mad_room_type  option:selected').text()
    let mad_food_type = $('#mad_food_type  option:selected').text()
    let hotel_mad_singlecost=$('#hotel_mad option:selected').attr($('#mad_room_type').val())
    let hotel_mad_food_singlecost=0
    if($('#mad_food_type').val()!='ro') {
        hotel_mad_food_singlecost=$('#hotel_mad option:selected').attr($('#mad_food_type').val())
    }
    let hotel_mad_cost = parseFloat(hotel_mad_singlecost + hotel_mad_food_singlecost) * parseInt(mad_stays)

    $('#madHotel').text(hotel_mad)
    $('#madRoomType').text(mad_room_type)
    $('#madFoodType').text(mad_food_type)
    $('#madStays').text(mad_stays)
    $('#totalStays').text(parseInt(mak_stays) + parseInt(mad_stays))
    $('#madHotelCost').text(hotel_mad_cost.toFixed(2))
    $('#madHotelCostVal').val(hotel_mad_cost)
    let transportation = $('#transportation option:selected').text()
    let transportationcost = $('#transportation option:selected').attr('cost')
    let transportationperson = $('#transportation option:selected').attr('pax')

    $('#trasport').text(transportation)
    $('#trasportcost').text((parseFloat(transportationcost)/ parseInt(transportationperson)).toFixed(2))
    $('#trasportcostVal').val((parseFloat(transportationcost)/ parseInt(transportationperson)))

    let sightseeing = $('#sightseeing option:selected').text()
    let sightseeingcost = $('#sightseeing option:selected').attr('cost')
    let sightseeingperson = $('#sightseeing option:selected').attr('pax')

    $('#sight').text(sightseeing)
    $('#sightcost').text((parseFloat(sightseeingcost)/ parseInt(sightseeingperson)).toFixed(2))
    $('#sightcostVal').val((parseFloat(sightseeingcost)/ parseInt(sightseeingperson)))


    let guide=$('#guide').val()

    let totalguidecost=0
    let guidetext=''
    guide.map(function(g){
        g=parseInt(g)+1
        totalguidecost +=parseInt($('#guide option').eq(g).attr('cost'))
        guidetext += $('#guide option').eq(g).text() + ', '
    })
    $('#guideT').text(guidetext)
    $('#guideTVal').val(guidetext)
    $('#guideCost').text(totalguidecost.toFixed(2))
    $('#guideCostVal').val(totalguidecost)
    let visa_charge= $('#visa_charge').val()
    $('#visaCost').text((visa_charge/conversion_rate).toFixed(2))
    $('#visaCostVal').val((visa_charge/conversion_rate))
    let no_person =$('#no_person').val()

    let serviceCost=service_charge/conversion_rate * parseInt(no_person)
    $('#serviceCost').text(serviceCost.toFixed(2))
    $('#serviceCostVal').val(serviceCost)

    let grandtotalCost = parseFloat(visa_charge)/conversion_rate
            + parseFloat(serviceCost)
            + parseFloat(totalguidecost)
            + parseFloat(sightseeingcost)/ parseInt(sightseeingperson)
            + parseFloat(transportationcost)/ parseInt(transportationperson)
            + parseFloat(hotel_mak_cost)
            + parseFloat(hotel_mad_cost)
            + parseFloat(flight_cost)
    $('#grandtotalCost').text(grandtotalCost.toFixed(2))
    $('#grandtotalCostVal').val(grandtotalCost)

    $('#grandtotalCostBdt').text((grandtotalCost * conversion_rate).toFixed(2))
    $('#grandtotalCostBdtVal').val((grandtotalCost * conversion_rate))

}



//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(e){
    e.preventDefault()
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($(".section").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        // 'position': 'absolute'
      });
			next_fs.css({'opacity': opacity});
		},
		duration: 400,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
    calsot();
});

$(".previous").click(function(e){
    e.preventDefault()
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//de-activate current step on progressbar
	$("#progressbar li").eq($(".section").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			// current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		},
		duration: 400,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
    calsot()
});

$(".submit").click(function(){
	return false;
})
</script>
@endpush
