<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
 
class SubCategoryController extends Controller
{
    public function index(){
        $category = Category::indexmodel();
        $subcategory = SubCategory::indexmodel();
        return view('admin.collection.subcategory.index')
        ->with('subcategory',$subcategory)
        ->with('category',$category);
    }

    public function edit($id){
        $category = Category::indexmodel();
        $subcategory = SubCategory::editmodel($id);
        return view('admin.collection.subcategory.edit')
        ->with('subcategory',$subcategory)
        ->with('category',$category);

    }

    public function store(Request $request){

        $category_id =  $request->input('category_id');
        $url = $request->input ('url');
        $name = $request->input ('name');
        $description = $request->input('description');
        $hasfileimage = $request->hasfile('image');

        $image = $request->file('image');
               
        $priority = $request->input('priority');
        $status = $request->input('status');
        
        Subcategory::storemodel($category_id,$url,$name,$description,$hasfileimage,$image,$priority,$status);                       
        return redirect()->back()->with('status','Subcategory Saved Successfully');
    }

    public function update(Request $request,$id){
        
        $category_id =  $request->input('category_id');
        $url = $request->input ('url');
        $name = $request->input ('name');
        $description = $request->input('description');
        $hasfileimage = $request->hasfile('image');

        $image = $request->file('image');
               
        $priority = $request->input('priority');
        $status = $request->input('status');
        
        Subcategory::updatemodel($id,$category_id,$url,$name,$description,$hasfileimage,$image,$priority,$status);
                                
        return redirect('sub-category')->with('status','Subcategory Updated Successfully');

    }

    public function delete($id){
        SubCategory::deletemodel($id);
        return redirect()->back()->with('status','Sub-Category Deleted Successfully.');
    }

}