<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
use PDF;
use App\FrontDesk;


class GuestController extends Controller
{
    public function getGuestList()
    {
        $customer = Customer::get();
        // we use this to see if the code will run well
        $customer = json_decode(json_encode($customer));

        return view('admin.guest.hotel_guest')->with(compact('customer'));
    }

    public function index(Request $request, $id=null)
    {

        $booking = \App\Booking::where(['bookingroomID'=>$id ])->first();
        $data = $request->all();
        $manages= \App\Manage::where(['id'=>$id])->first();

        $customer = \App\Customer::where(['customer_room_id'=>$id])->first();

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


        return view('admin.status.invoice')->with(compact('manages','booking','customer','hotels','fd_fd'));
    }

    public function export(Request $request, $id=null)
    {
        // $data = ['name'=>'Sarthak'];

        $booking = \App\Booking::where(['bookingroomID'=>$id ])->first();
        $data = $request->all();
        $manages= \App\Manage::where(['id'=>$id])->first();

        $customer = \App\Customer::where(['customer_room_id'=>$id])->first();

        $hotels = \App\Hotel_extra::get();
        // we use this to see if the code will run well
        $hotels = json_decode(json_encode($hotels));
        // displaying the room type and get the id of it transfer to combobox
        $extras = \App\Category_extra::where(['excat_name'=>0])->get();


            $pdf = PDF::loadView('admin.status.print', compact('manages','booking','customer','hotels'));
            return $pdf->stream('invoice.pdf');

    }


}
