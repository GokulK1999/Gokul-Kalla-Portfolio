<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ImageUploadController extends Controller
{
    public function index()
    {
        return view('image-form');
    }

    public function upload(Request $request)
    {
        
        //validate image before upload
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $request->file('image')->getClientOriginalName();

        //upload image in public storage folder
        $path = $request->file('image')->store('models/imagestore');

        return redirect('image-form')->with('status', 'Image Has been uploaded');

    }
}