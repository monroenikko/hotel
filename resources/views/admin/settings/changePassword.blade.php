@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Change Password
@endsection

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Change Password</a> </div>
    <h1>Admin Settings</h1>

    {{--  put the session here to know if the password is successfuly updated of not  --}}
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
  <div class="container-fluid"><hr>

    <div class="row-fluid">

      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Password</h5>
            </div>
            <div class="widget-content nopadding">
              {{--  use csrf_field right the 1st row and the url for routes  --}}
              <form class="form-horizontal" method="post" action="{{ url('/admin/update-pwd') }}" name="password_validate" id="password_validate" novalidate="novalidate">{{ csrf_field() }}
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input type="password" name="current_pwd" id="current_pwd" />
                    <span id="chkPwd"></span>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input type="password" name="new_pwd" id="new_pwd" />
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Confirm Password</label>
                  <div class="controls">
                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Password" class="btn btn-success">
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

@section('scripts')
<script>
        $("#current_pwd").keyup(function() {
            var current_pwd = $("#current_pwd").val();
            $.ajax({
                type: 'get',
                url: '/admin/check-pwd',
                data: { current_pwd: current_pwd },
                success: function(resp) {
                    // alert(resp);
                    if (resp == "false") {
                        $('#chkPwd').html("<font color='red'>Current Password is Incorrect</font>");
                    } else if (resp == "true") {
                        $('#chkPwd').html("<font color='green'>Current Password is Correct</font>");
                    }
                },
                error: function() {

                }
            });
        });
</script>
@endsection
