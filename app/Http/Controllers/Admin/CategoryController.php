<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdatePostFormRequest;
  
class CategoryController extends Controller
{
    public function index(){
        try{
            $category = Category::indexmodel();
            return view('admin.collection.category.index')->with('category', $category);
        }
            catch (\Exception $exception) {
                return view('errors.error_show');
            }
    }

    public function create(){
        try{
            $group = Groups::indexmodel();
        return view('admin.collection.category.create')
        ->with('group',$group);
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    public function store(Request $request){
  
        try{
            $data=[];
            $data['group_id'] = $request->input('group_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');

        $hasfileimage = $request->hasFile('image');    
        $image=$request->file('image');      
        $data['status'] = $request->input('status');
     
        Category::storemodel($data,$hasfileimage,$image);
        return redirect()->back()->with('status','Category added Successfully.');
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    public function edit(Request $request,$id){
        try{
            $group = Groups::indexmodel();
        $category = Category::editmodel($id);
        return view('admin.collection.category.edit')
        ->with('group',$group)
        ->with('category',$category);
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    public function update(Request $request,$id){

        try{
            $data=[];
            $data['group_id'] = $request->input('group_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');

        $hasfileimage = $request->hasFile('image');    
        $image=$request->file('image');      
        $data['status'] = $request->input('status');

        Category::updatemodel($id,$data,$hasfileimage,$image);
        return redirect()->back()->with('status','Category Updated Successfully.');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

    public function delete($id){
       
        try{
            Category::deletemodel($id);
        return redirect()->back()->with('status','Category Deleted Successfully.');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }
}
