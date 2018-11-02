@extends('layouts.adminLayout.admin_design')

@section('content_title')
    Room Occupy
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"><a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Reserve</a> </div>
        <h1><img src="{{ asset('images/checkin.png') }}"  />Room no. {{ $manages->room_no }} ({{ $manages->room_type }})</h1>

      <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <h3>Departure Date: <span style="color:orangered">{{ $booking->checkouDate }} </span></h3>
                </div>

            </div>

            <div class="span6">
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


    </div>

    <div class="container-fluid" >
            <hr>
        <div class="row-fluid">

            <div class="span6">


                            <div class="widget-box">

                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>List of Extra</h5>
                            </div>
                            <div class="widget-content nopadding">

                                    <table id="extratable" class="table table-bordered data-table">

                                        <thead>
                                            <tr>
                                                <th>Extra</th>
                                                <th>Category</th>
                                                <th style="width: 60px">Price (₱)</th>
                                                <th>Quantity</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($hotels as $hotelex)
                                            <tr class="gradeX">
                                                <td id="name1">{{ $hotelex->hotex_name }}</td>
                                                <td id="category1">{{ $hotelex->hotex_category }}</td>


                                                <td id="price1">
                                                    <center>
                                                        <?php
                                                            $hotelex->hotex_price;
                                                            $formattedNum = number_format($hotelex->hotex_price, 2);
                                                            echo $formattedNum;
                                                        ?>
                                                    </center>
                                                </td>
                                                <td class="center" colspan="2">

                                                        <form action=""></form>
                                                        <form method="POST" action="{{ url('/occupy/getextra/'.$hotelex->hotex_id) }}" name="cust_extra" id="cust_extra" novalidate="novalidate">
                                                            <input type="hidden" class="span7" name="rsvn"  value="{{ $manages->id }}">
                                                            <input type="hidden" class="span7" name="rsvn1"  value="{{ $manages->rsvn_no }}">
                                                            <input type="hidden" class="span7" name="room_no"  value="{{ $manages->room_no }}">
                                                            <input type="hidden" class="span7" name="ename"  value="{{  $hotelex->hotex_name  }}">
                                                            <input type="hidden" class="span7" name="ecategory"  value="{{  $hotelex->hotex_category }}">
                                                            <input type="hidden" class="span7" name="eprice"  value="{{ $hotelex->hotex_price }}">
                                                            <input type="hidden" class="span7" name="custid"  value="{{ $customer1->customer_id }}">


                                                            <input style="margin-left: 1em" type="text" class="span5" name="extraqty" id="extraqty" placeholder="qty">

                                                            <input  style="margin-top: -.8em; margin-left: 5em"  type="submit" id="add_it" value="Select" class="btn btn-primary btn-mini">{{ csrf_field() }}
                                                        </form>

                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                            </div>
                            </div>



            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>List of Guest Extra(s)</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Extra</th>
                                    <th>Qty</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($CustomerExtra as $Cust)
                                        <tr class="gradeX">
                                            <td>{{ $Cust->extra_name }}</td>
                                            <td><center>{{ $Cust->extra_qty }}</center></td>
                                            <td>
                                                <center>
                                                <?php
                                                $Cust->extra_price;
                                                $formattedNum = number_format($Cust->total_cost, 2);
                                                echo $formattedNum;
                                                ?>
                                                </center>
                                            </td>
                                            <td class="center">
                                                <center>
                                                     <a href="{{ url('/delete-extra/'.$Cust->extra_id) }}" class="btn btn-danger btn-mini deletedata"><i class="icon-trash"></i></a>
                                                </center>
                                            </td>

                                        </tr>

                                    @endforeach
                                        <tr>


                                                <td colspan="4" style="text-align: right">
                                                    <b>TOTAL:</b><span style="margin-left: 10em"></span> ₱
                                                    <span style="margin-left: 1em"></span><b style="color: red">
                                                    <?php

                                                        $formattedNum = number_format($sum_total, 2);
                                                        echo $formattedNum;
                                                    ?>
                                                    </b>
                                                    <span style="margin-left: 2em"></span>
                                                </td>


                                        </tr>
                            </tbody>
                        </table>

                    </div>
                    <span id="val" style="text-align: left; display: none"></span>

                </div>



            </div>



        </div>

    </div>

</div>


@endsection

@section('scripts')
<script>

$("#myTable").on('click','.deletedata',function(){

    if (confirm('Are you sure you want to delete this Extra?')) {
        return true;

    }
    return false;

});





</script>
@endsection

