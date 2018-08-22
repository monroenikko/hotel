<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manage;
use App\Room_type;
use App\Category_extra;
use App\Hotel_extra;
use App\FrontDesk;

class ManageController extends Controller
{

    public function addRoom(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $manage = new Manage;
            if($manage->room_type=$data['room_type']=='0'){
                return redirect('/settings/room')->with('flash_message_error','Room added Failed! Please Select Room Type!');
            }else{
                $manage->room_no=$data['room_no'];
                $manage->room_type=$data['room_type'];
                $manage->room_rate=$data['room_rate'];
                $manage->status=$data['status'];
                $manage->color_stats=$data['color_stats'];
                $manage->rsvn_no = '0000000000';


                $manage->save();
                return redirect('/settings/room')->with('flash_message_success','Room added Successfuly!');
            }

        }
    }

    public function viewRoomList(){

        // displaying the roomlist to the table
        $manages = Manage::get();
        // we use this to see if the code will run well
        $manages = json_decode(json_encode($manages));
        // displaying the room type and get the id of it transfer to combobox

        $types = Room_type::where(['room_type'=>0])->get();

        $types_roomtype ="<option value='0'>Room Type</option>";

        foreach($types as $val)
        {
            $types_roomtype .="<option value=".$val->room_type.">".$val->room_type."</option>";

        }

        return view('admin.settings.room')->with(compact('manages','types_roomtype'));

    }

    public function editRoomList(Request $request, $id=null){

        if($request->isMethod('post')){

            $data = $request->all();

            if($data['room_type']=='0')
            {
                return redirect('/settings/room')->with('flash_message_error','Room edit Failed! Please Select Room Type!');
            }
            else
            {
                Manage::where(['id'=>$id])->update(['room_no'=>$data['room_no'],
                'room_type'=>$data['room_type'], 'room_rate'=>$data['room_rate'] ]);//

                return redirect('/settings/room')->with('flash_message_success','Room Type has been updated successfully!');
            }

        }

        $manages = Manage::where(['id'=>$id])->first();
        $levels = Room_type::where(['room_type'=>0])->get();

        return view('admin.settings.edit_room')->with(compact('manages','levels'));
    }

    public function roomType(){

        $types = Room_type::get();
        // we use this to see if the code will run well
        $types = json_decode(json_encode($types));
        // displaying the room type and get the id of it transfer to combobox
        // $types = Room_type::where(['room_type'=>0])->get();
        // echo "<pre>"; print_r($categories); die;
        return view('admin.settings.room_type')->with(compact('types'));
    }

    public function updateRoomType(Request $request, $id=null){

        if($request->isMethod('post')){

            $data = $request->all();

            Room_type::where(['id'=>$id])->update(['id'=>$data['id'],
            'room_type'=>$data['room_type'], 'totalAdults'=>$data['adults_capacity'], 'totalChildren'=>$data['child_capacity'] ]);

            return redirect('/settings/room_type')->with('flash_message_success','Room Type has been updated successfully!');

        }

        $types= Room_type::where(['id'=>$id])->first();
        // $types = Room_type::where(['room_type'=>0])->get();

        return view('admin.settings.edit_roomType')->with(compact('types'));

    }

    public function addRoomType(Request $request){

        if($request->isMethod('post')){

                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                $type = new Room_type;
                $type->room_type=$data['room_type'];
                $type->totalAdults='2';
                $type->totalChildren='1';
                $type->save();

                return redirect('/settings/room_type')->with('flash_message_success','Room added Successfuly!');


        }
    }

    public function roomExtra(){
        // return view('admin.settings.room_extra');
        // displaying the roomlist to the table
        $hotels = Hotel_extra::get();
        // we use this to see if the code will run well
        $hotels = json_decode(json_encode($hotels));
        // displaying the room type and get the id of it transfer to combobox
        $extras = Category_extra::where(['excat_name'=>0])->get();
        // echo "<pre>"; print_r($categories); die;
        return view('admin.settings.room_extra')->with(compact('hotels','extras'));
    }

    public function addExtra(Request $request){

        if($request->isMethod('post')){

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $hotels = new Hotel_extra;
            if($hotels->hotex_category=$data['hotex_category']=='0'){
                return redirect('/settings/room_extra')->with('flash_message_error','Extra added Failed! Please Select Category!');
            }else{
                $hotels->hotex_name=$data['hotex_name'];
                $hotels->hotex_category=$data['hotex_category'];
                $hotels->hotex_price=$data['hotex_price'];
                $hotels->save();

                return redirect('/settings/room_extra')->with('flash_message_success','Category of extra added Successfuly!');
            }
        }
    }

    public function updateExtra(Request $request, $id=null){

        if($request->isMethod('post')){

            $data = $request->all();

            if($data['hotex_category']=='0')
            {
                return redirect('/settings/room_extra')->with('flash_message_error','Extra edit Failed! Please Select Category Type!');
            }
            else
            {
                Hotel_extra::where(['hotex_id'=>$id])->update(['hotex_id'=>$data['hotex_id'],
                'hotex_name'=>$data['hotex_name'], 'hotex_category'=>$data['hotex_category'],
                'hotex_price'=>$data['hotex_price'] ]);

                return redirect('/settings/room_extra')->with('flash_message_success','Extra has been updated successfully!');
            }
        }

        $hotelx= Hotel_extra::where(['hotex_id'=>$id])->first();
        $cats = Category_extra::where(['excat_name'=>0])->get();

        return view('admin.settings.edit_extra')->with(compact('hotelx','cats'));
    }


    public function viewCatExtra(){

        $categories = Category_extra::get();
        // we use this to see if the code will run well
        $categories = json_decode(json_encode($categories));
        // displaying the room type and get the id of it transfer to combobox
        // $types = Room_type::where(['room_type'=>0])->get();
        // echo "<pre>"; print_r($categories); die;
        return view('admin.settings.room_categoryExtra')->with(compact('categories'));
    }

    public function addCatExtra(Request $request){

        if($request->isMethod('post')){

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $cats = new Category_extra;
            $cats->excat_name=$data['excat_name'];
            $cats->save();

            return redirect('/settings/room_categoryExtra')->with('flash_message_success','Category of extra added Successfuly!');
        }
    }

    public function updateCatExtra(Request $request, $id=null){

        if($request->isMethod('post')){

            $data = $request->all();

            Category_extra::where(['excat_id'=>$id])->update(['excat_id'=>$data['excat_id'],
            'excat_name'=>$data['excat_name'] ]);

            return redirect('/settings/room_categoryExtra')->with('flash_message_success','Category Extra has been updated successfully!');

        }

        $categories= Category_extra::where(['excat_id'=>$id])->first();
        // $types = Room_type::where(['room_type'=>0])->get();

        return view('admin.settings.edit_extraCategory')->with(compact('categories'));
    }

    public function userAdmin()
    {
        return view('admin.settings.user');
    }

    public function front_desk()
    {
        $front_desk = FrontDesk::get();
        // we use this to see if the code will run well
        $front_desk = json_decode(json_encode($front_desk));

        return view('admin.settings.frontdesk')->with(compact('front_desk'));
    }

    public function addfd(Request $request)
    {
        if($request->isMethod('post')){

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $front_desk = new FrontDesk;
            $front_desk->frontdesk_fname=$data['fname'];
            $front_desk->save();

            return redirect('/settings/frontdesk')->with('flash_message_success','Category of extra added Successfuly!');
        }
    }


}
