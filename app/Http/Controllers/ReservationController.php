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

class ReservationController extends Controller
{
    public function getReserve(Request $request, $id=null)
    {
        $data = $request->all();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $room ="<option value='0'>Room Available</option>";

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();

        foreach($manages as $valroom)
        {
            $room .="<option value=".$valroom->id.">".$valroom->room_type." ".$valroom->room_no."</option>";
        }


        return view('admin.multiple_reservation.index')->with(compact('lastBooking','lastCustId','room','booking'));
    }

    public function viewReserve(Request $request, $id=null)
    {
        $data = $request->all();

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();
        $lastCustId = Customer::orderBY('Customer_id','desc')->first();


        return view('admin.multiple_reservation.reserved')
            ->with(compact('types_roomtype','room','booking','lastBooking','lastCustId','Manages'));
    }

    public function getSave(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post'))
        {
            $tr = new Customer;
            $tr->customer_rsvnno = $id;
            $tr->customer_room_id = '0';
            $tr->customer_name = $data['firstname'];
            $tr->customer_lastname = $data['lastname'];
            $tr->customer_id = $data['result_id1'];
            $tr->customer_origin = 'blank';
            $tr->customer_flightno = '0';
            $tr->customer_timedeparture = '00:00:00';
            $tr->customer_companyaAdress = 'blank';
            $tr->customer_nationality = 'blank';
            $tr->customer_contactno = 'blank';
            $tr->customer_address = 'blank';
            $tr->status = '4';
            $tr->save();
        }

        //return view('admin.multiple_reservation.reserved_date')->with(compact('lastBooking','lastCustId'));
        return redirect('/multiple_reservation/getnameReserve/{id}');

    }



    public function dateReserved(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post'))
        {
                $tr = new Reservedate;
                $tr->rsvn_no = $id;
                $tr->totalnight = $data['result1'];

                if($data['downpayment']=='')
                {
                    $tr->downpayment= '0';
                }
                else
                {
                    $tr->downpayment = $data['downpayment'];
                }

                $tr->arrivaldate = $data['datefrom2'];
                $tr->departuredate = $data['dateto2'];
                $tr->save();
        }

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $room ="<option value='0'>Room Available</option>";

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();

        foreach($manages as $valroom)
        {
            $room .="<option value=".$valroom->id.">".$valroom->room_type." ".$valroom->room_no."</option>";
        }


        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->get();


            $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
            ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment
            ,bookings.checkinDate ,bookings.checkouDate'))
            ->where('bookings.booking_rsvn_no','=',$id)
            ->distinct()
            ->get();

        //$booking = Booking::where(['booking_rsvn_no'=>$id])->get();

        $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

        /*
        $customer = Booking::join('customers', 'customers.customer_rsvnno', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('customers.customer_name,customers.customer_lastname, bookings.bookingTotalNights,
                   bookings.checkinDate, bookings.checkouDate, bookings.booking_downpayment, customers.customer_rsvnno'))
                   ->where(['customers.customer_rsvnno'=>$id])
                   ->first();
        */

        $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.reserved_2ndstep')->with(compact('lastBooking','lastCustId','customer','booking','Manages', 'RDate','getIdRoom'));

    }

    public function nameReserved(Request $request, $id=null)
    {
        $data = $request->all();

        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Multiple_room::where(['rsvn_no'=>$id])->orderBY('id','DESC')->first();

        $room ="<option value='0'>Room Available</option>";

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();

        $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment'))
                   ->where(['manages.rsvn_no'=>$id])
                   ->get();

        $Manages = Manage::orderBY('room_no','ASC')->where(['status'=>2])->get();

        $Date = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.reserved_date')->with(compact('lastBooking','lastCustId','manages','Date'));

    }

    public function getdateSave(Request $request, $id=null)
    {
        $data = $request->all();


        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->where(['customer_rsvnno'=>$id])->first();

        $customer = Multiple_room::where(['rsvn_no'=>$id])->orderBY('id','DESC')->first();

        $room ="<option value='0'>Room Available</option>";

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();


        $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment'))
                   ->where(['manages.rsvn_no'=>$id])
                   ->get();

        $Manages = Manage::orderBY('room_no','ASC')->where(['status'=>2])->get();


        $Date = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$id])->first();

        return view('admin.multiple_reservation.reserved_setdate')->with(compact('lastBooking','lastCustId','manages','Date'));

    }


    public function roomReserved(Request $request, $id=null)
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
            $booking->booking_status = 'Reserved';
            $booking->save();

            Customer::where(['customer_rsvnno'=>$id])->update(['status'=>'2']);

            Manage::where(['id'=>$data['room_id']])->update(['rsvn_no'=>$id,'status'=>'4',
                    'color_stats'=>'bg_lg' ]);

            return redirect()->back();

            //return view('admin.multiple_reservation.reserved_2ndstep');
        }
    }

    public function voidRoom(Request $request,$id=null)
    {
        $data = $request->all();
        $rsvn = Booking::where(['bookingID'=>$id])->first();

        Booking::where(['bookingID'=>$id])->delete();

        Manage::where(['id'=>$rsvn->bookingroomID])->update(['rsvn_no'=>'0000000000','status'=>'2',
                    'color_stats'=>'bg_ls' ]);

        return redirect()->back();

        //return redirect('/admin/dashboard')->with('flash_message_success','Room Reserved Successfuly Cancelled!');
    }

    public function voidAllRoom(Request $request,$id=null)
    {
        //$ids = $request->ids;

       $selectAll = Booking::where(['booking_rsvn_no'=>$id])->get();


        Booking::where(['booking_rsvn_no'=>$id])->delete();

        Manage::where(['rsvn_no'=>$id])->update(['rsvn_no'=>'0000000000','status'=>'2',
                        'color_stats'=>'bg_ls' ]);


        Customer::where(['customer_rsvnno'=>$id])->delete();

        return redirect('/admin/dashboard')->with('flash_message_success','Room Reserved Successfuly Cancelled!');
    }

    public function print(Request $request, $id=null)
    {

        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->first();

        $booking = Booking::where(['booking_rsvn_no'=>$id])->where(['booking_status'=>'Reserved'])->orderBY('booking_room_no','asc')->get();

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

    public function getdateSave1(Request $request, $id=null)
    {
        $data = $request->all();


        $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

        $lastCustId = Customer::orderBY('Customer_id','desc')->first();

        $customer = Multiple_room::where(['rsvn_no'=>$id])->orderBY('id','DESC')->first();

        $room ="<option value='0'>Room Available</option>";

        $manages = Manage::orderBY('room_no','asc')->where(['status'=>'2'])->get();


        $booking = Booking::join('manages', 'manages.rsvn_no', '=', 'bookings.booking_rsvn_no')
                   ->select(\DB::raw('manages.room_type, bookings.bookingTotalNights, manages.room_no, manages.room_rate, bookings.booking_downpayment'))
                   ->where(['manages.rsvn_no'=>$id])
                   ->get();

        $Manages = Manage::orderBY('room_no','ASC')->where(['status'=>2])->get();


        $Date = Reservedate::where(['rsvn_no'=>$id])->orderBY('id','desc')->first();

        return view('admin.guest.reserved.reserved_setdate')->with(compact('lastBooking','lastCustId','manages','Date','id'));

    }

    public function viewOccupyApplication(Request $request, $id=null)
    {
        $cust = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        return view('admin.guest.reserved.room_reserved')->with(compact('cust'));
    }

    public function occupyReserveRoom(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post')){
        //this is for occupy status 1
            Customer::where(['customer_rsvnno'=>$id ])->update(['customer_origin'=>$data['origin'],
            'customer_flightno'=>$data['flight_no'], 'customer_timedeparture'=>$data['timedeparture'], 'customer_companyaAdress'=>$data['c_address'],
            'customer_nationality'=>$data['nationality'], 'customer_contactno'=>$data['contact_no'], 'customer_address'=>$data['address'], 'status' => '1']);


            Booking::where(['booking_rsvn_no'=>$id ])
                ->update(['booking_billArrangement'=>$data['billarrangement'], 'booking_status'=>'Occupied' ]);

            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$id])->update(['status'=>'6',
            'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room has been Occupied Successfully!');

        }
    }
    //this is for occupy to 1 room because of different date-arrival
    public function occupySpecificRoom(Request $request, $id=null)
    {
        $data = $request->all();

        $booking = Booking::where(['bookingID'=>$id])->first();

        $cust = Customer::where(['customer_rsvnno'=>$booking->booking_rsvn_no])->orderBY('customer_id','desc')->first();

        if($cust->customer_origin=='blank')
        {
            return view('admin.guest.reserved.room_reserved1')->with(compact('cust','booking'));
        }
        else
        {
            Booking::where(['bookingID'=>$booking->bookingID ])->update(['booking_status'=>'Occupied' ]);

            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$booking->booking_rsvn_no])->where(['id'=>$booking->bookingroomID])->update(['status'=>'6',
            'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Occupied Successfuly!');
        }


    }

    public function occupyOnlyOne(Request $request, $id=null)
    {
        $data = $request->all();
        //the data of id is bookingID

        $booking = Booking::where(['bookingID'=>$id])->first();

        $cust = Customer::where(['customer_rsvnno'=>$booking->booking_rsvn_no ])->orderBY('customer_id','desc')->first();

        if($cust->customer_origin=='blank')
        {
            //this is for occupy status 1
            Customer::where(['customer_rsvnno'=>$booking->booking_rsvn_no ])->update(['customer_origin'=>$data['origin'],
            'customer_flightno'=>$data['flight_no'], 'customer_timedeparture'=>$data['timedeparture'], 'customer_companyaAdress'=>$data['c_address'],
            'customer_nationality'=>$data['nationality'], 'customer_contactno'=>$data['contact_no'], 'customer_address'=>$data['address'], 'status' => '1']);


            Booking::where(['bookingID'=>$booking->bookingID ])
                ->update(['booking_billArrangement'=>$data['billarrangement'], 'booking_status'=>'Occupied' ]);

            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$booking->booking_rsvn_no])->where(['id'=>$booking->bookingroomID])->update(['status'=>'6',
            'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Occupied Successfuly!');
        }
        else
        {
            Booking::where(['bookingID'=>$booking->bookingID ])
                ->update(['booking_billArrangement'=>$data['billarrangement'], 'booking_status'=>'Occupied' ]);

            //this is for occupy status for 6
            Manage::where(['rsvn_no'=>$booking->booking_rsvn_no])->where(['id'=>$booking->bookingroomID])->update(['status'=>'6',
            'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Occupied Successfuly!');
        }
    }



    public function cancelReservedRoom(Request $request, $id=null)
    {
        $data = $request->all();

        $select = Booking::where(['bookingID'=>$id])->first();


        Booking::where(['bookingID'=>$select->bookingID])->update(['booking_status'=>'cancel']);

        Manage::where(['rsvn_no'=>$select->booking_rsvn_no])->update(['rsvn_no'=>'0000000000','status'=>'2',
                        'color_stats'=>'bg_ls' ]);


        return redirect('/admin/dashboard')->with('flash_message_success','Room Reserved Successfuly Cancelled!');


    }

    public function cancelTheRoom(Request $request,$id=null)
    {
        $data = $request->all();
        $rsvn = Booking::where(['bookingID'=>$id])->first();

       // Booking::where(['bookingID'=>$id])->delete();
        Booking::where(['bookingID'=>$id])->update(['booking_status'=>'Cancel']);
        Manage::where(['id'=>$rsvn->bookingroomID])->update(['rsvn_no'=>'0000000000','status'=>'2',
                    'color_stats'=>'bg_ls' ]);

        //return redirect()->back();

        return redirect('/admin/dashboard')->with('flash_message_success','Room Reserved Successfuly Cancelled!');
    }
}
