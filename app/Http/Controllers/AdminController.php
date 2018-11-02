<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Manage;
use App\Room_type;
use App\Booking;
use App\Notifications\checkoutCustomer;


class AdminController extends Controller
{

    public function login(Request $request){

        if($request->isMethod('post')){

            $data = $request->input();

            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'admin'=>'1']))
            {
                 //echo "Success"; die;
                // Session::put('adminSession', $data['email']);
                // $checkdate = \App\Booking::where(['checkouDate' => $date = date('Y-m-d')])->get();
                // $date = date('Y-m-d');


                return redirect('/admin/dashboard');
            }
            else
            {
                // echo "Failed"; die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function loginpage()
    {
        return view('admin.admin_login');
    }

    public function dashboard(){
        date_default_timezone_set('Singapore');
        //$manages = Manage::where('room_no')->orderByRaw('ASC')->get();

        $manages = Manage::orderBy('room_no', 'ASC')->get();
        $manages = json_decode(json_encode($manages));

        $types = Room_type::where(['room_type'=>0])->get();
        $count = Manage::count();
        $count1 = Manage::where(['status' => 0])->count();
        $count2 = Manage::where(['status' => 2])->count();
        $count3 = Manage::where(['status' => 1])->count();
        $count4 = Manage::where(['status' => 3])->count();
        $count5 = Manage::where(['status' => 4])->count();

        $finalcount = $count3 + $count5;
        $countOccupy = $count1 + (Manage::where(['status' => 6])->count());

        $date = date('Y-m-d');
        $countout = Booking::where(['checkouDate' => $date])
            ->where(['booking_status' => 'Occupied'])
            ->count();

        $countout2 = \App\Booking::where('booking_status','Occupied')->where('checkouDate', '>', $date)->count();


        //query for check out
        if($countout > 0)
        {
            $checkdate = Booking::whereDate('checkouDate',  $date = date("Y-m-d"))
                ->where('booking_status', 'Occupied')
                ->get();

            //$list_console = array();
            foreach($checkdate as $book)
            {
                Manage::where(['id'=>$book->bookingroomID])->update(['status'=>'3', 'color_stats'=>'bg_ly' ]);
                Booking::where(['booking_rsvn_no'=>$book->booking_rsvn_no])->update(['booking_status'=>'Checkout!']);
            }

        }

        $count6 = Booking::where(['booking_status' => 'Reserved'])->count();

        $checkReserve = Booking::where(['checkouDate' => $date, 'booking_status' => 'Reserved'])->count();

        if($checkReserve > 0)
        {
            $checkReserveExpire = Booking::whereDate('checkouDate',  $date = date("Y-m-d"))
            ->where('booking_status', 'Reserved')
            ->get();

            //$list_console = array();
            foreach($checkReserveExpire as $book)
            {
                Manage::where(['id'=>$book->bookingroomID])->update(['status'=>'5', 'color_stats'=>'bg_lo' ]);
                Booking::where(['booking_rsvn_no'=>$book->booking_rsvn_no])->update(['booking_status'=>'Expired!']);
            }
        }

        // $checkdate = Booking::whereDate('checkouDate', $date = date("Y-m-d"))->first();
        // $manage = Manage::where(['id'=>$checkdate->bookingroomID])->update(['status'=>'3', 'color_stats'=>'bg_ly' ]);
        return view('admin.dashboard')
        ->with(compact('manages','types','count','count1','count2','count3'
                        ,'count4','count6','types_roomtype','countout','countout2'
                        ,'checkdate','manage','checkReserveExpire','checkReserve','finalcount','countOccupy'));

    }

    public function cpassword(){
        return view('admin.settings.changePassword');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfuly');
     }

     public function chkPassword(Request $request){
        //it will check the current password if is correct
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password, $check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

     public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die; you can use this if the codes are running
            $check_password = User::where(['email'=> Auth::user()->email])->first();
            $current_password = $data['current_pwd'];

            if(Hash::check($current_password, $check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id', '1')->update(['password'=>$password]);
                return redirect('/admin/dashboard')->with('flash_message_success', 'Password updated Successfuly!');
            }else{
                return redirect('/admin/dashboard')->with('flash_message_error', 'Incorrect Current Password!');
            }
        }
    }

    public function user_reg(Request $request)
    {
        if($request->isMethod('post')){

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $user = new User;
            $user->name=$data['fname'];
            $user->email=$data['email'];
            $password1 = bcrypt($data['password']);
            $user->password=$password1;
            $user->admin='1';
            $user->save();

            return redirect('/admin/dashboard')->with('flash_message_success','User added Successfuly!');
        }
    }

}
