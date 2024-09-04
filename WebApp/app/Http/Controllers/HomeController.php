<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ItemDetails;
use App\Public\Images;


class HomeController extends Controller
{
    public function index()
    {

        $itemData = ItemDetails::limit(9)->get();
        $path = storage_path('public\images');

        $data = [
            "itemData" => $itemData,
            "Path" => $path,
            "route"=>"Home",
        ];
        return view('home.userpage', $data);
    }
    public function customerindex()
    {

        $itemData = ItemDetails::limit(9)->get();
        $path = storage_path('public\images');

        $data = [
            "itemData" => $itemData,
            "Path" => $path,
            "route"=>"Home",
        ];
        return view('home.customerpage', $data);
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            return view('home.userpage');
        }
    }
    public function viewmenupage()
    {

        $itemData = ItemDetails::get();
       

        $data = [
            "itemData" => $itemData,
            "route"=>"Menu",
        ];
        return view('home.userpage', $data);
    }
    public function customerviewallproduct()
    {

        $itemData = ItemDetails::get();
       

        $data = [
            "itemData" => $itemData,
            "route"=>"Menu",
        ];
        return view('home.customerpage', $data);
    }

    
}