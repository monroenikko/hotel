@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room') }}">Room</a> <a href=""  class="current">Edit Room</a> </div>
      <h1><i class="icon-edit"></i> Edit Room</h1>

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
                        <div class="span6">
                                <div class="widget-box">
                                  <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Edit Products</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/settings/edit_room/'.$manages->id) }}" name="edit_room" id="edit_room" novalidate="novalidate">{{ csrf_field() }}

                                      <div class="control-group">
                                        <label class="control-label">Room No.</label>
                                        <div class="controls">
                                          <input type="text"  class="span11" name="room_no" id="room_no" value="{{ $manages->room_no }}">
                                        </div>
                                      </div>

                                      <div class="control-group">
                                        <label class="control-label">Room Type</label>
                                        <div class="controls">
                                            <select name="room_type" class="span11">
                                                <option value="0">Room Type</option>
                                                {{-- to display the main category level --}}
                                                {{-- if is to compare the parent id and to display the subcategory of it --}}
                                                @foreach($levels as $val)
                                                  <option value="{{ $val->room_type }}"
                                                     @if($val->room_type == $manages->room_type)
                                                     selected
                                                     @endif>
                                                     {{ $val->room_type }}
                                                  </option>
                                                @endforeach

                                              </select>
                                        </div>
                                      </div>


                                      <div class="control-group">
                                        <label class="control-label">Room Rate</label>
                                        <div class="controls">
                                          <input type="number"  class="span11" name="room_rate" id="room_rate"  value="{{ $manages->room_rate }}">
                                        </div>
                                      </div>




                                      <div class="form-actions" style="text-align:right">
                                        <input type="submit" value="Save" class="btn btn-success">
                                      </div>
                                    </form>

                                  </div>
                                </div>
                              </div>
                </div>
        </div>
    </div>

</div>

@endsection
