@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Edit Front Desk
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href=""  class="current">Front Desk</a></div>
      <h1><i class="icon-edit"></i> Edit Front Desk</h1>

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
                                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/settings/update_fd/'.$front_desk->frontdesk_id) }}" name="edit_fd" id="edit_fd" novalidate="novalidate">{{ csrf_field() }}

                                    <div class="control-group">

                                            <div class="controls">
                                              <input type="hidden" name="id" id="id" value="{{ $front_desk->frontdesk_id }}">
                                            </div>
                                    </div>

                                      <div class="control-group">
                                        <label class="control-label">Front Desk Name</label>
                                        <div class="controls">
                                          <input type="text" name="fdeskname" id="fdeskname"  value="{{ $front_desk->frontdesk_fname }}">
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
