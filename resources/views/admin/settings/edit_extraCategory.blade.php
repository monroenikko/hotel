@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room_categoryExtra') }}" >Category of Extra</a> <a href=""  class="current">Edit Category Extra</a></div>
      <h1><i class="icon-edit"></i> Edit Category Extra</h1>

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
                                    <h5>Edit Category Extra</h5>
                                  </div>

                                  <div class="widget-content nopadding">
                                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/settings/edit_extraCategory/'.$categories->excat_id) }}" name="edit_exCat" id="edit_exCat" novalidate="novalidate">{{ csrf_field() }}

                                      <div class="control-group">
                                                {{--  <label class="control-label">Room ID.</label>  --}}
                                                <div class="controls">
                                                  <input type="hidden" name="excat_id" id="excat_id" value="{{ $categories->excat_id }}">
                                                </div>
                                      </div>

                                      <div class="control-group">
                                        <label class="control-label">Category Extra</label>
                                        <div class="controls">
                                          <input type="text" name="excat_name" id="excat_name"  value="{{ $categories->excat_name }}">
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
