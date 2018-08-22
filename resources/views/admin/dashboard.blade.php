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
    <h1><i class="icon-info-sign"></i> Status</h1>

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


                                                        if( $manage->status == 1)
                                                        {

                                                            $stats='Reserved';
                                                            $color="bg_ls";

                                                        }
                                                        else if( $manage->status == 0)
                                                        {


                                                            $stats='Occupied';
                                                            $color="bg_lr";

                                                        }
                                                        else if( $manage->status == 2)
                                                        {
                                                            $stats='Available';
                                                            $color="bg_ls";
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

                                        <li class="bg_lg" style="height: 150px">

                                            <img width="18%" src="{{ asset('images/bed.png') }}"  /><strong>Rooms</strong>
                                            <br/>
                                            <br/>  Total: <?php echo $count ?>
                                            <br/>  Occupied: <?php echo $count1 ?>
                                            <br/>  Available: <?php echo $count2 ?>
                                            <br/>  Reserved: <?php echo $count3 ?>
                                        </li>

                                        <li class="bg_lg" style="height: 150px">
                                            <br/>
                                            <i class="icon-user"></i><strong>Guests</strong>
                                            <br/>

                                            <br/> Guests:
                                            <br/> Male:
                                            <br/> Female:



                                        </li>

                                        <li class="bg_lg" style="height: 130px">
                                            <i class="icon-ok-circle"></i> <strong>Type</strong> <br/>

                                            @foreach($types as $val)
                                            <br/>{{ $val->room_type }} <?php echo $count5 = \App\Manage::where(['room_type'=>$val->room_type])->count(); ?>
                                            @endforeach
                                        </li>

                                        <li class="bg_lg" style="height: 130px">
                                            <i class="icon-tag"></i> <strong>Checking out</strong> <br/>
                                            <br/> Today: <?php echo $countout ?>
                                            <br/> Other day:  <?php echo $countout2 ?>
                                            <br/>
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
        Jquery(document).ready(function(){
            Jquery('#ajaxSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            });
        });


    </script>
@endsection
