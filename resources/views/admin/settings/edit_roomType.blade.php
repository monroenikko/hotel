@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Room Type
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room_type') }}">Room Type</a> <a href=""  class="current">Edit Room Type</a></div>
      <h1><i class="icon-edit"></i> Edit Room Type</h1>

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
                                    <h5>Edit Room Type Type</h5>
                                  </div>

                                  <div class="widget-content nopadding">
                                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/settings/edit_roomType/'.$types->id) }}" name="edit_Typeroom" id="edit_Typeroom" novalidate="novalidate">{{ csrf_field() }}

                                      <div class="control-group">
                                                {{--  <label class="control-label">Room ID.</label>  --}}
                                                <div class="controls">
                                                  <input type="hidden" name="id" id="id" value="{{ $types->id }}">
                                                </div>
                                      </div>

                                      <div class="control-group">
                                        <label class="control-label">Room Type</label>
                                        <div class="controls">
                                          <input type="text" name="room_type" id="room_type"  value="{{ $types->room_type }}">
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
