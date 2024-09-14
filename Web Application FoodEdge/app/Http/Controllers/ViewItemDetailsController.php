<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemDetails;

class ViewItemDetailsController extends Controller
{
    public function viewItemDetails()
    {

      $id=$_GET['id'];

        $itemData = ItemDetails::where('ID',$id)->get();
      
     $data=["itemData"=>$itemData];
  
        return view('item-details',$data);
    }
}