@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Room Multiple Check-in
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href=""  class="current">Check-in</a> </div>
      <h1><img src="{{ asset('images/checkin.png') }}"  />Occupied Room1</h1>

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
            <div class="span12">

                        <div class="widget-box" >
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Guest Information</h5>
                            </div>


                                        {{--  <label class="control-label">RSVN Number</label>  --}}

                                            <p id="rsvn_no" style="display: none">{{ $lastBooking->booking_rsvn_no }}</p>

                                            <p id="customer_id" style="display: none">{{ $lastCustId->customer_id }}</p>

                                            <input type="hidden"  class="span11" name="result_id1" id="result_id1" value="{{ $answer = $lastCustId->customer_id + 1}}">

                                            <input type="hidden"  class="span11" name="room_id" id="room_id" value="">
                                        {{--  <label class="control-label">Room Type</label>  --}}
                                            <input type="hidden"  class="span11" name="room_type" id="room_type" value="">

                                        {{--  <label class="control-label" for="room_rate2">Room Rate ₱</label>  --}}
                                            {{-- <span class="add-on">₱</span> --}}
                                            <p id="room_rate1" style="display: none"></p>
                                            <table class="table table-bordered table-invoice table-striped" style="margin-top: -5em">
                                                    <tbody>
                                                        <tr>
                                                            <tr>
                                                                <td colspan="2"><i class="icon-info-sign"></i> Occupy Transaction Details:
                                                                    <p>
                                                                            <input type="button" id="another_transaction" class="btn btn-primary pull-right" value=" Occupy Another Room">
                                                                            <a href="{{ url('/multiple_occupy/print/'.$customer->customer_rsvnno) }}" target="_blank" class="btn btn-success pull-right"><i class="icon-print"></i> Print</a></td>
                                                                    </p>
                                                            </tr>
                                                                <tr>
                                                                    <td style="width:140px"><b>RSVN NO.</b></td>
                                                                    <td id="occupy_rsvn1"> <b>{{ str_pad($customer->customer_rsvnno , 10, '0', STR_PAD_LEFT) }}</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:140px"><b>Customer Name</b></td>
                                                                    <td> <b>{{$customer->customer_name}} {{$customer->customer_lastname}}</b></td>
                                                                </tr>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <table class="table table-bordered table-invoice table-striped" style="margin-top: -1.5em">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 70px">Date Arrival</th>
                                                                <th style="width: 70px">Date Departure</th>
                                                                <th>Room Type</th>
                                                                <th>Room No.</th>
                                                                <th>Total Night(s)</th>
                                                                <th>Rate/Night(s)</th>
                                                                <th>Downpayment (DP)</th>
                                                                <th>Total Amount</th>

                                                                <th>Total Balance</th>
                                                                <th>Status</th>
                                                                <th style="width: 300px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($getIdRoom as $book)
                                                                <tr>
                                                                    <td>{{ $book->checkinDate }}</td>
                                                                    <td>{{ $book->checkouDate }}</td>
                                                                    <td>{{ $book->bookingroomcategory }}</td>
                                                                    <td><center>{{ $book->booking_room_no }}</center></td>
                                                                    <td><center>{{ $book->bookingTotalNights }}</center></td>
                                                                    <td>
                                                                            <?php
                                                                        $formattedNum = number_format($book->booking_rate, 2);
                                                                            echo $formattedNum;
                                                                            ?>
                                                                    </td>
                                                                    <td>
                                                                            <?php
                                                                        $formattedNum = number_format($book->booking_downpayment, 2);
                                                                            echo $formattedNum;
                                                                            ?>
                                                                    </td>

                                                                    <td><?php
                                                                        $formattedNum = number_format($x = $book->booking_rate * $book->bookingTotalNights, 2);
                                                                        echo $formattedNum;
                                                                        ?>
                                                                    </td>
                                                                    <td><?php
                                                                        $formattedNum = number_format($y = $x - $book->booking_downpayment , 2);
                                                                        echo $formattedNum;
                                                                        ?>
                                                                    </td>
                                                                    <td><center><span style="color: red"><b>{{$book->booking_status}}</b></span></center></td>
                                                                    <td>
                                                                        <center>

                                                                            <a href="{{ url('/viewExtra/'.$book->bookingroomID) }}"  class="btn btn-success btn-mini"><i class="icon-search"></i> add extra</a>

                                                                            <a href="{{ url('/OccupyCheckout/'.$book->bookingID) }}" onclick="checkOutRoomOnce(event);"  class="btn btn-warning btn-mini deletedata"><i class="icon-remove-sign"></i> Check-Out Room</a>

                                                                            <a href="{{ url('/voidOccupy-room/'.$book->bookingID) }}" onclick="deleteRoom(event);" class="btn btn-danger btn-mini deletedata"><i class="icon-trash"></i> Delete Room</a>
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>

                                                                    <td colspan="11">
                                                                        <center>
                                                                            <a href="{{ url('/checkOutall/'.$customer->customer_rsvnno) }}" onclick="checkOutAllRoom(event);" class="btn btn-danger pull-right"><i class="icon-check"></i> Check-out All Occupied Room</a>
                                                                        </center>
                                                                    </td>



                                                                </tr>

                                                        </tbody>

                                                    </table>



                        </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="display:none" id="room-available">

            <div class="row-fluid">
                    <div class="span6">
                            <div class="widget-box" >
                                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                        <h5>Occupy Room Available Information </h5>

                                        <a href="{{ url('/multiple_reservation/setdate/'.$customer->rsvn_no) }}" style="margin-top: 3px; margin-right: 7px; margin-bottom: 4px" class="btn btn-primary pull-right"><i class="icon-calendar"></i> Set Another Date</a>

                                    </div>

                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Room Type</th>
                                                <th>Room No.</th>

                                                <th>Rate/Night(s)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($Manages as $room)
                                                <tr>

                                                    <td>{{ $room->room_type }}</td>
                                                    <td><center>{{ $room->room_no }}</center></td>
                                                    <td>
                                                        <?php
                                                        $formattedNum = number_format($room->room_rate, 2);
                                                        echo $formattedNum;
                                                        ?>
                                                    </td>

                                                    <td>

                                                        <center>
                                                                <form method="POST" action="{{ url('/multiple_reservation/selectRoom/'.$customer->customer_rsvnno)}}" name="cust_extra" id="cust_extra" novalidate="novalidate">

                                                                    <input type="hidden" class="span3" name="rsvn"  value="{{ $customer->customer_rsvnno }}">
                                                                    <input type="hidden" class="span3" name="custid" value="{{ $customer->customer_id }}">
                                                                    <input type="hidden" class="span3" name="firstname" value="{{ $customer->customer_name }}">
                                                                    <input type="hidden" class="span3" name="lastname" value="{{ $customer->cust_ln }}">
                                                                    <input type="hidden" class="span3" name="date_arrival" value="{{ $RDate->arrivaldate }}">
                                                                    <input type="hidden" class="span3" name="date_departure" value="{{ $RDate->departuredate }}">
                                                                    <input type="hidden" class="span3" name="totalnight" value="{{ $RDate->totalnight }}">
                                                                    <input type="hidden" class="span3" name="downpayment" value="{{ $RDate->downpayment }}">
                                                                    <input type="hidden" class="span3" name="room_id" value="{{ $room->id }}">
                                                                    <input type="hidden" class="span11" name="result_id" value="{{ $rs =  $lastCustId->customer_id + 1 }}">
                                                                    <input type="hidden" class="span3" name="room_no" value="{{ $room->room_no }}">
                                                                    <input type="hidden" class="span3" name="room_type" value="{{ $room->room_type }}">
                                                                    <input type="hidden" class="span3" name="room_rate" value="{{ $room->room_rate }}">


                                                                    <input style="margin-top: -.8em" type="submit" id="add_it" value="+" class="btn btn-primary btn-mini">{{ csrf_field() }}
                                                                </form>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                    </table>

                            </div>
                    </div>



            </div>

        </div>

</div>



@endsection

@section('scripts')
<script>

    $('#another_transaction').click(function(){

        $('#room-available').show();
    });

    function checkOutRoomOnce(e)
        {
            if(!confirm('Are you sure you want to Check-out the Occupied Room? You are not able to revert it.'))e.preventDefault();
        }

        function deleteRoom(e)
        {
            if(!confirm('Are you sure you want to Delete this room?'))e.preventDefault();
        }

        function checkOutAllRoom(e)
        {
            if(!confirm('Are you sure you want to Check-out ALL the Occupied Room? You are not able to revert it.'))e.preventDefault();
        }


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

            var fn = $('#firstname').val();
           // document.getElementById('fname').value = fn;
            //getElementsByTagName('fname')[1].value = (fn);

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
            var id = $('#room_id').val();

            var status = $('#status').val();

            var total_id = parseInt($('#customer_id').text()) + 1;
            document.getElementById('result_id').value = (total_id);
            document.getElementById('result_id1').value = (total_id);


            // start with 00000000
            // coerce the previous variable as a number and add 1
            var incrementvalue = (+parseInt($('#rsvn_no').text())) + 0;
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
                $("#4th").show();
                $("#6th").show();
                $("#2nd").hide();
                $("#1st").hide();
                $("#3rd").hide();
                $("#5th").hide();

                // var cus_id = $("#customer_id").val();

                // var total_id = parseInt($('#customer_id').val()) + 1;


            } else if (status == "Occupied") {
                // document.getElementById("demo").innerHTML = "OCCUPIED";
                $("#2nd").show();
                $("#5th").show();
                $("#1st").hide();
                $("#3rd").hide();
            } else if (status == "Existing_Reserved"){

                window.location.href='/status/roomreservedexisting/'+id;

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
