<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        // $customer = Customer::get();

        // $customer = json_decode(json_encode($customer));

        return view('admin.checkouts.index');
    }
}
