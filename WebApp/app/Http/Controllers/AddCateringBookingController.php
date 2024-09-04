<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingDetails;
use App\Models\ItemDetails;

class AddCateringBookingController extends Controller
{
    public function addbookingform()
    {

        $item= ItemDetails::All();
     
        $data = [
            "itemlist" => $item,
        ];
     
        return view('add-booking', $data);
    }

    public function addBooking(Request $request)
    {




        // Validate the form data
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

        $bookingData = [
            "BookingTheme" => $request->bookingtheme,
            "BookingType" => $request->bookingtype,
            "BookingDate" => $request->bookingdate,
            "CustomerName" => $request->customername,
            "CustomerEmail" => $request->customeremail,
            "PhoneNumber" => $request->phonenumber,
            "FoodOrderList" =>  $itemname,
            "Status" => $request->status,
            "Remarks" => $request->remarks,

        ];

        BookingDetails::create($bookingData);

       return redirect('/customer-booking')->with('status', "Item added successfully!");
    }
}