@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Reserve room
@endsection

@section('content')

<div id="content">

    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Reserve</a>
        </div>
        <h1><img src="{{ asset('images/checkin.png') }}"  />Reserve Room no. {{ $manages->room_no }} ({{ $manages->room_type }})</h1>

        <div class="container-fluid">



            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_error')!!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_success')!!}</strong>
                </div>
            @endif

        </div>

    </div>

    <div class="container-fluid">
            <hr>


        <div class="row-fluid">
                <div class="span7">

                            <div class="widget-box" >
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Guest Information</h5>


                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="{{ url('/status/getReserve/'.$manages->id) }}" name="checkin1" id="checkin1" novalidate="novalidate">{{ csrf_field() }}


                                            {{--  <label class="control-label">RSVN Number</label>  --}}
                                                <input type="hidden" class="span11" name="rsvn_no" id="rsvn_no" value="{{ $customer->customer_rsvnno }}">


                                                <p id="rsvn_no" style="display: none"></p>
                                                <input type="hidden"  class="span11" name="result_rsvn_no" id="result_rsvn_no">



                                                <p id="customer_id" style="display: none"></p>
                                                <input type="hidden"  class="span11" name="result_id" id="result_id" value="{{ $customer->customer_id }}">


                                                <input type="hidden"  class="span11" name="room_id" id="room_id" value="{{ $manages->id }}">


                                            {{--  <label class="control-label">Room Type</label>  --}}
                                                <input type="hidden"  class="span11" name="room_type" id="room_type" value="{{ $manages->room_type }}">


                                            {{--  <label class="control-label" for="room_rate2">Room Rate ₱</label>  --}}
                                                {{-- <span class="add-on">₱</span> --}}
                                                <p id="room_rate1" style="display: none"></p>





                                        <div class="control-group">
                                            <label class="control-label">First Name</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="firstname" id="firstname" value="{{ $customer->customer_name }}">

                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Last Name</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="lastname" id="lastname"  value="{{ $customer->customer_lastname }}">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Downpayment</label>
                                            <div class="controls">
                                                <input type="number" class="span11" name="tdownpayment" id="tdownpayment" placeholder="1000.00">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Arrival Date</label>
                                            <div class="controls">
                                                <input type="text" id="df" name="df" data-date-format="yyyy/m/d"  class="datepicker span11">
                                                {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Departure Date</label>
                                            <div class="controls">
                                                <input type="text" id="dt" name="dt"  data-date-format="yyyy/m/d"  class="datepicker span11">
                                                {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                            </div>
                                        </div>




                                                {{--  <label class="control-label">Total night(s)</label>  --}}

                                                    <input type="hidden" name="result1" id="result1" value="0">

                                                {{--  <label class="control-label">Total Cost ₱</label>  --}}

                                                    <input type="hidden" name="total_costt1" id="total_costt1" value="0">



                                            {{--  <label class="control-label">Total Balance ₱</label>  --}}

                                                <input type="hidden" name="total_balance1" id="total_balance1" value="0">



                                        <div class="form-actions">


                                            <input type="submit" value="Reserve" class="btn btn-success pull-right">
                                        </div>
                                    </form>
                                </div>
                            </div>




                </div>

                <div class="span5" style="margin-top: 1.3em;">
                    <table class="table table-bordered table-invoice table-striped">
                        <tbody>
                            <tr>
                                <tr>
                                    <td colspan="2"><i class="icon-info-sign"></i> Reservation Transaction Details:</td>
                                </tr>
                                    <tr>
                                        <td style="width:140px">RSVN No.</td>
                                        <td>{{ str_pad($customer->customer_rsvnno, 10, '0', STR_PAD_LEFT) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Customer Name</td>
                                        <td>{{ $customer->customer_name }} {{ $customer->customer_lastname }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Arrival Date</td>
                                        <td id="arrivaldate"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Departure Date</td>
                                        <td id="departuredate"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Night(s)</td>
                                        <td id="rs">0</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room No.</td>
                                        <td> {{ $manages->room_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room Type</td>
                                        <td> {{ $manages->room_type }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Room Rate</td>
                                        <td>
                                            ₱ <span id="rate">{{ $manages->room_rate }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Bill </td>
                                            <td>
                                                ₱ <span id="total_costt2">0</span>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Downpayment </td>
                                            <td>
                                                ₱ <span id="downpayment_reserved">0</span>

                                            </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Total Balance </td>
                                            <td>
                                                ₱ <span id="total_balance">0</span>

                                            </td>
                                    </tr>



                            </tr>
                        </tbody>

                    </table>
                </div>


        </div>
    </div>

</div>

@endsection

@section ('scripts')
<script>
        //var idrsvn = $('#rsvn_no').val();
        //var total_rsvn = idrsvn + 1;
        var total_rsvn = parseInt($('#rsvn_no').val()) + 1;
        total_rsvn = ("0000000000" + total_rsvn).slice(-10);

        //document.getElementById('result_rsvn_no1').value = (total_rsvn);
        $("#result_rsvn_no1").text(total_rsvn);


        $('#next').click(function(){
            var name = $('#custname').val();
            window.location.href='/status/roomreservedexisting/'+name;
        });

        $('#tdownpayment').keyup(function(){
            $("#downpayment_reserved").text($('#tdownpayment').val());
        });

        $("#df").focusout(function() {
             $("#arrivaldate").text($('#df').val());

            var date1 = new Date($("#df").val());
            var date2 = new Date($("#dt").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            $("#rs").text(diffDays);
            document.getElementById('result1').value = (diffDays);


            $('#totalNights').val(diffDays);

            var rate = $('#rate').text();
            var downpayment1 = $('#tdownpayment').val();

            var total = rate * diffDays;
            document.getElementById('total_costt1').value = (total);
            // document.getElementById('rtotalcost').value = (total);
            // $("#rtotalcost").text(total);
            var parts = total.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#total_costt2").text(num);

            var totalbalance = total - downpayment1;


            // document.getElementById('total_balance').value = (totalbalance);
            document.getElementById('total_balance1').value = (totalbalance);


            // document.getElementById('total_balance').value = (totalbalance);
            var parts2 = totalbalance.toFixed(2).split(".");
            var num2 = parts2[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts2[1] ? "." + parts2[1] : "");
            $("#total_balance").text(num2);
        });

        $("#dt").focusout(function() {
             $("#departuredate").text($('#dt').val());

            var date1 = new Date($("#df").val());
            var date2 = new Date($("#dt").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            $("#rs").text(diffDays);
            document.getElementById('result1').value = (diffDays);

            $('#totalNights').val(diffDays);

            var rate = $('#rate').text();
            var downpayment1 = $('#tdownpayment').val();

            var total = rate * diffDays;
            document.getElementById('total_costt1').value = (total);
            // document.getElementById('rtotalcost').value = (total);
            // $("#rtotalcost").text(total);
            var parts = total.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");

            $("#total_costt2").text(num);
            document.getElementById('total_costt2').value = (total);

            var totalbalance = total - downpayment1;
            document.getElementById('total_balance1').value = (totalbalance);

            // document.getElementById('total_balance').value = (totalbalance);
            var parts2 = totalbalance.toFixed(2).split(".");
            var num2 = parts2[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts2[1] ? "." + parts2[1] : "");
            $("#total_balance").text(num2);

            document.getElementById('totalBalance').value = (totalbalance);

        });

        $('#tdownpayment').keyup(function(){
            var date1 = new Date($("#df").val());
            var date2 = new Date($("#dt").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            $("#rs").text(diffDays);
            document.getElementById('result1').value = (diffDays);

            $('#totalNights').val(diffDays);

            var rate = $('#rate').text();
            var downpayment1 = $('#tdownpayment').val();

            var total = rate * diffDays;
            document.getElementById('total_costt1').value = (total);
            // document.getElementById('rtotalcost').value = (total);
            // $("#rtotalcost").text(total);
            var parts = total.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");

            $("#total_costt2").text(num);
            document.getElementById('total_costt2').value = (total);

            var totalbalance = total - downpayment1;
            document.getElementById('total_balance1').value = (totalbalance);

            // document.getElementById('total_balance').value = (totalbalance);
            var parts2 = totalbalance.toFixed(2).split(".");
            var num2 = parts2[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts2[1] ? "." + parts2[1] : "");
            $("#total_balance").text(num2);

            document.getElementById('totalBalance').value = (totalbalance);
        });


        $('#cash').click(function() {
            // alert('you click me!');
            // var getcash = $('#cash').text();
            document.getElementById('billarrangement').value = ('Cash');
        });

        $('#credit_card').click(function() {
            // alert('you click me!');
            // var getcash = $('#cash').text();
            document.getElementById('billarrangement').value = ('Credit Card');
        });

        $('#cancel_it').on('click', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cancel Reservation!'
              }).then((result) => {
                if (result.value) {
                    $('#cancelroom').submit();
                    swal(
                        'Canceled!',
                        'Reservation is now Canceled.',
                        'success'
                      )

                }
              })
        });


</script>
@endsection

