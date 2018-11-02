@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Reserve room
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Reserve</a> </div>
      <h1><img src="{{ asset('images/checkin.png') }}"  />Occupy Room Section</h1>

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
        <div class="span2"></div>
        <div class="span7" style="margin-top: 1.3em">
            <table class="table table-bordered table-invoice table-striped">
                <tbody>
                    <tr>
                            <tr>
                                <td colspan="2"><i class="icon-info-sign"></i> Reservation Details:</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Customer Name</td>
                                <td>{{ $cust->customer_name }} {{ $cust->customer_lastname }}</td>
                            </tr>
                            <tr>
                                <td>RSVN No.</td>
                                <td>{{ str_pad( $cust->customer_rsvnno , 10, '0', STR_PAD_LEFT) }}</td>
                            </tr>


                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span2"></div>
            <div class="span7">

                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Guest Application Form</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="{{ url('/Occupy-Allroom/'.str_pad( $cust->customer_rsvnno , 10, '0', STR_PAD_LEFT))}}" name="reserve_room" id="reserve_room" novalidate="novalidate">{{ csrf_field() }}

                                        <input type="hidden" class="span7" name="bookingroomid" id="bookingroomid" value="">



                                        <div class="control-group">
                                            <label class="control-label">Origin</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="origin" id="origin">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Flight No.</label>
                                            <div class="controls">
                                                <input type="number"  class="span11" name="flight_no" id="flight_no">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Time of Departure</label>
                                            <div class="controls">

                                                <input type="text" name="timedeparture" class="timepicker"/>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Company Name/Address</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="c_address" id="c_address">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Nationality</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="nationality" id="nationality">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Contact No.</label>
                                            <div class="controls">
                                                <input type="number"  class="span11" name="contact_no" id="contact_no">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Address</label>
                                            <div class="controls">
                                                <input type="text"  class="span11" name="address" id="address">


                                            </div>
                                        </div>




                                        <div class="control-group">
                                            <label class="control-label">Bill Arrangement</label>
                                            <div class="controls">
                                                <label>
                                                    <input type="radio" name="radios" id="cash" value="Cash" />
                                                    Cash
                                                </label>
                                                <label>
                                                    <input type="radio" name="radios" id="credit_card" value="Credit Card" />
                                                    Credit Card
                                                </label>
                                                <input type="hidden"  class="span11" name="billarrangement" id="billarrangement">
                                            </div>
                                        </div>

                                        <input type="hidden"  class="span11" name="roomRate" id="roomRate" value="">
                                        <input type="hidden"  class="span11" name="totalCost" id="totalCost" value="">
                                        <input type="hidden"  class="span11" name="totalBalance" id="totalBalance" value="">
                                        <input type="hidden"  class="span11" name="totalDownpayment" id="totalDownpayment" value="">

                                        <div class="form-actions">
                                            <input type="submit" value="Proceed and Occupy" class="btn btn-primary pull-right">
                                        </div>
                                    </form>
                                </div>
                            </div>



            </div>


    </div>


    </div>

</div>

@endsection

@section ('scripts')
<script>


        $("#datefrom").focusout(function() {
            // $("#datecheckin").text($('#datefrom').val());
            var date1 = new Date($("#datefrom").val());
            var date2 = new Date($("#dateto").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            $("#result").val(diffDays);
            $('#totalNights').val(diffDays);

            var rate = $('#roomRate').val();
            var downpayment1 = $('#totalDownpayment').val();

            var total = rate * diffDays;
            // document.getElementById('rtotalcost').value = (total);
            // $("#rtotalcost").text(total);
            var parts = total.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#rtotalcost").text(num);

            var totalbalance = total - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            var parts2 = totalbalance.toFixed(2).split(".");
            var num2 = parts2[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts2[1] ? "." + parts2[1] : "");
            $("#rtotalbalance").text(num2);
        });

        $("#dateto").focusout(function() {
            // $("#datecheckout").text($('#dateto').val());

            var date1 = new Date($("#datefrom").val());
            var date2 = new Date($("#dateto").val());
            console.log(date2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            $("#result").val(diffDays);
            $('#totalNights').val(diffDays);

            var rate = $('#roomRate').val();
            var downpayment1 = $('#totalDownpayment').val();

            var total = rate * diffDays;
            // document.getElementById('rtotalcost').value = (total);
            // $("#rtotalcost").text(total);
            var parts = total.toFixed(2).split(".");
            var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts[1] ? "." + parts[1] : "");
            $("#rtotalcost").text(num);
            document.getElementById('totalCost').value = (total);

            var totalbalance = total - downpayment1;

            // document.getElementById('total_balance').value = (totalbalance);
            var parts2 = totalbalance.toFixed(2).split(".");
            var num2 = parts2[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
                (parts2[1] ? "." + parts2[1] : "");
            $("#rtotalbalance").text(num2);

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

