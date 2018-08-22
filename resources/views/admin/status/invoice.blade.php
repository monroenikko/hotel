@extends('layouts.adminLayout.admin_design')

@section('content_title')
    Customer Invoice
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Reserve</a> </div>


      <h1><img src="{{ asset('images/checkin.png') }}" />Room no. {{ $manages->room_no }} {{ $manages->room_type }}</h1>


        <div class="container-fluid">
            <hr>
            <h3>RSVN No: <span style="color:orangered">{{ $manages->rsvn_no }}</span></h3>
            <h3>Departure Date: <span style="color:orangered">{{ $booking->checkouDate }}</span></h3>


            {{-- <input type="button" value="Proceed to Check-out" id="checkout" class="btn btn-success pull-right"> --}}

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

        <div class="row-fluid">

            <div class="container-fluid"><hr>
                <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                        <h5 >Company Name</h5>
                    </div>
                    <div class="widget-content">
                        <div class="row-fluid">

                            <div class="span12">
                                <table>
                                <tbody>
                                    <tr>
                                        <td rowspan="6" style="width: 12%"><img src="{{ asset('images/unc.png') }}" alt="Logo" /></td>
                                    </tr>
                                    <tr>
                                        <td><h4>BPEI HOTEL RESERVATIONS</h4></td>
                                    </tr>
                                    <tr>
                                        <td><i>JP Rizal Dinalupihan Bataan</i></td>
                                    </tr>
                                    <tr>
                                        <td><i>unc_2014@ymail.com</i></td>
                                    </tr>
                                    <tr>
                                        <td><i>Tel. No.: (047) 917-2895</i></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                        </div>
                        <hr/>

                        <div class="row-fluid" style="margin-top: 2em">
                                <div class="span12">
                                        <p>RSVN No.: <b>{{ str_pad($manages->rsvn_no, 10, '0', STR_PAD_LEFT) }}</b></p>
                                        <p style="margin-top: -1em">Name of Guest: <b>{{ $customer->customer_name }} {{ $customer->customer_lastname }}</b></p>
                                        <p style="margin-top: -1em">Arrival Date: <b>{{ $booking->checkinDate }} </b></p>
                                        <p style="margin-top: -1em">Departure Date: <b>{{ $booking->checkouDate }}</b></p>
                                        <p style="margin-top: -1em">Number of Days/Nights: <b>{{ $booking->bookingTotalNights }}</b></p>
                                        <p style="margin-top: -1em">Origin: <b>{{ $customer->customer_origin }}</b></p>
                                        <p style="margin-top: -1em">Flight No.: <b>{{ $customer->customer_flightno }}</b></p>
                                        <p style="margin-top: -1em">Time Departure:  <b>{{ $customer->customer_timedeparture }}</b></p>
                                        <p style="margin-top: -1em">Company Address: <b>{{ $customer->customer_companyaAdress }}</b></p>
                                        <p style="margin-top: -1em">Nationality: <b>{{ $customer->customer_nationality }}</b></p>
                                        <p style="margin-top: -1em">Contact No.: <b>{{ $customer->customer_contactno }}</b></p>
                                        <p style="margin-top: -1em">Address No.:  <b>{{ $customer->customer_address }}</b></p>
                                        <p style="margin-top: -1em">Bill Arrangement: <b>{{ $booking->booking_billArrangement }}</b></p>
                                </div>
                        </div>

                        <div class="row-fluid">
                        <div class="span12">
                            <table class="table table-bordered table-invoice-full">
                            <thead>
                                <tr>
                                    <th class="head0">No. Rooms</th>
                                    <th class="head1">Type of room</th>
                                    <th class="head0 right">No. Pax</th>
                                    <th class="head1 right">Room Rate</th>
                                    <th class="head0 right">Total Room Rate</th>
                                    <th class="head0 right">Total Bill</th>
                                    <th class="head0 right">DP</th>
                                    <th class="head0 right">Room No.</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                            <td> {{ $manages->room_no }}</td>
                                            <td> {{ $booking->bookingroomcategory}}</td>
                                            <td> </td>
                                            <td> PHP <?php
                                                $manages->room_rate;
                                                $formattedNum = number_format($manages->room_rate, 2);
                                                echo $formattedNum;
                                                ?>
                                            </td>
                                            <td> {{ $booking->bookingroomcategory}}</td>
                                            <td> PHP
                                                    <?php
                                                    $booking->bookingTotalCost;
                                                    $formattedNum = number_format($booking->bookingTotalCost, 2);
                                                    echo $formattedNum;
                                                    ?>
                                            </td>
                                            <td> PHP
                                                    <?php
                                                    $booking->booking_downpayment;
                                                    $formattedNum = number_format($booking->booking_downpayment, 2);
                                                    echo $formattedNum;
                                                    ?>
                                            </td>
                                            <td> {{ $manages->room_no }}</td>

                                            <td></td>
                                        </tr>
                            </tbody>
                            </table>
                            <br/>
                            <br/>

                            <table class="table table-bordered table-invoice-full">
                                    <thead>
                                        <tr>
                                            <th class="head0">Requested Items</th>
                                            <th class="head1">Unit Amount</th>
                                            <th class="head0 right">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <td> {{ $manages->room_no }}</td>
                                                    <td> {{ $booking->bookingroomcategory}}</td>
                                                    <td> </td>
                                            </tr>
                                    </tbody>
                            </table>

                            <br/>
                            <br/>
                            <br/>
                            <div class="row-fluid">
                                    <div class="span8">
                                    Outstanding Balance:  PHP
                                            <?php
                                            $booking->bookingTotalCost;
                                            $formattedNum = number_format($booking->booking_totalbalance, 2);
                                            echo $formattedNum;
                                            ?>



                                </div>
                                <div class="span4">
                                    Front Desk Clerk:  <select class="span11" name="fd_name"><?php echo $fd_fd; ?></select>
                                    <p style="margin-left: 4em">(Name, Signature)</p>
                                </div>
                            </div>

                            <form action="{{ url('/export/'.$manages->id) }}" id="cancelroom" method="post">{{ csrf_field() }}
                                <input type="submit" id="cancel_it" value="Pay now" class="btn btn-danger pull-right">
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>



</div>


@endsection

@section('scripts')
<script>
        $('#cancel_it').click(function() {
            alert('hello');
        });

</script>
@endsection


