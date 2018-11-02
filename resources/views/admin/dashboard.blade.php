@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Room Status
@endsection

@section('content')

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Room Status</a></div>


    <div class="container-fluid">

            <div class="row-fluid">
                <div class="span6"><h1><i class="icon-info-sign"></i> Status </h1></div>
                <div class="span6" style="text-align: right"><h1><i class="icon-time"></i> <span id='date'></span> (<span id="display_clock"></span>)</h1></div>
            </div>
    </div>

    <div class="container-fluid"><hr>

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
<!--End-breadcrumbs-->

<!--Action boxes-->

<!--End-Action boxes-->

<div class="row-fluid">
        <div class="container-fluid">
            <div class="span7" style="margin-top: 1em">
                        <div class="span12">
                            <div class="quick-actions_homepage">

                                @foreach($manages as $manage)
                                    <ul class="quick-actions">
                                            <li class="{{ $manage->color_stats }}">

                                                <a href="{{ url('/status/room_checkin/'.$manage->id) }}"> <img width="50%" src="{{ asset('images/roomdoor.png') }}"  />
                                                <br/> Room {{ $manage->room_no }}
                                                <br/> <b style="color:powderblue; font-size: 1em">{{ $manage->room_type }}</b> <br/>
                                                    <?php
                                                        $stats;


                                                        if( $manage->status == 1 || $manage->status == 4)
                                                        {

                                                            $stats='Reserved';
                                                            $color="bg_lg";

                                                        }
                                                        else if( $manage->status == 0)
                                                        {

                                                            $stats='Occupied!';
                                                            $color="bg_lr";

                                                        }
                                                        else if( $manage->status == 2)
                                                        {
                                                            $stats='Available';
                                                            $color="bg_ls";
                                                        }
                                                        else if($manage->status == 5)
                                                        {
                                                            $stats='Expired!';
                                                            $color="bg_lo";
                                                        }
                                                        else if($manage->status == 6)
                                                        {
                                                            $stats='Occupied!';
                                                            $color="bg_lr";
                                                        }
                                                        else
                                                        {
                                                            $stats='Checkout!';
                                                            $color="bg_ly";
                                                        }

                                                    ?>
                                                {{ $stats }}
                                                <br/>


                                                </a>


                                            </li>
                                    </ul>

                                @endforeach

                            </div>
                        </div>
            </div>

            <div class="span5">

                        <div class="row-fluid">
                            <div class="widget-box">
                                <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                                    <h5>Room(s) Status</h5>
                                </div>

                                <div class="widget-content" >
                                    <div class="row-fluid">

                                    <div class="span12">
                                        <ul class="site-stats">

                                        <li class="bg_lg" style="height: 161px;">

                                            <img width="17%" src="{{ asset('images/bed.png') }}"  /><strong>Rooms</strong>
                                            <br/>
                                            <br/>  Total: <?php echo $count ?>
                                            <br/>  Available: <?php echo $count2 ?>
                                            <br/>  Occupied: <?php echo $countOccupy ?>
                                            <br/>  Reserved: <?php echo $finalcount ?>
                                            <br/> Reserved Expired: <?php echo $checkReserve ?>
                                            <br/>
                                            <br/>

                                        </li>

                                        <li class="bg_lg" style="height: 160px">

                                            <i class="icon-exclamation-sign"></i><strong>LEGEND STATUS</strong>
                                            <br/>

                                            <br/> Available: <span class="bg_ls">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <br/> Occupied: <span class="bg_lr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <br/> Reserved: <span class="bg_lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <br/> Expired Reserved: <span class="bg_lo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <br/> Check-out: <span class="bg_ly">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <br/>
                                            <br/>

                                        </li>

                                        <li class="bg_lg" style="height: 150px">
                                            <i class="icon-ok-circle"></i> <strong>Type</strong> <br/>

                                            @foreach($types as $val)
                                            <br/>{{ $val->room_type }} <?php echo $count5 = \App\Manage::where(['room_type'=>$val->room_type])->count(); ?>
                                            @endforeach
                                        </li>

                                        <li class="bg_lg" style="height: 150px">
                                            <i class="icon-tag"></i> <strong>Checking out</strong> <br/>
                                            <br/> Today: <?php echo $count4 ?>
                                            <br/> Other day:  <?php echo $countout2 ?>
                                            <br/> Reservation Expired: <?php echo $checkReserve ?>
                                            <br/>
                                            <br/>


                                        </li>

                                        </ul>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>
    </div>

<!--Chart-box-->

<!--End-Chart-box-->


  </div>
</div>

<!--end-main-container-part-->

@endsection

@section ('scripts')
    <script>

        if (new Date().getHours() >= 11 ){ //&& new Date().getHours() < 13) {
            <!--document.getElementById("demo").innerHTML = "Good day!";-->
            window.setTimeout(function(){

                window.location.reload(2);

            }, 1800000);
        }

        function renderTime() {
            var currentTime = new Date();
            var diem = "AM";
            var h = currentTime.getHours();
            var m = currentTime.getMinutes();
            var s = currentTime.getSeconds();
            setTimeout('renderTime()',1000);
            if (h == 0) {
                h = 12;
            } else if (h > 12) {
                h = h - 12;
                diem="PM";
            }
            if (h < 10) {
                h = "0" + h;
            }
            if (m < 10) {
                m = "0" + m;
            }
            if (s < 10) {
                s = "0" + s;
            }
            var myClock = document.getElementById('display_clock');
            myClock.textContent = h + ":" + m + ":" + s + " " + diem;
            myClock.innerText = h + ":" + m + ":" + s + " " + diem;

        }
        renderTime();

        function addZero(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function getActualFullDate() {
            var d = new Date();
            var day = addZero(d.getDate());
            var month = addZero(d.getMonth()+1);
            var year = addZero(d.getFullYear());
            var h = addZero(d.getHours());
            var m = addZero(d.getMinutes());
            var s = addZero(d.getSeconds());
            return day + ". " + month + ". " + year + " (" + h + ":" + m + ")";
        }
        function getActualHour() {
            var d = new Date();
            var h = addZero(d.getHours());
            var m = addZero(d.getMinutes());
            var s = addZero(d.getSeconds());
            return h + ":" + m + ":" + s;
        }

        function getActualDate() {
            var d = new Date();
            var day = addZero(d.getDate());
            var month = addZero(d.getMonth()+1);
            var year = addZero(d.getFullYear());
            return day + " - " + month + " - " + year;
        }

        $("#date").html(getActualDate());



    </script>
@endsection
