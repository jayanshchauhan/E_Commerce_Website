<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdatePostFormRequest;
 
class SubCategoryController extends Controller
{
    public function index(){
        try{
            $category = Category::indexmodel();
        $subcategory = SubCategory::indexmodel();
        return view('admin.collection.subcategory.index')
        ->with('subcategory',$subcategory)
        ->with('category',$category);
      }
      catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

    public function edit($id){
        try{
            $category = Category::indexmodel();
        $subcategory = SubCategory::editmodel($id);
        return view('admin.collection.subcategory.edit')
        ->with('subcategory',$subcategory)
        ->with('category',$category);
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }

    }

    public function store(Request $request){

       try{
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
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

    public function update(Request $request,$id){
        
       try{
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
       catch (\Exception $exception) {
        return view('errors.error_show');
       }

    }

    public function delete($id){
        try{
            SubCategory::deletemodel($id);
        return redirect()->back()->with('status','Sub-Category Deleted Successfully.');
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

}