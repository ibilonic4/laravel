<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function imageUpload(){

        return view('imageUpload');

    }
    
    public function imageUploadPost(Request $request){
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpgmguf,svg|max:2048',
        ]);

        $imageName = time() . '.'. $request->image->extension();
        $request->image->move(public_path('images'),$imageName);


        return back()->with('success', 'uploadao si sliku')->with('image',$imageName);
        
    }
}
