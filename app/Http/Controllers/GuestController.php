<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
use PDF;
use App\FrontDesk;
use App\Customer_extra;
use App\Manage;
use App\Booking;
use App\Reservedate;


class GuestController extends Controller
{

//start Occupy GUest
    public function getOccupyGuestList()
    {
        $customer = Customer::where(['status'=>1])->orderBY('customer_id','desc')->get();

        return view('admin.guest.occupied.hotel_guest')->with(compact('customer'));
    }

    public function viewCustomerOccupy(Request $request, $id=null)
    {
        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->get();

        $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

        $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.guest.occupied.view_occupy_room')->with(compact('lastBooking','lastCustId','customer','booking','Manages', 'RDate','getIdRoom'));
    }
//end Occupy

//start for reserved guest code
    public function getReservedGuestList()
    {
        $customer = Customer::where(['status'=>2])->orderBY('customer_id','desc')->get();

        return view('admin.guest.reserved.reserved_guest')->with(compact('customer'));
    }

    public function viewCustomerReserve(Request $request, $id=null)
    {
        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->get();

        $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

        $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.guest.reserved.view_reserved')->with(compact('lastBooking','lastCustId','customer','booking','Manages', 'RDate','getIdRoom'));
    }
//end reserved guest

    public function getGuestArchive()
    {
        $customer = Customer::where(['status'=>0])->orderBY('customer_id','desc')->get();

        return view('admin.guest.hotel_archive')->with(compact('customer'));
    }


    public function index(Request $request, $id=null)
    {
        //$booking = \App\Booking::where(['bookingroomID'=>$id ])->first();

        $data = $request->all();
        $manages= \App\Manage::where(['id'=>$id])->first();

        $booking= \App\Booking::orderBy('booking_rsvn_no', 'desc')->where(['booking_rsvn_no'=>$manages->rsvn_no])->first();

        $customer = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();

        //$customer = \App\Customer::where(['customer_room_id'=>$id])->orderBy('customer_rsvnno','desc')->first();

        $count_room = Customer::where(['customer_room_id' => $id])->count();

        $hotels = \App\Hotel_extra::get();
        // we use this to see if the code will run well
        $hotels = json_decode(json_encode($hotels));
        // displaying the room type and get the id of it transfer to combobox
        $extras = \App\Category_extra::where(['excat_name'=>0])->get();
        // echo "<pre>"; print_r($categories); die;
        $fd = FrontDesk::where(['frontdesk_fname'=>0])->get();

        $fd_fd ="<option value='0'>Front Desk Name</option>";

        foreach($fd as $val)
        {
            $fd_fd .="<option value=".$val->frontdesk_fname.">".$val->frontdesk_fname."</option>";
        }

        //$CustomerExtra = Customer_extra::where(['room_id'=>$id ])->get();
        //$sum_total = Customer_extra::where(['room_id'=>$id ])->sum('total_cost');
        $CustomerExtra = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer->customer_id])->get();
        $sum_total = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer->customer_id])->sum('total_cost');

        if( $booking->booking_totalbalance == 0)
        {
            $customertotal = $sum_total + $booking->bookingTotalCost;
        }
        else
        {
            $customertotal = $sum_total + $booking->booking_totalbalance;
        }

        Customer_extra::where(['extra_rsvn_no'=>$booking->booking_rsvn_no])->where(['room_id'=>$booking->bookingroomID])
        ->update(['status'=>'paid']);


        return view('admin.status.invoice')->with(compact('manages','booking','customer','hotels','fd_fd','count_room','CustomerExtra','sum_total','customertotal'));
    }

    public function export(Request $request, $id=null)
    {
        // $data = ['name'=>'Sarthak'];
        //$booking = \App\Booking::where(['bookingroomID'=>$id ])->first();

       // $booking= \App\Booking::orderBy('booking_rsvn_no', 'desc')->first();


        $data = $request->all();
        $manages = \App\Manage::where(['id'=>$id])->first();

        $booking= \App\Booking::orderBy('booking_rsvn_no', 'desc')->where(['bookingroomID'=>$id])->first();

        $bookingdownpayment= \App\Booking::orderBy('booking_rsvn_no', 'desc')->where(['bookingroomID'=>$id])->where(['booking_rsvn_no'=>$manages->id])->sum('booking_downpayment');
        $bookingfee= \App\Booking::orderBy('booking_rsvn_no', 'desc')->where(['bookingroomID'=>$id])->where(['booking_rsvn_no'=>$manages->id])->sum('booking_rate');

        $totalcostroom = $bookingfee + $bookingdownpayment;

        $customer = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();
        //$customer = \App\Customer::where(['customer_room_id'=>$id])->orderBy('customer_rsvnno','desc')->first();

        $count_room = Customer::where(['customer_room_id' => $id])->count();

        $hotels = \App\Hotel_extra::get();
        // we use this to see if the code will run well
        $hotels = json_decode(json_encode($hotels));
        // displaying the room type and get the id of it transfer to combobox
        $extras = \App\Category_extra::where(['excat_name'=>0])->get();


        $CustomerExtra = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer->customer_id])->get();

        $sum_total = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer->customer_id])->sum('total_cost');


            $customertotal = $sum_total + $booking->bookingTotalCost;



        Manage::where(['id'=>$id])->update(['status'=>'2',
        'color_stats'=>'bg_ls','rsvn_no'=>'0000000000']);

        Booking::where(['bookingroomID'=>$id])->update(['booking_status'=>'checkout']);

        Customer::where(['customer_room_id'=>$id])->update(['status'=>'0']);

            $pdf = PDF::loadView('admin.status.print', compact('manages','booking','customer','hotels','count_room','CustomerExtra','sum_total','customertotal','$totalcostroom'));
            return $pdf->stream('invoice.pdf');

    }


}
