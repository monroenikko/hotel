<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>Print</title>
 <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}" />
 <script src="{{ asset('js/app.js') }}"></script>
 <style>
     .page-break {
         page-break-after: always;
     }
     th, td {
         border: 1px solid #ccc;
         padding: 5px;
     }
     table {

         border-spacing: 0;
         border-collapse: collapse;
         font-size : 11px;
     }
     .text-red {
         color : #dd4b39 !important;
     }
     small {
         font-size : 10px;
     }
     body {
        display: block;
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: 5px;
        margin-right: 5px;
        padding-left: 0;
        padding-right: 0;
        text-indent: 0;
    }
    p {
        display: block;
        margin: 0;
        padding: 0;
        text-indent: 1.5em;
        text-align: justify!important;
        line-height: 1.3em;
        font-size: .95em;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
    text-align: center inherit;
    text-indent: 0em;
    }
    h1 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1em 0 .2em;
        font-size: 1.6em;
        line-height: 1.2em;
    }

    h2 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1em 0 .2em;
        font-size: 1.3em;
        line-height: 1.2em;
    }

    h3 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1.4em 0 .2em;
        font-size: 1.2em;
        line-height: 1.2em;
    }

    h4 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1.4em 0 .2em;
        font-size: 1.1em;
        line-height: 1em;
    }
 </style>

 </head>
 <body>
 <br />



            <div class="col-md-6">
                <img width="15%" src="{{ asset('images/unclogo.png') }}" alt="Logo" />
            </div>

            <div class="col-md-5" style="margin-left: 8em; margin-top: -10em">
                <h4 style="text-align: left; margin-top: 0em; font-size: 1.5em">BPEI HOTEL RESERVATIONS</h4>
                <h4 style="text-align: left; margin-top: .5em"><i>JP Rizal Dinalupihan Bataan</i></h4>
                <h4 style="text-align: left; margin-top: .5em; color: blue"><i>unc_2014@ymail.com</i></h4>
                <h4 style="text-align: left; margin-top: .5em"><i>Tel. No.: (047) 917-2895</i></h4>
            </div>


<hr/>

    <p>RSVN No.: <b>{{ str_pad($manages->rsvn_no, 10, '0', STR_PAD_LEFT) }}</b></p>
    <p>Name of Guest: <b>{{ $customer->customer_name }} {{ $customer->customer_lastname }}</b></p>
    <p>Arrival Date: <b>{{ $booking->checkinDate }} </b></p>
    <p>Departure Date: <b>{{ $booking->checkouDate }}</b></p>
    <p>Number of Days/Nights: <b>{{ $booking->bookingTotalNights }}</b></p>
    <p>Origin: <b>{{ $customer->customer_origin }}</b></p>
    <p>Flight No.: <b>{{ $customer->customer_flightno }}</b></p>
    <p>Time Departure:  <b>{{ $customer->customer_timedeparture }}</b></p>
    <p>Company Address: <b>{{ $customer->customer_companyaAdress }}</b></p>
    <p>Nationality: <b>{{ $customer->customer_nationality }}</b></p>
    <p>Contact No.: <b>{{ $customer->customer_contactno }}</b></p>
    <p>Address No.:  <b>{{ $customer->customer_address }}</b></p>
    <p>Bill Arrangement: <b>{{ $booking->booking_billArrangement }}</b></p>
 <br />
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
                <th>No. Rooms</th>
                <th>Type of room</th>
                <th>No. Pax</th>
                <th>Room Rate</th>
                <th>Total Room Rate</th>
                <th>Total Bill</th>
                <th>DP</th>
                <th>Room No.</th>
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
    </div>

    <br />
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
                <th>Requested Item(s)</th>
                <th>Unit Amount</th>
                <th>Total Amount</th>
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
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-6">
            Outstanding Balance:  PHP
                    <?php
                    $booking->bookingTotalCost;
                    $formattedNum = number_format($booking->booking_totalbalance, 2);
                    echo $formattedNum;
                    ?>



        </div>
        <div class="col-md-6" style="margin-left: 28em">
            Front Desk Clerk:_____________________
            <p style="margin-left: 4em">(Name, Signature)</p>
        </div>
    </div>

 </body>
</html>
