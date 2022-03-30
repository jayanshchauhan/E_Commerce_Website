<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;

class GroupController extends Controller
{
    public function index(){
        $group = Groups::where('status','!=','2')->get();
         return view('admin.collection.groups.index')->with('group', $group);
       
    }

    public function viewpage(){
        return view('admin.collection.groups.create');
    }

    public function store(Request $request){
        $group=new Groups(); 
        $group->name = $request->input('name');
        $group->url = $request->input('url');
        $group->descrip=$request->input('descrip');
        if($request->input('status') == true){
        $group->status = "1";
        }else{
        $group->status = "0";
        }
        $group->save();
        return redirect()->back()->with('status', 'Group Data Added Successfully');
                
    }

    public function edit($id){

        $group= Groups::find($id);
        return view('admin.collection.groups.edit')
        ->with('group',$group);
    }

    public function update(Request $request,$id){

        $group= Groups::find($id);
        $group->name = $request->input('name');
        $group->url = $request->input('url');
        $group->descrip=$request->input('descrip');
        $group->status=$request->input('status')==true?'1':'0';
        $group->update();

        return redirect()->back()->with('status', 'Group Data Updated Successfully');
    }

    public function delete($id){

        $group= Groups::find($id);
        $group->status="2";
        $group->update();
        return redirect()->back()->with('status', 'Group Data Deleted Successfully');

    }
}
