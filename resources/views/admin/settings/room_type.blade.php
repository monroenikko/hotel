@extends('layouts.adminLayout.admin_design')

@section('content_title')
    Room Type
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room') }}"  class="current">Room Type</a> </div>
      <h1><i class="icon-edit"></i> Room Type</h1>

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
            <div class="span6">
                    {{--  <div class="container-fluid">  --}}
                                <div class="widget-box">
                                  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                    <h5>Room Type List</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                        <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Room ID</th>
                                                <th>Room Type</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($types as $type)
                                            <tr class="gradeX">
                                                <td>{{ $type->id }}</td>
                                                <td>{{ $type->room_type }}</td>


                                                <td class="center">
                                                    <center>
                                                    <a href="{{ url('/settings/edit_roomType/'.$type->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="delCat" href="{{ url('/settings/type-room/'.$type->id) }}" class="btn btn-danger btn-mini">Delete</a>
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
            <div class="span6">
                    {{--  <div class="container-fluid">  --}}
                            <div class="widget-box">
                              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Add Room Type</h5>
                              </div>
                              <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{ url('/settings/room-type') }}" name="room_Type" id="room_Type" novalidate="novalidate">{{ csrf_field() }}

                                  <div class="control-group">
                                    <label class="control-label">Room Type</label>
                                    <div class="controls">
                                      <input type="text" class="span11" name="room_type" id="room_type">

                                    </div>
                                  </div>




                                  <div class="form-actions" style="text-align:right">
                                    <input type="submit" value="Add Room Type" class="btn btn-success">
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
