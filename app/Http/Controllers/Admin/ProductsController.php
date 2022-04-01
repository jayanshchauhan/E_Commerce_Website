<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::where('status','!=','2')->paginate(3);
    //    $products = Product::get();
        return view('admin.collection.product.index')
        ->with('products',$products);
    }

    public function create(){
        $subcategory = Subcategory::Where('status','!=','2')->get();
        return view('admin.collection.product.create')
        ->with('subcategory',$subcategory);
    }

    public function store(Request $request){
        $products = new Product();
        $products->name= $request->input('name');
        $products->sub_category_id = $request->input ('sub_category_id');
        $products->url = $request->input('url');
        $products->small_description = $request->input('small_description');
                        
        if($request->hasfile('prod_image'))
        {
            $image_file=$request->file('prod_image'); 
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time(). '.'.$img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }              
                                            
        $products->original_price = $request->input('original_price');
        $products->offer_price = $request->input('offer_price');
        $products->quantity = $request->input('quantity');
        $products->priority = $request->input('priority');
        $products->p_highlight_heading = $request->input('p_highlight_heading');
        $products->p_highlights = $request->input('p_highlights');
        $products->p_description_heading = $request->input('p_description_heading');
        $products->P_description = $request->input('p_description');
        $products->p_det_heading = $request->input('p_details_heading');
        $products->p_details = $request->input('p_details');
                                    
        $products->new_arrival_products = $request->input('new_arrival') == true ? '1':'0';
        $products->featured_products = $request->input('featured_products') == true ? '1':'0';
        $products->popular_products = $request->input('popular_products') == true ? '1':'0';
        $products->offers_products = $request->input('offers_products') == true ? '1':'0';
        $products->status = $request->input('status') == true ? '1':'0';
        
        $products->save();
        return redirect()->back()->with('status','Product added Successfully');
    }

    public function edit(Request $request,$id){
        $subcategory = SubCategory::where('status','!=','2')->get();
        $product = Product::find($id);
        return view('admin.collection.product.edit')
        ->with('subcategory',$subcategory)
        ->with('product',$product);
    }

    public function update(Request $request,$id){
        $products = Product::find($id);
        $products->name= $request->input('name');
        $products->sub_category_id = $request->input ('sub_category_id');
        $products->url = $request->input('url');
        $products->small_description = $request->input('small_description');
                        
        if($request->hasfile('prod_image'))
        {
            $image_file=$request->file('prod_image'); 
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time(). '.'.$img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }              
                                            
        $products->original_price = $request->input('original_price');
        $products->offer_price = $request->input('offer_price');
        $products->quantity = $request->input('quantity');
        $products->priority = $request->input('priority');
        $products->p_highlight_heading = $request->input('p_highlight_heading');
        $products->p_highlights = $request->input('p_highlights');
        $products->p_description_heading = $request->input('p_description_heading');
        $products->P_description = $request->input('p_description');
        $products->p_det_heading = $request->input('p_details_heading');
        $products->p_details = $request->input('p_details');
                                    
        $products->new_arrival_products = $request->input('new_arrival') == true ? '1':'0';
        $products->featured_products = $request->input('featured_products') == true ? '1':'0';
        $products->popular_products = $request->input('popular_products') == true ? '1':'0';
        $products->offers_products = $request->input('offers_products') == true ? '1':'0';
        $products->status = $request->input('status') == true ? '1':'0';
        
        $products->update();
        return redirect()->back()->with('status','Product Updated Successfully');

    }

    public function delete($id){
        $product = Product::find($id);
        $product->status='2';
        $product->update();
        return redirect()->back()->with('status','Product Deleted Successfully.');

    }
}
