<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function myprofile(){
        return view('frontend.user.profile');
    }

    public function profileupdate(Request $request){
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->name = $request->input('name');
        $user->lname = $request->input('lname');

        if($request->hasFile('image')){
            $destination='uploads/profile/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/profile/',$filename);
            $user->image=$filename;
        }

        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        $user->phoneno = $request->input('phoneno');

        $user->update();
        return redirect()->back()->with('status','Profile Updated');
    }

}
