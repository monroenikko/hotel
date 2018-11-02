<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manage;
use App\Room_type;
use App\Category_extra;
use App\Hotel_extra;
use App\Customer;
use App\Booking;
use App\Reservation;
use App\Customer_extra;
use App\FrontDesk;
use App\Reservedate;
use PDF;

class BookingController extends Controller
{
    //
    public function bookIn(Request $request, $id=null)
    {
        // return redirect('/status/room_checkin');
        $data = $request->all();
        date_default_timezone_set('Singapore');
        $manages= Manage::where(['id'=>$id])->first();

        // $types = Room_type::where(['room_type'=>0])->get();
        if($manages->status == 0 || $manages->status == 3){
            // return redirect('/admin/dashboard')->with('flash_message_error','The Room No. '.$manages->room_no.' is Already occupied!');
            $booking = Booking::where(['bookingroomID'=>$id ])->first();

            $customer = Customer::where(['customer_room_id'=>$id])->orderBY('customer_rsvnno','desc')->first();

            $hotels = Hotel_extra::get();
            // we use this to see if the code will run well
            $hotels = json_decode(json_encode($hotels));
            // displaying the room type and get the id of it transfer to combobox
            $extras = Category_extra::where(['excat_name'=>0])->get();

            $customer1 = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_rsvnno','desc')->first();

            $countCustomerExtra = Customer_extra::where(['room_id'=>$id])->count();

                $CustomerExtra = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer1->customer_id])->get();

            $sum_total = Customer_extra::where(['room_id'=>$id ])->where(['cust_id'=>$customer1->customer_id])->sum('total_cost');

            $fd = FrontDesk::where(['frontdesk_fname'=>0])->get();

            $countRsvn = Manage::where(['rsvn_no' => $manages->rsvn_no])->count();

            if($countRsvn == 1)
            {
                return view('admin.status.room_occupy')->with(compact('manages','booking','customer','hotels','CustomerExtra','sum_total','customer1'));
            }
            else if($countRsvn > 1)
            {
                $lastCustId = Customer::orderBY('Customer_id','desc')->first();

                $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

                $manages= Manage::where(['id'=>$id])->first();

                $customer = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_id','desc')->first();

                $getIdRoom = Booking::where(['booking_rsvn_no'=>$manages->rsvn_no])->where(['booking_status'=>'Checkout!'])->where(['checkouDate'=>$date = date('Y-m-d')])->get();

                $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

                $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$manages->rsvn_no])->first();

                //return view('admin.guest.occupied.hotel_guest')->with(compact ('customer'));
                return view('admin.guest.occupied.view_occupy_room1')->with(compact('lastCustId','lastBooking','customer','getIdRoom','manages','Manages','RDate'));
            }

            // echo "<pre>"; print_r($categories); die;


        }else if($manages->status==1 || $manages->status==5){

            $customer = Customer::where(['customer_room_id'=>$id])->first();

            $booking = Booking::where(['bookingroomID'=>$id ])->orderBY('booking_rsvn_no','desc')->first();

            $cust = \App\Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->first();

            return view('admin.status.room_reserved')->with(compact('manages','booking','customer','cust'));

        }else if($manages->status==4){
            //display customer info and only for reserve page not yet done


            $lastCustId = Customer::orderBY('Customer_id','desc')->first();

            $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

            $manages= Manage::where(['id'=>$id])->first();

            $customer = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_id','desc')->first();

            $getIdRoom = Booking::where(['booking_rsvn_no'=>$manages->rsvn_no])->where(['booking_status'=>'Reserved'])->get();

            $hotelRoom = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

            $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$manages->rsvn_no])->first();

            return view('admin.guest.reserved.view_reserved1')->with(compact('customer','lastBooking','lastCustId','manages','getIdRoom','hotelRoom','RDate'));

        }else if($manages->status==6){
        //display customer info and only for occupy page not yet done
           // $customer = Customer::where(['status'=>1])->orderBY('customer_id','desc')->get();

            $lastCustId = Customer::orderBY('Customer_id','desc')->first();

            $lastBooking = Booking::orderBY('booking_rsvn_no','desc')->first();

            $manages= Manage::where(['id'=>$id])->first();

            $customer = Customer::where(['customer_rsvnno'=>$manages->rsvn_no])->orderBY('customer_id','desc')->first();

            $getIdRoom = Booking::where(['booking_rsvn_no'=>$manages->rsvn_no])->where(['booking_status'=>'Occupied'])->get();

            $Manages = Manage::where(['status'=>2])->orderBY('room_no','ASC')->get();

            $RDate = Reservedate::orderBY('id','desc')->where(['rsvn_no'=>$manages->rsvn_no])->first();

            //return view('admin.guest.occupied.hotel_guest')->with(compact ('customer'));
            return view('admin.guest.occupied.view_occupy_room')->with(compact('lastCustId','lastBooking','customer','getIdRoom','manages','Manages','RDate'));

        }else{

            $customer = Customer ::orderBy('customer_id', 'desc')->first();
            $booking= Booking::orderBy('booking_rsvn_no', 'desc')->first();

            return view('admin.status.room_checkin')->with(compact('manages','customer','booking'));
        }


    }
    // reserve room for customer update the name of the routes and controller soon
    public function roomReserve(Request $request, $id=null)
    {

        $data = $request->all();

        $booking = new Booking;
        $booking->bookingroomID = $id;
        $booking->booking_rsvn_no = $data['result_rsvn_no'];

        $booking->checkinDate = $data['datefrom2'];
        $booking->checkouDate = $data['dateto2'];
        $booking->bookingroomcategory = $data['room_type'];
        $booking->bookingcustomerID = $data['result_id'];
        $booking->bookingstatusID = '1';
        $booking->bookingTotalNights = $data['result1'];
        $booking->bookingTotalCost = $data['total_costt1'];

        $booking->booking_room_no = $data['room_no'];
        $booking->booking_rate = $data['room_rate'];

            if($data['downpayment']=='')
            {
                $booking->booking_downpayment = '0';
            }
            else
            {
                $booking->booking_downpayment = $data['downpayment'];
            }

        $booking->booking_totalbalance = $data['total_balance1'];
        $booking->bookingTotalAdults = '2';
        $booking->bookingTotalChild = '1';
        $booking->booking_billArrangement = '0';
        $booking->booking_status = 'Reserved';
        $booking->save();

        $customer = new Customer;
        $customer->customer_rsvnno = $data['result_rsvn_no'];
        $customer->customer_name = $data['firstname'];
        $customer->customer_lastname = $data['lastname'];
        $customer->customer_companyaAdress = 'none';
        $customer->customer_nationality = 'none';
        $customer->customer_contactno = '0';
        $customer->customer_address = 'none';
        $customer->customer_room_id = $id;
        $customer->customer_origin = 'none';
        $customer->customer_flightno = '0';
        $customer->customer_timedeparture = '00:00:00';
        $customer->status = '2';
        $customer->save();

        Manage::where(['id'=>$id])->update(['rsvn_no'=>$data['result_rsvn_no'],'status'=>'1',
                    'color_stats'=>'bg_lg' ]);

        $tr = new Reservedate;
        $tr->rsvn_no = $data['result_rsvn_no'];
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

        return redirect()->back()->with('flash_message_success','Room Reserved Successfuly!');

    }

    public function occupiedRoom(Request $request, $id=null)
    {
        $data = $request->all();

        if($request->isMethod('post')){

            Customer::where(['customer_room_id'=>$data['bookingroomid'] ])->update(['customer_origin'=>$data['origin'],
            'customer_flightno'=>$data['flight_no'], 'customer_timedeparture'=>$data['timedeparture'], 'customer_companyaAdress'=>$data['c_address'],
            'customer_nationality'=>$data['nationality'], 'customer_contactno'=>$data['contact_no'], 'customer_address'=>$data['address'], 'status' => '1']);

            Booking::where(['bookingroomID'=>$data['bookingroomid'] ])
            ->update(['checkinDate'=>$data['datefrom'],'checkouDate'=>$data['dateto'],
            'booking_billArrangement'=>$data['billarrangement'], 'booking_status'=>'Occupied',
            'bookingTotalCost'=>$data['totalCost'], 'booking_totalbalance'=>$data['totalBalance'], 'bookingTotalNights'=>$data['totalNights'] ]);

            Manage::where(['id'=>$data['bookingroomid']])->update(['status'=>'0',
            'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room has been Occupied Successfully!');

        }
    }

    public function room_occupy(Request $request, $id=null)
    {
        date_default_timezone_set('Singapore');

        if( $date = date('Y-m-d') >= 12)
        {
            $data = $request->all();

            $booking = new Booking;
            $booking->bookingroomID = $id;
            $booking->booking_rsvn_no = $data['occupy_rsvn'];
            $booking->checkinDate = $data['occupydatefrom'];
            $booking->checkouDate = $data['occupydateto'];
            $booking->bookingroomcategory = $data['roomcat'];
            $booking->bookingcustomerID = $data['result_id1'];
            $booking->bookingstatusID = '0';
            $booking->bookingTotalNights = $data['ototalnight'];
            $booking->bookingTotalCost = $data['ototalbill1'];

            $booking->booking_downpayment = '0';

            $booking->booking_room_no = $data['room_no'];
            $booking->booking_rate = $data['room_rate'];

            $booking->booking_totalbalance = '0';
            $booking->bookingTotalAdults = '2';
            $booking->bookingTotalChild = '1';
            $booking->booking_billArrangement = $data['billarrangement1'];
            $booking->booking_status = 'Occupied';
            $booking->save();

            $customer = new Customer;
            $customer->customer_rsvnno = $data['occupy_rsvn'];
            $customer->customer_name = $data['occupyfirstname'];
            $customer->customer_lastname = $data['occupylastname'];
            $customer->customer_companyaAdress = $data['c_address1'];
            $customer->customer_nationality = $data['nationality1'];
            $customer->customer_contactno = $data['contact_no1'];
            $customer->customer_address = $data['address1'];
            $customer->customer_room_id = $id;
            $customer->customer_origin = $data['origin1'];
            $customer->customer_flightno = $data['flight_no1'];
            $customer->customer_timedeparture = $data['timedeparture1'];
            $customer->status = '1';
            $customer->save();

            $tr = new Reservedate;
            $tr->rsvn_no = $data['occupy_rsvn'];
            $tr->totalnight = $data['ototalnight'];

               $tr->downpayment= '0';

            $tr->arrivaldate = $data['occupydatefrom'];
            $tr->departuredate = $data['occupydateto'];
            $tr->save();

            Manage::where(['id'=>$id])->update(['rsvn_no'=>$data['occupy_rsvn'],'status'=>'0',
                        'color_stats'=>'bg_lr' ]);

            return redirect('/admin/dashboard')->with('flash_message_success','Room Occupied Successfuly!');
        }
        else
        {
            return redirect('/admin/dashboard')->with('flash_message_error','Room Occupied unsuccessfuly!');
        }


    }

    public function reserveCancel(Request $request, $id=null){

        if($request->isMethod('post'))
        {
            $data = $request->all();
            Booking::where(['bookingroomID'=>$id ])
            ->update(['booking_status'=>'Cancel' ]);

            Manage::where(['id'=>$id])->update(['rsvn_no'=>'0000000000','status'=>'2',
                        'color_stats'=>'bg_ls' ]);


            $manages= Manage::where(['id'=>$id])->first();

            Customer::where(['customer_room_id'=>$id ])->update(['status' => '0']);

            return redirect('/admin/dashboard')->with('flash_message_success','Room no.'.$manages->room_no.' Reservation canceled Successfuly!');
        }

    }

    public function invoice(Request $request, $id=null){

            $booking = Booking::where(['bookingroomID'=>$id ])->first();
            $data = $request->all();
            $manages= Manage::where(['id'=>$id])->first();

            $customer = Customer::where(['customer_room_id'=>$id])->first();

            $hotels = Hotel_extra::get();
            // we use this to see if the code will run well
            $hotels = json_decode(json_encode($hotels));
            // displaying the room type and get the id of it transfer to combobox
            $extras = Category_extra::where(['excat_name'=>0])->get();
            // echo "<pre>"; print_r($categories); die;


            return view('admin.status.invoice')->with(compact('manages','booking','customer','hotels'));
    }

    public function roomReserveExisting(Request $request, $id=null)
    {

        $data = $request->all();

        $booking = new Booking;
        $booking->bookingroomID = $id;
        $booking->booking_rsvn_no = $data['rsvn_no'];
        $booking->checkinDate = $data['df'];
        $booking->checkouDate = $data['dt'];
        $booking->bookingroomcategory = $data['room_type'];
        $booking->bookingcustomerID = $data['result_id'];
        $booking->bookingstatusID = '1';
        $booking->bookingTotalNights = $data['result1'];
        $booking->bookingTotalCost = $data['total_costt1'];

        $booking->booking_rate = '0';
        $booking->bookingroomcategory = 'blank';
        $booking->booking_room_no = $data['room_no'];

        if($data['tdownpayment']=='')
        {
            $booking->booking_downpayment = '0';
        }
        else
        {
            $booking->booking_downpayment = $data['tdownpayment'];
        }

        $booking->booking_totalbalance = $data['total_balance1'];
        $booking->bookingTotalAdults = '2';
        $booking->bookingTotalChild = '1';
        $booking->booking_billArrangement = '0';
        $booking->booking_status = 'Reserved';
        $booking->save();

        $customer = new Customer;
        $customer->customer_rsvnno = '0000000000';
        $customer->customer_name = $data['firstname'];
        $customer->customer_lastname = $data['lastname'];
        $customer->customer_companyaAdress = 'none';
        $customer->customer_nationality = 'none';
        $customer->customer_contactno = '0';
        $customer->customer_address = 'none';
        $customer->customer_room_id = $id;
        $customer->customer_origin = 'none';
        $customer->customer_flightno = '0';
        $customer->customer_timedeparture = '00:00:00';
        $customer->save();

        Manage::where(['id'=>$id])->update(['rsvn_no'=>$data['rsvn_no'],'status'=>'1',
                    'color_stats'=>'bg_lg' ]);

        return redirect('/admin/dashboard')->with('flash_message_success','Room Reserved Successfuly!');

    }

    public function printReserve(Request $request, $id=null)
    {
        $customer = Customer::where(['customer_rsvnno'=>$id])->orderBY('customer_id','desc')->first();

        $getIdRoom = Booking::where(['booking_rsvn_no'=>$id])->first();

        $booking = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->get();

        $totalsum = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->sum('booking_rate');

        $downpayment = Booking::where(['booking_rsvn_no'=>$id])->orderBY('booking_room_no','asc')->sum('booking_downpayment');

        $totalpayment = $totalsum - $downpayment;

        $pdf = PDF::loadView('admin.status.reservationPrint.print', compact('customer','getIdRoom','booking','CustomerExtra',
                            'totalsum','totalpayment'));
        return $pdf->stream('invoice.pdf');

    }




}
