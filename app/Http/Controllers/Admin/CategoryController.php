<?php

namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use Illuminate\Support\Facades\File;
 
class CategoryController extends Controller
{
    public function index(){
        $category = Category::indexmodel();
         return view('admin.collection.category.index')->with('category', $category);
       
    }

    public function create(){
        $group = Groups::indexmodel();
        return view('admin.collection.category.create')
        ->with('group',$group);
    }

    public function store(Request $request){
  
        $group_id = $request->input('group_id');
        $url = $request->input('url');
        $name = $request->input('name');
        $description = $request->input('description');

        $hasfileimage = $request->hasFile('image');    
        $image=$request->file('image');      
        $status = $request->input('status');
     
        Category::storemodel($group_id,$url,$name,$description,$hasfileimage,$image,$status);
        return redirect()->back()->with('status','Category added Successfully.');
    }

    public function edit(Request $request,$id){
        $group = Groups::indexmodel();
        $category = Category::editmodel($id);
        return view('admin.collection.category.edit')
        ->with('group',$group)
        ->with('category',$category);
    }

    public function update(Request $request,$id){

        $group_id = $request->input('group_id');
        $url = $request->input('url');
        $name = $request->input('name');
        $description = $request->input('description');

        $hasfileimage = $request->hasFile('image');    
        $image=$request->file('image');      
        $status = $request->input('status');

        Category::updatemodel($id,$group_id,$url,$name,$description,$hasfileimage,$image,$status);
        return redirect()->back()->with('status','Category Updated Successfully.');
    }

    public function delete($id){
       
        Category::deletemodel($id);
        return redirect()->back()->with('status','Category Deleted Successfully.');
    }
}
