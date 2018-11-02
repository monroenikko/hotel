<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Customer_extra;
use PDF;
use App\Report_print;

class ReportController extends Controller
{
    public function reportsCollection(Request $request)
    {
        $data = $request->all();
        $from = '2018-01-01';
        $to = '2018-01-01';

        $getTheqty = Report_print::orderBY('indicator_id','DESC')->first();

        $Booking = Booking::where('checkouDate','>=',$from)
            ->where('checkouDate','<=', $to)
            ->where(['booking_status'=>'checkout'])
            ->get();

        $BookingSum = Booking::where('checkouDate','>=',$from)
            ->where('checkouDate','<=', $to)
            ->where(['booking_status'=>'checkout'])
            ->sum('bookingTotalCost');


        return view('admin.reports.index')->with(compact('Booking','BookingSum','from','to','getTheqty'));
    }

    public function fetchRecord(Request $request, $id=null)
    {
        $data = $request->all();

        $from = $data['datefrom'];
        $to = $data['dateto'];

        $getTheqty = Report_print::orderBY('indicator_id','DESC')->first();

        if($from == '' && $to == '')
        {
            return redirect()->back()->with('flash_message_error','Please Choose the Correct Date! Thank you!');
        }
        else if($from == '' || $to == '')
        {
            return redirect()->back()->with('flash_message_error','Please Choose the Correct Date! Thank you!');
        }

        $Booking = Booking::where('checkouDate','>=',$from)
            ->where('checkouDate','<=', $to)
            ->where(['booking_status'=>'checkout'])
            ->get();



        $BookingSum = Booking::where('checkouDate','>=',$from)
            ->where('checkouDate','<=', $to)
            ->where(['booking_status'=>'checkout'])
            ->sum('bookingTotalCost');


            foreach($Booking as $saveNow){

                $Report_print = new Report_print();
                $Report_print->date = $date = date('Y-m-d');
                $Report_print->indicator_id = $data['indicator_id'];
                $Report_print->arrivaldate= $saveNow->checkinDate;
                $Report_print->departuredate= $saveNow->checkouDate;
                $Report_print->room_no= $saveNow->booking_room_no;
                $Report_print->room_type= $saveNow->bookingroomcategory;
                $Report_print->rom_rate= $saveNow->booking_rate;
                $Report_print->totalnights= $saveNow->bookingTotalNights;
                $Report_print->amount= $saveNow->bookingTotalCost;
                $Report_print->save();
            }



        return view('admin.reports.index')->with(compact('Booking','BookingSum','from','to','getTheqty'));
    }

    public function print(Request $request, $id)
    {
        $data = $request->all();
        $date = date('Y-m-d');

        $getTheqty = Report_print::orderBY('indicator_id','DESC')->first();

        $getDataPrint1 = Report_print::where(['created_at'=>$date])
            ->orderBY('indicator_id','=>', 'DESC')
            ->first();

        $getDataPrint = Report_print::where(['date'=>$date])
            ->where(['indicator_id'=>$id])
            ->get();

        $getSum = Report_print::where(['date'=>$date])
            ->where(['indicator_id'=>$id])
            ->sum('amount');



        $pdf = PDF::loadView('admin.reports.print', compact('getDataPrint','date','getSum'));

        return $pdf->stream('sales_report.pdf');
    }

    public function remittedCollection()
    {
        return view('admin.reports.remitt');
    }
}
