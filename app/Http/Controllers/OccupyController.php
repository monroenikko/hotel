<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room_type;
use App\Manage;
use App\Booking;
use DB;
use App\Customer;
use App\Multiple_room;
use App\Reservedate;
use PDF;
use App\Customer_extra;
use App\Hotel_extra;


class OccupyController extends Controller
{
    public function occupyRoom()
    {
        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();
        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        return view('admin.multiple_reservation.occupyRoom.occupy')->with(compact('lastBooking','lastCustId'));
    }

    public function getOccupySave(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post'))
        {
            $tr = new Customer;
            $tr->customer_rsvnno = $id;
            $tr->customer_room_id = '0';
            $tr->customer_name = $data['occupyfirstname'];
            $tr->customer_lastname = $data['occupylastname'];
            $tr->customer_id = $data['result_id1'];
            $tr->customer_origin = $data['origin1'];
            $tr->customer_flightno = $data['flight_no1'];
            $tr->customer_timedeparture = $data['timedeparture1'];
            $tr->customer_companyaAdress = $data['c_address1'];
            $tr->customer_nationality = $data['nationality1'];
            $tr->customer_contactno = $data['contact_no1'];
            $tr->customer_address = $data['address1'];
            $tr->status = '4';
            $tr->save();
        }

        return redirect('/multiple_reservation/getnameOccupy/{id}');

    }

    public function nameOccupy(Request $request, $id=null)
    {
        $data = $request->all();

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->where(['customer_rsvnno'=>$id])->first();

        $customer = Multiple_room::where(['rsvn_no'=>$id])->orderBY('id','DESC')->first();

        $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment'))
                   ->where(['manages.rsvn_no'=>$id])
                   ->get();

        $Manages = Manage::orderBY('room_no','ASC')->where(['status'=>2])->get();

        $Date = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.occupyRoom.occupy_date')->with(compact('lastBooking','lastCustId','manages','Date'));

    }
    //setting up the date again
    public function setdateSave(Request $request, $id=null)
    {
        $data = $request->all();

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Multiple_room::where(['rsvn_no'=>$id])->orderBY('id','DESC')->first();

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();


        $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment'))
                   ->where(['manages.rsvn_no'=>$id])
                   ->get();

        $Manages = Manage::orderBY('room_no','ASC')->where(['status'=>2])->get();


        $Date = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.occupyRoom.occupy_setdate')->with(compact('lastBooking','lastCustId','manages','Date'));

    }

    public function dateOccupy(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post'))
        {
                $tr = new Reservedate;
                $tr->rsvn_no = $id;
                $tr->totalnight = $data['result1'];

                $tr->downpayment= '0';

                $tr->arrivaldate = $data['datefrom2'];
                $tr->departuredate = $data['dateto2'];
                $tr->save();
        }

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();


        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->get();


            $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
            ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment
            ,bookings.checkinDate ,bookings.checkouDate'))
            ->where('bookings.booking_rsvn_no','=',$id)
            ->distinct()
            ->get();


        $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

       $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.occupyRoom.occupy_room')->with(compact('lastBooking','lastCustId','customer','booking','Manages', 'RDate','getIdRoom'));

    }

    public function roomOccupy(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $booking = new Booking;
            $booking->bookingroomID = $data['room_id'];
            $booking->booking_rsvn_no = $id;
            $booking->checkinDate = $data['date_arrival'];
            $booking->checkouDate = $data['date_departure'];
            $booking->bookingroomcategory = $data['room_type'];
            $booking->bookingcustomerID = $data['result_id'];
            $booking->booking_room_no = $data['room_no'];
            $booking->bookingstatusID = '1';
            $booking->bookingTotalNights = $data['totalnight'];
            $booking->booking_rate = $data['room_rate'];

            if($data['downpayment']=='')
            {
                $booking->booking_downpayment = '0';
                $compute = $data['totalnight'] * $data['room_rate'];

                $booking->bookingTotalCost = $compute;
            }
            else
            {
                $booking->booking_downpayment = $data['downpayment'];

                $compute = $data['totalnight'] * $data['room_rate'] - $data['downpayment'];

                $booking->bookingTotalCost = $compute;
            }

            $booking->booking_totalbalance = '0';
            $booking->bookingTotalAdults = '2';
            $booking->bookingTotalChild = '1';
            $booking->booking_billArrangement = '0';
            $booking->booking_status = 'Occupied';
            $booking->save();

            Customer::where(['customer_rsvnno'=>$id])->update(['status'=>'1']);

            Manage::where(['id'=>$data['room_id']])->update(['status'=>'6','color_stats'=>'bg_lr','rsvn_no'=> $id]);


            return redirect()->back();
        }
    }



    //for occupying the reservation

    public function viewOccupyRoom(Request $request, $id=null)
    {

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();


        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->get();


        $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

       $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.guest.occupied.view_occupy_room')->with(compact('lastBooking','lastCustId','customer','booking','Manages', 'RDate','getIdRoom'));
    }

    public function viewExtra(Request $request, $id = null)
    {
        $manages= Manage::where(['id'=>$id])->first();

        $booking = Booking::where(['bookingroomID'=>$id ])->first();

        $customer = Customer::where(['customer_id'=>$id])->orderBY('customer_rsvnno','desc')->first();

            $hotels = Hotel_extra::get();

            $customer1 = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();

            $countCustomerExtra = Customer_extra::where(['room_id'=>$id])->count();

            $CustomerExtra = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer1->customer_id])->get();

            $sum_total = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer1->customer_id])->sum('total_cost');


        return view ('admin.guest.occupied.room_occupy')->with(compact('manages','booking','hotels','customer1','CustomerExtra','sum_total'));
    }

    public function voidOccupyRoom(Request $request, $id = null)
    {
        $data = $request->all();
        $rsvn = Booking::where(['bookingID'=>$id])->first();

        Booking::where(['bookingID'=>$id])->delete();

        Manage::where(['id'=>$rsvn->bookingroomID])
            ->update(['rsvn_no'=>'0000000000','status'=>'2',
                    'color_stats'=>'bg_ls' ]);

        return redirect()->back();
    }


    public function print(Request $request, $id=null)
    {

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->first();

        $booking = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->get();

        $totalsum = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->sum('booking_rate');

        $totalday = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->sum('bookingTotalCost');

        $downpayment = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->sum('booking_downpayment');

        date_default_timezone_set('Singapore');

        $date = date('Y-m-d');

        //$booking1 = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->first();

// for extra start
        $manages= Manage::where(['rsvn_no'=>$id])->first();

        // $customer1 = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();

        $CustomerExtra = Customer_extra::where(['cust_id'=>$customer->customer_id])->where(['extra_rsvn_no'=>$id])->get();

      //  $selectcust = Customer::where('customer_rsvnno'=>$id)

        $selectRoom = Manage::where(['rsvn_no'=>$id])->get();


        $totalextra = Customer_extra::where(['cust_id'=>$customer->customer_id])->sum('total_cost');
// end extra
       // $multiply = $totalsum * $totalday;
        $totalpayment = $totalsum - $downpayment;



        $pdf = PDF::loadView('admin.multiple_reservation.occupyRoom.print', compact('customer','getIdRoom','booking','CustomerExtra',
                            'totalsum','totalpayment','totalday','date','totalextra','selectRoom'));
        return $pdf->stream('invoice.pdf');

    }

    public function print_occupied(Request $request, $id=null)
    {

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->first();

        $booking = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->orderBY('booking_room_no','asc')->get();

        $totalsum = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->orderBY('booking_room_no','asc')->sum('booking_rate');

        $totalday = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->orderBY('booking_room_no','asc')->sum('bookingTotalCost');

        $downpayment = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->orderBY('booking_room_no','asc')->sum('booking_downpayment');

        date_default_timezone_set('Singapore');

        $date = date('Y-m-d');

        //$booking1 = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Checkout!'])->orderBY('booking_room_no','asc')->first();

// for extra start
        $manages= Manage::where(['rsvn_no'=>$id])->first();

        $getroomid = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->count();

        $singlebook = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->first();

        if($getroomid == 1)
        {
            $CustomerExtra = Customer_extra::where(['cust_id'=>$customer->customer_id])
                ->where(['room_id'=>$singlebook->bookingroomID])
                ->where(['extra_rsvn_no'=>$id])
                ->get();
        }
        else
        {
            $CustomerExtra = Customer_extra::where(['cust_id'=>$customer->customer_id])
                ->where(['extra_rsvn_no'=>$id])
                ->where(['status'=>'selected'])
                ->get();
        }

        // $customer1 = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();



      //  $selectcust = Customer::where('customer_rsvnno'=>$id)

        $selectRoom = Manage::where(['rsvn_no'=>$id])->get();


        $totalextra = Customer_extra::where(['cust_id'=>$customer->customer_id])->sum('total_cost');
// end extra
       // $multiply = $totalsum * $totalday;
        $totalpayment = $totalsum - $downpayment;



        $pdf = PDF::loadView('admin.multiple_reservation.occupyRoom.print', compact('customer','getIdRoom','booking','CustomerExtra',
                            'totalsum','totalpayment','totalday','date','totalextra','selectRoom'));
        return $pdf->stream('invoice.pdf');

    }


    public function print1(Request $request, $id=null)
    {

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->first();

        $booking = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Occupied'])->orderBY('booking_room_no','asc')->get();

        $totalsum = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->sum('booking_rate');

        $totalday = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->sum('bookingTotalCost');

        $downpayment = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->sum('booking_downpayment');

        date_default_timezone_set('Singapore');

        $date = date('Y-m-d');

       // $multiply = $totalsum * $totalday;
        $totalpayment = $totalsum - $downpayment;

        $pdf = PDF::loadView('admin.multiple_reservation.print', compact('customer','getIdRoom','booking','CustomerExtra',
                            'totalsum','totalpayment','totalday','date'));
        return $pdf->stream('invoice.pdf');

    }


///for purchase extra

    public function addOccupyExtra(Request $request, $id=null)
    {

        $data = $request->all();

        $customer = \App\Customer::where(['customer_room_id'=>$id])->orderBy('customer_rsvnno','desc')->first();


        if($data['extraqty']=='')
        {
            return redirect()->back()->with('flash_message_error','Qty must have a Value!');;
        }
        else
        {
            $Customer_extra = new Customer_extra;
            $Customer_extra->extra_id = $id;
            $Customer_extra->room_id = $data['rsvn'];
            $Customer_extra->extra_rsvn_no = $data['rsvn1'];
            $Customer_extra->room_no = $data['room_no'];
            $Customer_extra->cust_id = $data['custid'];
            $Customer_extra->extra_name = $data['ename'];
            $Customer_extra->extra_category = $data['ecategory'];
            $Customer_extra->extra_price = $data['eprice'];
            $Customer_extra->extra_qty = $data['extraqty'];
            $total_price = $data['eprice'] * $data['extraqty'];
            $Customer_extra->total_cost = $total_price;
            $Customer_extra->status = 'selected';

            $Customer_extra->save();

            return redirect()->back();return redirect()->back();
        }


    }

    public function voidExtra($id=null)
    {
        Customer_extra::where(['extra_id'=>$id])->delete();
        return redirect()->back();
    }

    public function checkoutOnce(Request $request, $id = null)
    {
        $data = $request->all();

        $booking = Booking::where(['bookingID'=>$id])->first();

        $cust = Customer::where(['customer_rsvnno'=>$booking->booking_rsvn_no])->orderBY('customer_id','desc')->first();

        $countReservation = Booking::where(['booking_rsvn_no'=>$booking->booking_rsvn_no])->count();

        if($countReservation == 1)
        {
            $lastoneleft = Booking::where(['booking_rsvn_no'=>$booking->booking_rsvn_no])->first();

            Booking::where(['bookingID'=>$booking->bookingID ])->update(['booking_status'=>'checkout' ]);
            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$booking->booking_rsvn_no])->where(['id'=>$booking->bookingroomID])
                ->update(['status'=>'2','color_stats'=>'bg_ls','rsvn_no'=>'0000000000']);

            Customer::where(['customer_rsvnno'=>$booking->booking_rsvn_no])->update(['status'=>'0']);

            Customer_extra::where(['extra_rsvn_no'=>$booking->booking_rsvn_no])->where(['room_id'=>$lastoneleft->bookingroomID])
                ->update(['status'=>'paid']);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Checkout Successfuly!');
        }
        else
        {
            Booking::where(['bookingID'=>$booking->bookingID ])->update(['booking_status'=>'checkout' ]);
            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$booking->booking_rsvn_no])->where(['id'=>$booking->bookingroomID])
                ->update(['status'=>'2','color_stats'=>'bg_ls' ]);

            Customer_extra::where(['extra_rsvn_no'=>$booking->booking_rsvn_no])->where(['status'=>'paid']);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Checkout Successfuly!');
        }


    }

    public function checkoutAll(Request $request, $id = null)
    {
        Booking::where(['booking_rsvn_no'=>$id])->update(['booking_status'=>'checkout']);

        Manage::where(['rsvn_no'=>$id])->update(['rsvn_no'=>'0000000000','status'=>'2',
                        'color_stats'=>'bg_ls' ]);

        Customer::where(['customer_rsvnno'=>$id])->update(['status'=>'0']);

        return redirect('/admin/dashboard')->with('flash_message_success','All Room Reserved Successfuly Checkout!');
    }


}
