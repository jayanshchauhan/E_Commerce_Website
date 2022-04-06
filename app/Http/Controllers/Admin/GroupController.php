<?php
 
namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;

class GroupController extends Controller
{
    public function index(){
        $group = Groups::indexmodel();
         return view('admin.collection.groups.index')->with('group', $group);
       
    }
 
    public function viewpage(){
        return view('admin.collection.groups.create');
    }

    public function store(Request $request){
        //Validation
        $name = $request->input('name');
        $url = $request->input('url');
        $descrip=$request->input('descrip');
        if($request->input('status') == true){
            $status = true;
        }else{
            $status = false;
        }
        Groups::storemodel($name,$url,$descrip,$status);
        return redirect()->back()->with('status', 'Group Data Added Successfully');
                
    }
    public function edit($id){

        $group= Groups::editmodel($id);
        return view('admin.collection.groups.edit')
        ->with('group',$group);
    }

    public function update(Request $request,$id){

        $name = $request->input('name');
        $url = $request->input('url');
        $descrip=$request->input('descrip');
        $status=$request->input('status')==true?'1':'0';
        Groups::updatemodel($id,$name,$url,$descip,$status);

        return redirect()->back()->with('status', 'Group Data Updated Successfully');
    }

    public function delete($id){

        Groups::deletemodel($id);
        return redirect()->back()->with('status', 'Group Data Deleted Successfully');

    }
}
