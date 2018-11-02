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
        border-width: 140%;
         border-spacing: 0;
         border-collapse: collapse;
         font-size : 11px;
        margin-left:-10px;
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
                <h4 style="text-align: left; margin-top: .5em; color: blue"><i>unc_2014@gmail.com</i></h4>
                <h4 style="text-align: left; margin-top: .5em"><i>Tel. No.: (047) 917-2895</i></h4>
            </div>


<hr/>
    <p style="text-indent: 85%">Date: <b>{{ $date }}</b></p>
    <p>RSVN No.: <b>{{ str_pad($customer->customer_rsvnno, 10, '0', STR_PAD_LEFT) }}</b></p>
    <p>Name of Guest: <b>{{ $customer->customer_name }} {{ $customer->customer_lastname }}</b></p>



 <br />
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
                <th style="width: 65px">Arrival Date</th>
                <th>Departure Date</th>

                <th style="width: 10px">No. of Night(s)</th>
                <th style="width: 15px">Type of Room</th>
                <th  style="width: 10px">No. Pax</th>
                <th>Room Rate</th>

                <th>Total Bill</th>
                <th>DP</th>
                <th style="width: 10px">Room No.</th>
                <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
            @foreach($booking as $book)
            <tr>
                <td><center>{{$book->checkinDate}}</center></td>
                <td><center>{{$book->checkouDate}}</center></td>
                <td><center> {{$book->bookingTotalNights}} </center></td>
                <td> {{ $book->bookingroomcategory}}</td>
                <td> </td>
                <td> PHP <?php

                    $formattedNum = number_format($book->booking_rate, 2);
                    echo $formattedNum;
                    ?>
                </td>
                <td> PHP <?php

                    $formattedNum = number_format($result = $book->bookingTotalNights * $book->booking_rate - $book->booking_downpayment, 2);
                    echo $formattedNum;
                    ?>
                </td>

                <td> PHP
                        <?php

                        $formattedNum = number_format($book->booking_downpayment, 2);
                        echo $formattedNum;
                        ?>
                </td>

                <td><center> {{ $book->booking_room_no }}</center></td>

                <td></td>

            </tr>
            @endforeach
            <tr>
                <td colspan="10" style="text-align: right; font-size: 12px">
                        Outstanding Balance:  PHP

                        <b><?php
                                  $formattedNum = number_format($totalday, 2);
                                  echo $formattedNum;
                              ?>
                          </b>
                </td>
            </tr>
        </tbody>
        </table>
    </div>

    <br />

    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-6">



        </div>
        <div class="col-md-6" style="margin-left: 28em">
            Front Desk Clerk: <span style="text-transform: uppercase">{{ Auth::user()->name }}</span>
            <p style="margin-left: 4em">(Name, Signature)</p>
        </div>
    </div>

 </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
    var sum = 0;
    var table = document.getElementById("res");
    var ths = table.getElementsByTagName('th');
    var tds = table.getElementsByClassName('countable');
    for(var i=0;i<tds.length;i++){
        sum += isNaN(tds[i].innerText) ? 0 : parseInt(tds[i].innerText);
    }

    var n = parseFloat($('#totalbal').val()) + sum;

    var parts = (+n).toFixed(2).split(".");
    var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (+parts[1] ? "." + parts[1] : "");

    $("#totalb").val(sum);

    });
</script>


