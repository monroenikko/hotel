@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Hotel Room(s)
@endsection

@section('content')
<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room') }}"  class="current">Rooms</a> </div>
      <h1><i class="icon-edit"></i> Rooms</h1>

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
            <div class="span7">
                    {{--  <div class="container-fluid">  --}}
                                <div class="widget-box">
                                  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                    <h5>Room List</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                        <table id="rtable" class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                            <th>Room ID.</th>
                                            <th>Room No.</th>
                                            <th>Type</th>
                                            <th>Rate (₱)</th>
                                            <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($manages as $manage)
                                            <tr class="gradeX">
                                                <td>{{ $manage->id }}</td>
                                                <td>{{ $manage->room_no }}</td>
                                                <td>{{ $manage->room_type }}</td>
                                                <td>
                                                        <?php
                                                        $manage->room_rate;
                                                        $formattedNum = number_format($manage->room_rate, 2);
                                                        echo $formattedNum;
                                                        ?>

                                                </td>

                                                <td class="center">
                                                    <center>
                                                    <a href="{{ url('/settings/edit_room/'.$manage->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a href="{{ url('/settings/delete-room/'.$manage->id) }}" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                    </center>
                                                </td>
                                            </tr>



                                        @endforeach

                                        </tbody>
                                        </table>
                                  </div>
                                </div>

                          {{--  </div>  --}}
            </div>
            <div class="span5">
                    {{--  <div class="container-fluid">  --}}
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Add Room</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="{{ url('/settings/add-room') }}" name="add_room" id="add_room" novalidate="novalidate">{{ csrf_field() }}

                                        <div class="control-group">
                                            <label class="control-label">Room No.</label>
                                            <div class="controls">
                                                <input class="span11" type="number" name="room_no" id="room_no">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Select Type</label>
                                            <div class="controls">
                                                <select class="span11" name="room_type">

                                                    <?php echo $types_roomtype; ?>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Room Rate</label>
                                            <div class="controls">
                                                    <div class="input-append">
                                                            <span class="add-on">₱</span>
                                                            <input class="span10"  type="number" placeholder="1000.00" name="room_rate" id="room_rate">
                                                    </div>
                                            </div>
                                        </div>



                                        <input class="span11"  type="hidden" name="status" id="status" value="2">
                                        <input class="span11"  type="hidden" name="color_stats" id="color_stats" value="bg_ls">

                                        <div class="form-actions"  style="text-align:right">
                                            <input type="submit" value="Add Room" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>



                      {{--  </div>  --}}
            </div>
    </div>
    </div>

</div>


@endsection

@section('scripts')
<script>
        $('.deleteRecord').click(function(){
            if (confirm('Are you sure you want to delete this Category?')) {
                return true;
            }
            return false;
        });
</script>
@endsection
