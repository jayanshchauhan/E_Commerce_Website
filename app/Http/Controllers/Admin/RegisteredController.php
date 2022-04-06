<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisteredController extends Controller
{
    public function index(){
    
        $users = User::indexmodel();
        return view('admin.users.index')->with('users',$users);
    }

    public function edit($id){
        $user_roles= User::editmodel($id);
        return view('admin.users.edit')->with('user_roles',$user_roles);
    }

    public function updaterole(Request $request,$id){
    
        $name=$request->input('name');
        $roles=$request->input('roles');
        $isban=$request->input('isban');
        User::updatemodel($request,$id,$name,$roles,$isban);
        return redirect()->back()->with('status','Action is updated');
    }

    public function delete($id){

        User::deletemodel($id);
        return redirect()->back()->with('status','Category Deleted Successfully.');
    }
}
