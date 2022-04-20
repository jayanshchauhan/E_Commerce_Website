<?php
 
namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Http\Requests\UpdatePostFormRequest;

class GroupController extends Controller
{
    public function index(){
       try{
            $group = Groups::indexmodel();
         return view('admin.collection.groups.index')->with('group', $group);
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
        }
       
    }
 
    public function viewpage(){
        try{
            return view('admin.collection.groups.create');
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    public function store(Request $request){
        
        try{
            $data=[];
            $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['descrip']=$request->input('descrip');
        if($request->input('status') == true){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        Groups::storemodel($data);
        return redirect()->back()->with('status', 'Group Data Added Successfully');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
    }
                
    }
    public function edit($id){

        try{
            $group= Groups::editmodel($id);
        return view('admin.collection.groups.edit')
        ->with('group',$group);
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

    public function update(Request $request,$id){

        try{
            $data=[];
            $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['descrip']=$request->input('descrip');
        $data['status']=$request->input('status')==true?'1':'0';
        Groups::updatemodel($id,$data);

        return redirect()->back()->with('status', 'Group Data Updated Successfully');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
      }
    }

    public function delete($id){

       try{
            Groups::deletemodel($id);
        return redirect()->back()->with('status', 'Group Data Deleted Successfully');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }

    }
}
