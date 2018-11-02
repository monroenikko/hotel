@extends('layouts.adminLayout.admin_design')

@section ('content_title')
Room Multiple Check-in
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href=""  class="current">Check-in</a> </div>
      <h1><img src="{{ asset('images/checkin.png') }}"  />Check-in</h1>

      <div class="container-fluid">

        @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{!! session('flash_message_error')!!}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{!! session('flash_message_success')!!}</strong>
            </div>
        @endif

      </div>

    </div>

    <div class="container-fluid">
            <hr>
    <div class="row-fluid">
        <div class="span2">
        </div>
            <div class="span7" id="1st">
                    {{--  <div class="container-fluid">  --}}
                            <div class="widget-box" >
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Select the Status</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="" name="" id="" novalidate="novalidate">{{ csrf_field() }}


                                        <div class="control-group">
                                            <label class="control-label">Select Transaction</label>
                                                <div class="controls">
                                                    <select class="span11" value="0"  id="status" name="status">
                                                            <option value="0">-----Select here------</option>
                                                            <option value="Reserved" >Reservation</a></option>
                                                            <option value="Occupied">Walk-in</option>

                                                    </select>
                                                </div>
                                        </div>

                                        <p id="demo" style="display:none"></p>


                                        <div class="form-actions">
                                            <input type="button" value="Next" id="next" class="btn btn-success pull-right">
                                        </div>
                                    </form>
                                </div>
                            </div>



                      {{--  </div>  --}}
            </div>



    </div>

    <div class="row-fluid">
            <div class="span7" id="2nd" style="display: none">
                    {{--  <div class="container-fluid">  --}}
                            <div class="widget-box" >
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Guest Information</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="" name="occupy_room" id="occupy_room" novalidate="novalidate">{{ csrf_field() }}

                                        <input type="hidden"  class="span11" name="result_id1" id="result_id1">

                                            {{--  <label class="control-label">RSVN Number</label>  --}}

                                            <input type="hidden" class="span11" name="occupy_rsvn" id="occupy_rsvn" >
                                            {{--  <input type="number"  class="span11" name="occupy_rsvn1" id="occupy_rsvn1" disabled="disabled">  --}}



                                        <div class="control-group">
                                            <label class="control-label">First Name</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="occupyfirstname" id="occupyfirstname">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Last Name</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="occupylastname" id="occupylastname">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Arrival Date</label>
                                            <div class="controls">
                                                <input type="text" id="occupydatefrom" name="occupydatefrom"   data-date-format="yyyy/m/d"  class="datepicker span11">
                                                {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                             </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Departure Date</label>
                                            <div class="controls">
                                                <input type="text" id="occupydateto" name="occupydateto"  data-date-format="yyyy/m/d" class="datepicker span11">
                                                {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                             </div>
                                        </div>


                                            {{--  <label class="control-label">Number of Night(s)</label>  --}}
                                            <input type="hidden" class="span7" name="ototalnight" id="ototalnight">
                                            <input type="hidden" class="span7" name="ototalbill1" id="ototalbill1">
                                            <input type="hidden" class="span7" name="ototalbalance1" id="ototalbalance1">
                                            <input type="hidden" class="span7" name="roomcat" id="roomcat" value="">

                                        <div class="control-group">
                                            <label class="control-label">Origin</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="origin1" id="origin1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Flight No.</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="flight_no1" id="flight_no1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Time of Departure</label>
                                            <div class="controls">
                                                <input type="text" name="timedeparture1" class="timepicker"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Company Name/Address</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="c_address1" id="c_address1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Nationality</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="nationality1" id="nationality1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Contact No.</label>
                                            <div class="controls">
                                                <input type="number"  class="span11" name="contact_no1" id="contact_no1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Address</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="address1" id="address1">


                                            </div>
                                        </div>



                                        <div class="control-group">
                                            <label class="control-label">Bill Arrangement</label>
                                            <div class="controls">
                                                <label>
                                                    <input type="radio" name="radios" id="cash1" value="Cash" />
                                                    Cash
                                                </label>
                                                <label>
                                                    <input type="radio" name="radios" id="credit_card1" value="Credit Card" />
                                                    Credit Card
                                                </label>
                                                <input type="hidden"  class="span11" name="billarrangement1" id="billarrangement1">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Downpayment</label>
                                            <div class="controls">
                                                <input type="text" value="0" class="span11" name="occupydownpayment" id="occupydownpayment">


                                            </div>
                                        </div>

                                                {{--  <label class="control-label">Total Cost ₱</label>  --}}
                                                {{--  <input type="text" name="oresultcost" id="oresultcost" value="0">  --}}
                                                {{--  <input type="text" class="span11" name="total_cost2" id="total_cost2" value="0" disabled="disabled">  --}}




                                        <div class="form-actions">
                                            <input type="button" value="Back" id="back" class="btn btn-success pull-left">

                                            <input type="submit" value="Occupy" class="btn btn-success pull-right">
                                        </div>
                                    </form>
                                </div>
                            </div>



                      {{--  </div>  --}}
            </div>

            <div class="span5" id="5th" style="margin-top: 1.3em; display:none">
                    <table class="table table-bordered table-invoice table-striped">
                        <tbody>
                            <tr>
                                <tr>
                                    <td colspan="2"><i class="icon-info-sign"></i> Occupied Transaction Details:</td>
                                </tr>
                                    <tr>
                                        <td style="width:140px">RSVN No.</td>
                                        <td id="occupy_rsvn1"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Customer Name</td>
                                        <td><span id="fn1"></span> <span id="ln1"></span></td>
                                    </tr>

                                    <tr>
                                        <td style="width:140px">Arrival Date</td>
                                        <td id="arrivaldate2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Departure Date</td>
                                        <td id="departuredate2"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Night(s)</td>
                                        <td id="occupytotal">0</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room No.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room Type</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room Rate</td>
                                        <td>
                                            ₱
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Bill </td>
                                            <td>
                                                ₱ <span id="ototalbill">0</span>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Downpayment </td>
                                            <td>
                                                ₱ <span id="odownpayment">0</span>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Balance </td>
                                            <td>
                                                ₱ <span id="ototalbalance">0</span>
                                            </td>
                                    </tr>


                            </tr>
                        </tbody>

                    </table>
            </div>
    </div>

        <div class="row-fluid">
            <div class="span5" id="4th" style="display: none">

                        <div class="widget-box" >
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Guest Information</h5>


                            </div>

                            <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{ url('multiple_reservation/getReserve/'.$rs = $lastBooking->booking_rsvn_no + 1) }}" name="checkin" id="checkin" novalidate="novalidate">{{ csrf_field() }}


                                        {{--  <label class="control-label">RSVN Number</label>  --}}

                                            <p id="rsvn_no" style="display: none">{{ $lastBooking->booking_rsvn_no }}</p>


                                            <p id="customer_id" style="display: none">{{ $lastCustId->customer_id }}</p>
                                            <input type="hidden"  class="span11" name="result_id" id="result_id">


                                            <input type="hidden"  class="span11" name="room_id" id="room_id" value="">


                                        {{--  <label class="control-label">Room Type</label>  --}}
                                            <input type="hidden"  class="span11" name="room_type" id="room_type" value="">


                                        {{--  <label class="control-label" for="room_rate2">Room Rate ₱</label>  --}}
                                            {{-- <span class="add-on">₱</span> --}}
                                            <p id="room_rate1" style="display: none"></p>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">RSVN NO</label>
                                        <div class="controls">
                                            <input type="hidden"  class="span11" name="result_rsvn_no" id="result_rsvn_no" >
                                            <input type="text" disabled="" class="span11" id="resulRsvn" value="{{ str_pad($lastBooking->booking_rsvn_no, 10, '0', STR_PAD_LEFT) }}">
                                        </div>
                                    </div>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">First Name</label>
                                        <div class="controls">
                                            <input type="text"  class="span11" name="firstname" id="firstname">
                                        </div>
                                    </div>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">Last Name</label>
                                        <div class="controls">
                                            <input type="text"  class="span11" name="lastname" id="lastname">
                                        </div>
                                    </div>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">Downpayment</label>
                                        <div class="controls">
                                            <input type="number" class="span11" name="downpayment" id="downpayment" placeholder="1000.00">
                                        </div>
                                    </div>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">Arrival Date</label>
                                        <div class="controls">
                                            <input type="text" id="datefrom2" name="datefrom2" data-date-format="yyyy/m/d"  class="datepicker span11">
                                            {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                         </div>
                                    </div>

                                    <div class="control-group" style="margin-left: -1.5em">
                                        <label class="control-label">Departure Date</label>
                                        <div class="controls">
                                            <input type="text" id="dateto2" name="dateto2"  data-date-format="yyyy/m/d"  class="datepicker span11">
                                            {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                         </div>
                                    </div>



                                    <div class="control-group" style="margin-left: -1.5em">
                                                <label class="control-label">Room No.</label>
                                                    <div class="controls">
                                                        <select class="span11" value="0"  id="roomno" name="roomno">
                                                                <?php echo $room; ?>
                                                        </select>
                                                    </div>
                                            </div>




                                            {{--  <label class="control-label">Total night(s)</label>  --}}

                                                <input type="hidden" name="result1" id="result1" value="0">

                                            {{--  <label class="control-label">Total Cost ₱</label>  --}}

                                                <input type="hidden" name="total_costt1" id="total_costt1" value="0">



                                        {{--  <label class="control-label">Total Balance ₱</label>  --}}

                                            <input type="hidden" name="total_balance1" id="total_balance1" value="0">



                                    <div class="form-actions">
                                        <input type="button" value="Back" id="back3" class="btn btn-success pull-left">

                                        <input type="submit" value="Reserve" class="btn btn-success pull-right">
                                    </div>
                                </form>
                            </div>
                        </div>




            </div>



        </div>
    </div>

</div>


@endsection

@section('scripts')
<script>
        $('#occupydatefrom').focusout(function() {
            $('#arrivaldate2').text($('#occupydatefrom').val());

            $('#departuredate2').text($('#occupydateto').val());

            var date1 = new Date($("#occupydatefrom").val());
            var date2 = new Date($("#occupydateto").val());
            console.log(date2);

            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('ototalnight').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#occupytotal').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());
            var rate = $('#room_rate1').text();
            var downpayment1 = $('#occupydownpayment').val();
            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));

            var total_cost1 = rate * diffDays;
            document.getElementById('ototalbill1').value = (total_cost1);
            // document.getElementById('oresultcost').value = (total_cost1);
            // $("#ototalbill").text(total_cost1);
            var parts = total_cost1.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#ototalbill").text(num);


            var totalbalance = total_cost1 - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('ototalbalance').innerHTML = withCommas;

            document.getElementById('ototalbalance1').value = (totalbalance);
        });

        $("#occupydateto").focusout(function() {
            $('#departuredate2').text($('#occupydateto').val());

            var date1 = new Date($("#occupydatefrom").val());
            var date2 = new Date($("#occupydateto").val());
            console.log(date2);

            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('ototalnight').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#occupytotal').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());
            var rate = $('#room_rate1').text();
            var downpayment1 = $('#occupydownpayment').val();
            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));

            var total_cost1 = rate * diffDays;
            document.getElementById('ototalbill1').value = (total_cost1);
            // document.getElementById('total_costt2').value = (total_cost1);
            // $("#ototalbill").text(total_cost1);
            var parts = total_cost1.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#ototalbill").text(num);


            var totalbalance = total_cost1 - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('ototalbalance').innerHTML = withCommas;

            document.getElementById('ototalbalance1').value = (totalbalance);
        });

        $('#occupydownpayment').keyup(function() {
            $('#odownpayment').text($('#occupydownpayment').val());
            var downpayment2 = $('#occupydownpayment').val();

            downpayment2 = parseFloat(downpayment2).toFixed(2);
            var withCommas1 = Number(downpayment2).toLocaleString('en');
            document.getElementById('odownpayment').innerHTML = withCommas1;


            $('#departuredate2').text($('#occupydateto').val());
            var date1 = new Date($("#occupydatefrom").val());
            var date2 = new Date($("#occupydateto").val());
            console.log(date2);

            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('ototalnight').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#occupytotal').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());
            var rate = $('#room_rate1').text();
            var downpayment1 = $('#occupydownpayment').val();
            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));

            var total_cost1 = rate * diffDays;
            document.getElementById('ototalbill1').value = (total_cost1);
            // document.getElementById('total_costt2').value = (total_cost1);
            // $("#ototalbill").text(total_cost1);
            var parts = total_cost1.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#ototalbill").text(num);


            var totalbalance = total_cost1 - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            // $("#ototalbalance").text(totalbalance);
            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('ototalbalance').innerHTML = withCommas;

            document.getElementById('ototalbalance1').value = (totalbalance);
        });

        $("#datefrom2").focusout(function() {
            $('#arrivaldate').text($('#datefrom2').val());

            var downpayment1 = $('#downpayment').val();
            $('#departuredate').text($('#dateto2').val());
            var date1 = new Date($("#datefrom2").val());
            var date2 = new Date($("#dateto2").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('result1').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#result2').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());
            var rate = $('#room_rate1').text();

            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));

            var totalcost = rate * diffDays;
            document.getElementById('total_costt1').value = (totalcost);
            // document.getElementById('total_costt2').value = (totalcost);
            var parts = totalcost.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#total_costt2").text(num);


            var totalbalance = totalcost - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            document.getElementById('total_balance1').value = (totalbalance);

            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('total_balance').innerHTML = withCommas;
        });


        $("#dateto2").focusout(function() {
            var downpayment1 = $('#downpayment').val();
            $('#departuredate').text($('#dateto2').val());
            var date1 = new Date($("#datefrom2").val());
            var date2 = new Date($("#dateto2").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('result1').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#result2').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());
            var rate = $('#room_rate1').text();

            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));

            var totalcost = rate * diffDays;
            document.getElementById('total_costt1').value = (totalcost);
            // document.getElementById('total_costt2').value = (totalcost);
            var parts = totalcost.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#total_costt2").text(num);





            var totalbalance = totalcost - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            document.getElementById('total_balance1').value = (totalbalance);

            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('total_balance').innerHTML = withCommas;
            // $("#total_balance").text(num1);
        });

        $('#downpayment').keyup(function() {

            var rate = $('#room_rate1').text();
            var downpayment1 = $('#downpayment').val();
            // $('#downpayment_reserved').text(downpayment1);

            downpayment1 = parseFloat(downpayment1).toFixed(2);
            var withCommas1 = Number(downpayment1).toLocaleString('en');
            document.getElementById('downpayment_reserved').innerHTML = withCommas1;

            var date1 = new Date($("#datefrom2").val());
            var date2 = new Date($("#dateto2").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            // alert(diffDays);
            document.getElementById('result1').value = (diffDays);
            // document.getElementById('result2').value = (diffDays);
            $('#result2').text(diffDays);

            // total
            // var rate = new parseDouble($('#room_rate1').text());

            // var rate = document.getElementById().value = (parseDouble($('#room_rate1')));


            var totalcost = rate * diffDays;
            document.getElementById('total_costt1').value = (totalcost);
            // document.getElementById('total_costt2').value = (totalcost);
            var parts = totalcost.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (parts[1] ? "." + parts[1] : "");
            $("#total_costt2").text(num);



            var totalbalance = totalcost - downpayment1;
            document.getElementById('total_balance1').value = (totalbalance);

            totalbalance = parseFloat(totalbalance).toFixed(2);
            var withCommas = Number(totalbalance).toLocaleString('en');
            document.getElementById('total_balance').innerHTML = withCommas;
        });

        $('#firstname').keyup(function() {
            $('#fn').text($('#firstname').val());

        });

        $('#lastname').keyup(function() {
            $('#ln').text($('#lastname').val());
        });


        $('#occupyfirstname').keyup(function() {
            $('#fn1').text($('#occupyfirstname').val());

        });

        $('#occupylastname').keyup(function() {
            $('#ln1').text($('#occupylastname').val());
        });

        $('#cash1').click(function() {
            // alert('you click me!');
            // var getcash = $('#cash').text();
            document.getElementById('billarrangement1').value = ('Cash');
        });

        $('#credit_card1').click(function() {
            // alert('you click me!');
            // var getcash = $('#cash').text();
            document.getElementById('billarrangement1').value = ('Credit Card');
        });

        $("#next").on('click', function(e) {
            e.preventDefault();
            var id = $('#rsvn_no').val();

            var status = $('#status').val();

            var total_id = parseInt($('#customer_id').text()) + 1;
            document.getElementById('result_id').value = (total_id);
            document.getElementById('result_id1').value = (total_id);


            // start with 00000000
            // coerce the previous variable as a number and add 1
            var incrementvalue = (+parseInt($('#rsvn_no').text())) + 1;
            // insert leading zeroes with a negative slice
            incrementvalue = ("0000000000" + incrementvalue).slice(-10);
            // var total_rsvn = parseInt($('#rsvn_no').text()) + 1;
            document.getElementById('result_rsvn_no').value = (incrementvalue);
            document.getElementById('resulRsvn').value = (incrementvalue);
            document.getElementById('occupy_rsvn').value = (incrementvalue);
            // document.getElementById('result_rsvn_no1').value = (incrementvalue);
            $("#result_rsvn_no1").text(incrementvalue);
            $("#occupy_rsvn1").text(incrementvalue);
            // end


            if (status == "Reserved") {
                // document.getElementById("demo").innerHTML = "RESERVED";
                window.location.href='/multiple_reservation/reserved/'+incrementvalue;

                // var cus_id = $("#customer_id").val();

                // var total_id = parseInt($('#customer_id').val()) + 1;


            } else if (status == "Occupied") {
                // document.getElementById("demo").innerHTML = "OCCUPIED";
                window.location.href='/multiple_reservation/occupy/'+incrementvalue;

            } else if (status == "Existing_Reserved"){



            }
            else if (status == "Existing_Occupy"){

                window.location.href='/admin/dashboard';
            }


        });

        $("#next2").on('click', function(e) {
            e.preventDefault();

            $("#2nd").hide();
            $("#5th").hide();
            $("#1st").hide();
            $("#3rd").show();

            $("#6th").hide();
            $("#4th").hide();

        });


        $("#back").on('click', function() {

            $("#1st").show();
            $("#2nd").hide();
            $("#5th").hide();
            $('#3rd').hide();

            $("#6th").hide();
            $("#4th").hide();

        });

        $("#back2").on('click', function() {

            $("#1st").hide();
            $("#2nd").show();
            $("#5th").show();
            $('#3rd').hide();

            $("#6th").hide();
            $("#4th").hide();
        });

        $("#back3").on('click', function() {

            $("#1st").show();
            $("#5th").hide();
            $("#2nd").hide();
            $('#3rd').hide();
            $('#4th').hide();
            $("#6th").hide();


        });

</script>
@endsection
