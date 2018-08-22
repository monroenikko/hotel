@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#"  class="current">Extra's</a> </div>
      <h1><i class="icon-edit"></i> Extra's</h1>

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
                                    <h5>Extra</h5>
                                  </div>
                                  <div class="widget-content nopadding">
                                        <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Extra</th>
                                                <th>Category</th>
                                                <th>Price (₱)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($hotels as $hotelex)
                                            <tr class="gradeX">
                                            <td>{{ $hotelex->hotex_name }}</td>
                                            <td>{{ $hotelex->hotex_category }}</td>
                                            <td>

                                                <?php
                                                        $hotelex->hotex_price;
                                                        $formattedNum = number_format($hotelex->hotex_price, 2);
                                                        echo $formattedNum;
                                                ?>

                                            </td>
                                            <td class="center">
                                                <center>
                                                <a href="{{ url('/settings/edit_extra/'.$hotelex->hotex_id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                <a href="#" class="btn btn-success btn-mini">Publish</a>
                                                <a id="delCat" href="{{ url('/admin/delete-category/'.$hotelex->hotex_id) }}" class="btn btn-danger btn-mini">Delete</a></td>
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
                                <h5>Add Extra</h5>
                              </div>
                              <div class="widget-content nopadding">
                                <form class="form-horizontal" method="post" action="{{ url('/settings/add-extra') }}" name="add_extra" id="add_extra" novalidate="novalidate">{{ csrf_field() }}

                                  <div class="control-group">
                                    <label class="control-label">Extra Name</label>
                                    <div class="controls">
                                      <input type="text" class="span11" name="hotex_name" id="hotex_name">
                                    </div>
                                  </div>

                                  <div class="control-group">
                                        <label class="control-label">Select Category</label>
                                        <div class="controls">

                                          <select class="span11" name="hotex_category">

                                            <option value="0">Category Extra</option>

                                                @foreach($extras as $val)
                                                <option value="{{ $val->excat_name }}">{{ $val->excat_name }}</option>
                                                @endforeach

                                          </select>

                                        </div>
                                      </div>


                                  <div class="control-group">
                                      <label class="control-label">Price</label>
                                      <div class="controls">
                                          <input class="span11" type="number" name="hotex_price" id="hotex_price">
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
