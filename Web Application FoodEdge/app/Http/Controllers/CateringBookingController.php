<?php

namespace App\Http\Controllers;

use App\Models\BookingDetails;
use Illuminate\Http\Request;
use App\Models\ItemDetails;
class CateringBookingController extends Controller
{
    
    public function index()
    {
        session_start();
        $bookingData = BookingDetails::get();
        $data = [
            "bookingData" => $bookingData,
        ];
        return view('booking.index', $data);

       
    }
    public function customerindex()
    {
        session_start();
        $bookingData = BookingDetails::get();
        $data = [
            "bookingData" => $bookingData,
        ];
        return view('booking.customerindex', $data);

       
    }

    public function editBooking()
    {
        $id = $_GET['id'];
        $item= ItemDetails::All();
        $bookingData = BookingDetails::where('id', $id)->get();

        $data = ["bookingData" => $bookingData,
        "itemlist" => $item,];

        return view('edit-booking-details', $data);
    }

    public function updateBooking(Request $request,$id)
    { 

        $validatedData = $request->validate([
            'bookingtheme' => 'required|string|max:255',
            'bookingtype' => 'required|string|max:50',
            'bookingdate' => 'required|date',
            'customername' => 'required|string|max:50',
            'customeremail' => 'required|string|max:50',
            'phonenumber' => 'required|string|max:50',
            'foodorderlist' => 'required|array|min:1',
            'status' => 'required|string|in:Approved,Pending,Clear',
            'remarks' =>  'required|string|max:50',
        ]);

        $itemname="";
        $itemlist= ItemDetails::whereIn('ID',$request->foodorderlist)->get();
        foreach($itemlist as $item){
            $itemname.= $item->ItemName."\n";
           }
           $itemname=rtrim($itemname, "\n");

        $bookingData = BookingDetails::where('id',$id)->first();
        $bookingData->BookingTheme =$request->input('bookingtheme');
        $bookingData->BookingType =$request->input('bookingtype');
        $bookingData->BookingDate =$request->input('bookingdate');
        $bookingData->CustomerName =$request->input('customername');
        $bookingData->CustomerEmail =$request->input('customeremail');
        $bookingData->PhoneNumber =$request->input('phonenumber');
        $bookingData->FoodOrderList = $itemname;
        $bookingData->Status =$request->input('status');
        $bookingData->Remarks =$request->input('remarks');
        $bookingData->save();

        //ItemDetails::find ($id)->update(["ItemName"=>$request->input('food_name')]);

        return redirect ('/catering-booking')->with('status',"Product Details update succesfully");

    
    }

     public function deleteBooking($id)
    {
        $bookingData = BookingDetails::find ($id);
        $bookingData->delete();
        return redirect ('/catering-booking')->with('status',"Product has been delete succesfully");
    }
    public function cancelBooking($id)
    {
        $bookingData = BookingDetails::find ($id);
        $bookingData->delete();
        return redirect ('/customer-booking')->with('status',"Product has been delete succesfully");
    }
}