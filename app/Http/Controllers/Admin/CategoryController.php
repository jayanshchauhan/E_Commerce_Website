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
        $category = Category::where('status','!=','2')->paginate(3);
         return view('admin.collection.category.index')->with('category', $category);
       
    }

    public function create(){
        $group = Groups::where('status','!=','2')->get();
        return view('admin.collection.category.create')
        ->with('group',$group);
    }

    public function store(Request $request){
        $category = new Category();
        $category->group_id = $request->input('group_id');
        $category->url = $request->input('url');
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if($request->hasFile('image')){
            $destination='uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/category/',$filename);
            $category->image=$filename;
        }

        $category->status = $request->input('status')==true?'1':'0';
        $category->save();
        return redirect()->back()->with('status','Category added Successfully.');
    }

    public function edit(Request $request,$id){
            $group = Groups::where('status','!=','2')->get();
            $category = Category::find($id);
            return view('admin.collection.category.edit')
            ->with('group',$group)
            ->with('category',$category);
    }

    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->group_id = $request->input('group_id');
        $category->url = $request->input('url');
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if($request->hasFile('image')){
            $destination='uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/category/',$filename);
            $category->image=$filename;
        }

        $category->status = $request->input('status')==true?'1':'0';
        $category->save();
        return redirect()->back()->with('status','Category Updated Successfully.');
    }

    public function delete($id){
        $category = Category::find($id);
        $category->status='2';
        $category->update();
        return redirect()->back()->with('status','Category Deleted Successfully.');

    }
}
