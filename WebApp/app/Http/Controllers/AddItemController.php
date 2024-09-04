<?php

// app/Http/Controllers/AddItemController.php

namespace App\Http\Controllers;

use App\Models\ItemDetails;
use Illuminate\Http\Request;


class AddItemController extends Controller
{
    public function additemform()
    {
        return view('add-item');
    }

    public function addItem(Request $request)
    {

        // Validate the form data
        $validatedData = $request->validate([
            'food_name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'category' => 'required|string|in:Main Course,Appetizer,Dessert,Beverage', // Add more categories if needed
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        //upload image in public storage folder
        $path = $request->file('image')->store('public\images');
        $pathname = pathinfo($path)['basename'];


        $itemData = [
            "ItemName" => $request->food_name,
            "Category" => $request->category,
            "Price" => $request->price,
            "Code" => $request->code,
            "Photo" => $pathname,
        ];

        ItemDetails::insert($itemData);

        return redirect('/managementmenu')->with('status', "Item added successfully!");
    }
}
