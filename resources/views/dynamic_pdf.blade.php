<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>Print</title>
 <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}" />
 <script src="asset('js/app.js') "></script>
 <style>
     .page-break {
         page-break-after: always;
     }
     th, td {
         border: 1px solid #ccc;
         padding: 5px;
     }
     table {
         width: 70%;
         border-spacing: 0;
         border-collapse: collapse;
         font-size : 11px;
     }
     .text-red {
         color : #dd4b39 !important;
     }
     small {
         font-size : 10px;
     }
     body {
        display: block;
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: 10px;
        margin-right: 10px;
        padding-left: 0;
        padding-right: 0;
        text-indent: 0;
    }
    p {
        display: block;
        margin: 0;
        padding: 0;
        text-indent: 1.5em;
        text-align: justify!important;
        line-height: 1.3em;
        font-size: .95em;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
    text-align: center inherit;
    text-indent: 0em;
    }
    h1 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1em 0 .2em;
        font-size: 1.6em;
        line-height: 1.2em;
    }

    h2 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1em 0 .2em;
        font-size: 1.3em;
        line-height: 1.2em;
    }

    h3 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1.4em 0 .2em;
        font-size: 1.2em;
        line-height: 1.2em;
    }

    h4 {
        text-align: center;
        font-weight: bold;
        text-indent: 0em;
        page-break-after: avoid;
        margin: 1.4em 0 .2em;
        font-size: 1.1em;
        line-height: 1.2em;
    }
 </style>
 </style>
 </head>
 <body>
 <br />
  <div class="container">
   <div class="row">
        <div class="col-md-7" align="right">
            <h2><img width="10%" src="{{ asset('images/unclogo.png') }}" alt="Logo" />UNC HOTEL RESERVATIONS</h2>
        </div>

        <div class="col-md-5" align="right">
            <a href="{{ URL::to('/customers/pdf') }}" class="btn btn-danger">Convert into PDF</a>
       </div>
    </div>
 <br/>
        <p>RSVN No.:</p>
        <p>Name of Guest:</p>
        <p>Arrival Date:</p>
        <p>Departure Date:</p>
        <p>Number of Days/Nights:</p>
        <p>Origin:</p>
        <p>Flight No.:</p>
        <p>Time Departure:</p>
        <p>Company Address:</p>
        <p>Nationality:</p>
        <p>Contact No.:</p>
        <p>Address No.:</p>
        <p>Guest Type:</p>
        <p>Bill Arrangement:</p>
 <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>Name</th>
       <th>Address</th>
       <th>City</th>
       <th>Postal Code</th>
       <th>Country</th>
      </tr>
     </thead>
     <tbody>
     @foreach($data as $customer)
      <tr>
       <td>{{ $customer->customer_name }}</td>
       <td>{{ $customer->customer_address }}</td>
       <td>{{ $customer->customer_contactno }}</td>
       <td>{{ $customer->customer_nationality }}</td>
       <td>{{ $customer->customer_companyaAdress }}</td>
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>
