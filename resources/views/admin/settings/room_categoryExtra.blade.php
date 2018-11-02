@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{url('/settings/room_categoryExtra')}}"  class="current">Category of Extra</a> </div>
      <h1><i class="icon-edit"></i> Category of Extra</h1>

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
    <div class="row-fluid">
            <div class="span6">
                    {{--  <div class="container-fluid">  --}}

                                <div class="widget-box">
                                  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                    <h5>Category of Extra</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                        <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Category Extra</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($categories as $category)
                                            <tr class="gradeX">
                                            <td>{{ $category->excat_name }}</td>
                                            <td class="center">
                                                <center>
                                                <a href="{{ url('/settings/edit_extraCategory/'.$category->excat_id) }}" class="btn btn-primary btn-mini">Edit</a>

                                                <a href="{{ url('/settings/delete-roomextracategory/'.$category->excat_id) }}" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                                </center>
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
                                <h5>Add Category Extra</h5>
                              </div>
                              <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{ url('/settings/room-addcategoryExtra') }}" name="add_extraCategory" id="add_extraCategory" novalidate="novalidate">{{ csrf_field() }}

                                  <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <div class="controls">
                                      <input type="text" class="span11" name="excat_name" id="excat_name">
                                    </div>
                                  </div>

                                  <div class="form-actions" style="text-align:right">
                                    <input type="submit" value="Add" class="btn btn-success">
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
