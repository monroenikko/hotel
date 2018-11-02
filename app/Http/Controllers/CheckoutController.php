<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manage;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        // $customer = Customer::get();

        // $customer = json_decode(json_encode($customer));

        //$manages = Manage::where(['customer_id'=>$data['custname']])->get();
        //$manages = Manage::join('')

        //return view('admin.status.room_reserved_existing_2')->with(compact('customer','manages','booking'));
        return view('admin.checkouts.index');
    }


}
