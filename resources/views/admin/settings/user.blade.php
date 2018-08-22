@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Hotel Room(s)
@endsection

@section('content')
<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href=""  class="current">User</a> </div>
      <h1><i class="icon-edit"></i> User</h1>

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
                                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                    <h5>Add User</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="{{ url('/settings/add-user') }}" name="add_room" id="add_room" novalidate="novalidate">{{ csrf_field() }}

                                        <div class="control-group">
                                            <label class="control-label">Name:</label>
                                            <div class="controls">
                                                <input class="span11" type="text" name="fname" id="fname">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Email Address:</label>
                                            <div class="controls">
                                                <input class="span11" type="email" name="email" id="email">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Password:</label>
                                            <div class="controls">
                                                <input class="span11" type="password" name="password" id="password">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Confirm Password:</label>
                                            <div class="controls">
                                                <input class="span11" type="password" name="cpw" id="cpw">
                                            </div>
                                        </div>





                                        <div class="form-actions"  style="text-align:right">
                                            <input type="submit" value="Save" class="btn btn-success">
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
