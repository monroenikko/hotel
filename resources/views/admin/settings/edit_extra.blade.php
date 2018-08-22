@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ url('/settings/room_extra') }}">Room Extra</a> <a href=""  class="current">Edit Room Extra</a> </div>
      <h1><i class="icon-edit"></i> Edit Extra</h1>

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
                                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/settings/edit_extra/'.$hotelx->hotex_id) }}" name="edit_hextra" id="edit_hextra" novalidate="novalidate">{{ csrf_field() }}


                                      <div class="control-group">
                                                <div class="controls">
                                                  <input type="hidden"  class="span11" name="hotex_id" id="hotex_id" value="{{ $hotelx->hotex_id }}">
                                                </div>
                                      </div>

                                      <div class="control-group">
                                        <label class="control-label">Extra Name</label>
                                        <div class="controls">
                                          <input type="text"  class="span11" name="hotex_name" id="hotex_name" value="{{ $hotelx->hotex_name }}">
                                        </div>
                                      </div>

                                      <div class="control-group">
                                        <label class="control-label">Extra Category</label>
                                        <div class="controls">
                                            <select name="hotex_category" class="span11">
                                                <option value="0">Select Category</option>
                                                {{-- to display the main category level --}}
                                                {{-- if is to compare the parent id and to display the subcategory of it --}}
                                                @foreach($cats as $val)
                                                  <option value="{{ $val->excat_name }}"
                                                     @if($val->excat_name == $hotelx->hotex_category)
                                                     selected
                                                     @endif>
                                                     {{ $val->excat_name }}
                                                  </option>
                                                @endforeach

                                              </select>
                                        </div>
                                      </div>


                                      <div class="control-group">
                                        <label class="control-label">Extra Price</label>
                                        <div class="controls">
                                          <input type="number"  class="span11" name="hotex_price" id="hotex_price"  value="{{ $hotelx->hotex_price }}">
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
