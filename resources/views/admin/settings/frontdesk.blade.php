@extends('layouts.adminLayout.admin_design')

@section ('content_title')
    Front-desk
@endsection

@section('content')
<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/settings/room') }}"  class="current">Front Desk</a> </div>
      <h1><i class="icon-edit"></i> Front Desk</h1>

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
                                    <h5>Front Desk List</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                        <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Front Desk Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($front_desk as $fd)
                                                <tr class="gradeX">

                                                    <td>{{ $fd->frontdesk_fname }}</td>

                                                    <td class="center">
                                                        <center>
                                                        <a href="{{ url('/settings/update_fd/'.$fd->frontdesk_id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                        {{--  <a href="{{ $manage->id }}" class="btn btn-primary btn-mini">Edit</a>  --}}
                                                        <a href="{{ url('/settings/delete-frontdesk/'.$fd->frontdesk_id) }}" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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
                                    <h5>Add Front Desk Name</h5>
                                </div>

                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="{{ url('/settings/add-fd') }}" name="fdesk" id="fdesk" novalidate="novalidate">{{ csrf_field() }}

                                        <div class="control-group">
                                            <label class="control-label">Front Desk Name</label>
                                            <div class="controls">
                                                <input class="span11" type="text" name="fname" id="fname">
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

@section('name')
<script>
        $('.deleteRecord').click(function(){
            if (confirm('Are you sure you want to delete this Category?')) {
                return true;
            }
            return false;
        });
</script>
@endsection
