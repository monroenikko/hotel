@extends('layouts.adminLayout.admin_design')

@section('content_title')
    Room Occupy
@endsection

@section('content')

<div id="content">

    <div id="content-header">
      <div id="breadcrumb"><a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="" class="current">Reserve</a> </div>
        <h1><img src="{{ asset('images/checkin.png') }}"  />Room no. {{ $manages->room_no }} ({{ $manages->room_type }})</h1>

      <div class="container-fluid">
            <hr><h3>Departure Date: <span style="color:orangered">{{ $booking->checkouDate }}</span></h3>


        <a href="{{ url('/status/invoice/'.$manages->id ) }}" class="btn btn-danger pull-right">Proceed to Check out</a>

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


                            <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>List of Extra</h5>
                            </div>
                            <div class="widget-content nopadding">
                                    <table id="extratable" class="table table-bordered data-table">
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
                                        <td id="name1">{{ $hotelex->hotex_name }}</td>
                                        <td id="category1">{{ $hotelex->hotex_category }}</td>
                                        <td id="price1">

                                            <?php
                                                    $hotelex->hotex_price;
                                                    $formattedNum = number_format($hotelex->hotex_price, 2);
                                                    echo $formattedNum;
                                            ?>

                                        </td>
                                        <td class="center">
                                            <center>
                                                <button class="btnSelect btn btn-success btn-mini"><i class="icon-plus"></i></button>
                                            </center>
                                        </td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                    </table>
                            </div>
                            </div>



            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>List of Guest Extra(s)</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Extra</th>
                                    <th>Qty</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    <span id="val" style="text-align: left; display: none"></span>

                </div>

                <div class="control-group ">
                        <label class="control-label">Total:</label>
                        <div class="controls">
                            <div class="input-append">
                                    <span class="add-on">₱</span>
                            <input style="color: red" type="number"  class="span12" value="0" name="val1" id="val1" disabled="disabled">
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


$("#extratable").on('click','.btnSelect',function(){
    // get the current row
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
    var col2=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
    var col3=currentRow.find("td:eq(2)").html(); // get current row 3rd table cell TD value
    //var data=col1+"\n"+col2+"\n"+col3;
    //alert(data);

    var table = document.getElementById("myTable");
    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.innerHTML = col1;
    cell2.innerHTML = col2;
    cell3.innerHTML = col3;
    cell4.innerHTML = '<center><button id="deletedata" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button></center>';

    var table = document.getElementById("myTable"), sumVal = 0;

                for(var i = 1; i < table.rows.length; i++)
                {
                    sumVal = sumVal + parseFloat(table.rows[i].cells[2].innerHTML);
                }

            document.getElementById("val").innerHTML = "Total: " + sumVal;
            console.log(sumVal);

            $('#val1').val(sumVal);
});



$("#myTable").on('click','#deletedata',function(){

       var index, table = document.getElementById('myTable') , sumVal = 0;
       var currentRow=$(this).closest("tr");
       var col1=currentRow.find("td:eq(0)").html();
       var col2=currentRow.find("td:eq(1)").html();
       var col3=currentRow.find("td:eq(2)").html();


            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].cells[3].onclick = function()
                {
                    var c = confirm("do you want to delete the item "+col1+"?");
                    if(c === true)
                    {
                        index = this.parentElement.rowIndex;
                        table.deleteRow(index);

                        for(var i = 1; i < table.rows.length; i++)
                        {
                            sumVal = sumVal + parseFloat(table.rows[i].cells[2].innerHTML);
                        }

                        document.getElementById("val").innerHTML = "Total: " + sumVal;
                        console.log(sumVal);

                        $('#val1').val(sumVal);


                    }

                    //console.log(index);
                };

            }
});






</script>
@endsection

