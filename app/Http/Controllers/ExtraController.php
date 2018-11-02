<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer_extra;
use App\Booking;
use App\Room_type;
use App\Customer;


class ExtraController extends Controller
{
    public function addCustomerExtra(Request $request, $id=null)
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

    public function deleteExtra($id=null)
    {
        Customer_extra::where(['extra_id'=>$id])->delete();
        return redirect()->back();
    }


    public function addExtra(Request $request, $id=null)
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
            $Customer_extra->cust_id = $data['custid'];
            $Customer_extra->extra_name = $data['ename'];
            $Customer_extra->extra_category = $data['ecategory'];
            $Customer_extra->extra_price = $data['eprice'];
            $Customer_extra->extra_qty = $data['extraqty'];
            $total_price = $data['eprice'] * $data['extraqty'];
            $Customer_extra->total_cost = $total_price;

            $Customer_extra->save();

            return redirect()->back();return redirect()->back();
        }


    }

    public function voidExtra($id=null)
    {
        Customer_extra::where(['extra_id'=>$id])->delete();
        return redirect()->back();
    }



}
