@extends('layouts.adminLayout.admin_design')

@section('content_title')
   Reports (Collection)
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href=""  class="current">Reports</a> </div>
      <h1><i class="icon-edit"></i> Reports (Collection)</h1>

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

                        {{--  <div class="container-fluid">  --}}

                                <div class="widget-box">
                                        <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                                          <h5>Choose Date From and Date To</h5>
                                          <a href="{{ url('/reports/print/'.$result = $getTheqty->indicator_id + 1) }}" target="_blank" style="margin-top: 3px; margin-right: 7px; margin-bottom: 4px" class="btn btn-success pull-right"><i class="icon-print"></i> Print</a>

                                        </div>


                                            <div class="widget-content nopadding">
                                                    <form class="form-horizontal" method="post" action="{{ url('/reports/generateRecord/') }}" name="dateRange" id="dateRange" novalidate="novalidate">{{ csrf_field() }}

                                                        <input type="hidden" class="span11" name="indicator_id" id="indicator_id" value="{{ $getTheqty->indicator_id + 1 }}">

                                                        <div class="span4" style="margin-left: -2em">
                                                                <label class="control-label">Date From:</label>
                                                                <div class="controls">
                                                                    <input type="text" id="datefrom" name="datefrom" data-date-format="yyyy/m/d" class="datepicker " required>
                                                                    {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                                                </div>
                                                        </div>

                                                        <div class="span4">

                                                                <label class="control-label">Date To:</label>
                                                                <div class="controls">
                                                                    <input type="text" id="dateto" name="dateto" data-date-format="yyyy/m/d"   class="datepicker " required>
                                                                    {{-- <span class="help-block">Date with Formate of  (dd-mm-yy)</span> --}}
                                                                </div>
                                                        </div>

                                                        <div class="span4" style="margin-left: -4em">
                                                                <div class="controls">
                                                                    <input type="submit" value="Fetch Record" class="btn btn-primary pull-right span12">
                                                                </div>
                                                        </div>

                                                    </form>

                                </div>

                                <div class="widget-box">
                                        <div class="widget-title"> <span class="icon"> <i class="icon-bookmark"></i> </span>
                                          <h5>Sales Information</h5>
                                        </div>
                                        <div class="widget-content nopadding">
                                          <table class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th>Date Arrival</th>
                                                <th>Date Departure</th>
                                                <th>Room No.</th>
                                                <th>Room Type</th>
                                                <th>Room Rate</th>
                                                <th>No. of Night(s)</th>
                                                <th>Total Amount</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Booking as $book)
                                                    <tr class="odd gradeX">
                                                        <td>{{$book->checkinDate}}</td>
                                                        <td>{{$book->checkouDate}}</td>
                                                        <td>{{$book->booking_room_no}}</td>
                                                        <td class="center"> {{$book->bookingroomcategory}}</td>
                                                        <td class="center">
                                                            <?php
                                                                $formattedNum = number_format($book->booking_rate, 2);
                                                                echo $formattedNum;
                                                            ?>
                                                        </td>
                                                        <td class="center">{{$book->bookingTotalNights}}</td>
                                                        <td class="center">

                                                            <?php
                                                                $formattedNum = number_format($book->bookingTotalCost, 2);
                                                                echo $formattedNum;
                                                            ?>
                                                        </td>
                                                    </tr>
                                              @endforeach
                                                    <tr>
                                                        <td colspan="7" style="text-align: right"><b style="font-size: 1.4em;">Total Sales (PHP)</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <b style="color: red; font-size: 1.4em">
                                                                <?php
                                                                    $formattedNum = number_format($BookingSum, 2);
                                                                    echo $formattedNum;
                                                                ?>

                                                            </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </td>





                                                    </tr>

                                            </tbody>
                                          </table>
                                        </div>
                                      </div>


                              {{--  </div>  --}}
                    </div>
                </div>
        </div>
    </div>

</div>

@endsection
