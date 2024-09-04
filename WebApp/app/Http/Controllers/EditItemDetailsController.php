<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemDetails;

class EditItemDetailsController extends Controller
{
    public function editItemDetails()
    {

        
     $id=$_GET['id'];

     $itemData = ItemDetails::where('ID',$id)->get();
      
     $data=["itemData"=>$itemData];
  
        return view('edit-item-details',$data);
    }

    

    public function updateItemDetails(Request $request,$id){

        $itemData = ItemDetails::where('ID',$id)->first();
        $itemData->ItemName =$request->input('food_name');
        $itemData->Category =$request->input('category');
        $itemData->Price =$request->input('price');
        $itemData->Code =$request->input('code');
        $itemData->save();

        //ItemDetails::find ($id)->update(["ItemName"=>$request->input('food_name')]);

        return redirect ('/managementmenu')->with('status',"Product Details update succesfully");

    }

    public function deleteItemDetails($id){
        $itemData = ItemDetails::find ($id);
        $itemData->delete();
        return redirect ('/managementmenu')->with('status',"Product has been delete succesfully");

    }
}