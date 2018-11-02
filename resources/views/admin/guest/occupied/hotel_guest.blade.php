@extends('layouts.adminLayout.admin_design')

@section('content_title')
Room Multiple Check-in
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href=""  class="current">Guest List</a> </div>
      <h1><i class="icon-edit"></i> Occupied List</h1>

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
                    <div class="span10">
                        {{--  <div class="container-fluid">  --}}

                                    <div class="widget-box">
                                      <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                        <h5>List of Extra</h5>
                                      </div>
                                      <div class="widget-content nopadding">
                                            <table class="table table-bordered data-table">
                                            <thead>
                                                <tr>
                                                    <th>Customers Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Customer Address</th>
                                                    <th>RSVN No.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                             @foreach($customer as $cus)
                                                <tr class="gradeX">
                                                <td>{{ $cus->customer_name }} {{ $cus->customer_lastname }}</td>

                                                <td>{{ $cus->customer_contactno }}</td>
                                                <td>{{ $cus->customer_address }}</td>
                                                <td>{{ str_pad($cus->customer_rsvnno, 10, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    <center>
                                                        <a href="{{ url('/viewOccupiedCustomer/'.$cus->customer_rsvnno) }}" class="btn btn-success btn-mini"><i class="icon-search"></i> view</a>
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
                </div>
        </div>
    </div>

</div>

@endsection
