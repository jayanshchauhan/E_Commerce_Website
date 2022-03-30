<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisteredController extends Controller
{
    public function index(){
    //      $users = User::paginate(3);
        $users = User::where('status','!=','1')->paginate(3);
        return view('admin.users.index')->with('users',$users);
     
       
    }

    public function edit($id){
        
        $user_roles=User::find($id);
        return view('admin.users.edit')->with('user_roles',$user_roles);
    }

    public function updaterole(Request $request,$id){
        
        $user=User::find($id);
        $user->name = $request->input('name');
        $user->role_as = $request->input('roles');
        $user->isban = $request->input('isban');
        $user->update();

        return redirect()->back()->with('status','Action is updated');

    }

    public function delete($id){
        $user = User::find($id);
        $user->status='1';
        $user->update();
        return redirect()->back()->with('status','Category Deleted Successfully.');
    }
}
