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
        $category = Category::where('status','!=','2')->get();
        $subcategory = SubCategory::where('status','!=','2')->paginate(3);
        return view('admin.collection.subcategory.index')
        ->with('subcategory',$subcategory)
        ->with('category',$category);
    }

    public function store(Request $request){

        $subcategory=new Subcategory();
        $subcategory->category_id =  $request->input('category_id');
        $subcategory->url = $request->input ('url');
        $subcategory->name = $request->input ('name');
        $subcategory->description = $request->input('description');
        if($request->hasfile('image'))
        {
            $image_file=$request->file('image');
            $img_extension= $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename=time().'.'.$img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }        
        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status')==true ?'1':'0';
        $subcategory->save();
                                
        return redirect()->back()->with('status','Subcategory Saved Successfully');
    }

    public function edit($id){
        $category = Category::where('status','!=','2')->get();
        $subcategory = SubCategory::find($id);
        return view('admin.collection.subcategory.edit')
        ->with('subcategory',$subcategory)
        ->with('category',$category);

    }

    public function update(Request $request,$id){
        $subcategory = SubCategory::find($id);
        $subcategory->category_id =  $request->input('category_id');
        $subcategory->url = $request->input ('url');
        $subcategory->name = $request->input ('name');
        $subcategory->description = $request->input('description');

        if($request->hasfile('image'))
        {
            $destination='uploads/subcategory/'.$subcategory->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image_file=$request->file('image');
            $img_extension= $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename=time().'.'.$img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }        
        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status')==true ?'1':'0';
        $subcategory->update();
                                
        return redirect('sub-category')->with('status','Subcategory Updated Successfully');

    }

    public function delete($id){
        $subcategory = SubCategory::find($id);
        $subcategory->status='2';
        $subcategory->update();
        return redirect()->back()->with('status','Sub-Category Deleted Successfully.');
    }

}