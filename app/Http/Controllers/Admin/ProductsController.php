<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Product;
 
class ProductsController extends Controller
{
    public function index(){
        $products = Product::indexmodel();
    //    $products = Product::get();
        return view('admin.collection.product.index')
        ->with('products',$products);
    }

    public function create(){
        $subcategory = Subcategory::indexmodel();
        return view('admin.collection.product.create')
        ->with('subcategory',$subcategory);
    }

    public function edit(Request $request,$id){
        $subcategory = SubCategory::indexmodel();
        $product = Product::editmodel($id);
        return view('admin.collection.product.edit')
        ->with('subcategory',$subcategory)
        ->with('product',$product);
    }

    public function store(Request $request){
       
        $name= $request->input('name');
        $sub_category_id = $request->input ('sub_category_id');
        $url = $request->input('url');
        $small_description = $request->input('small_description');
                        
        $hasfileprod_image = $request->hasfile('prod_image');
        $prod_image=$request->file('prod_image'); 
                                                          
        $original_price = $request->input('original_price');
        $offer_price = $request->input('offer_price');
        $quantity = $request->input('quantity');
        $priority = $request->input('priority');
        $p_highlight_heading = $request->input('p_highlight_heading');
        $p_highlights = $request->input('p_highlights');
        $p_description_heading = $request->input('p_description_heading');
        $P_description = $request->input('p_description');
        $p_det_heading = $request->input('p_details_heading');
        $p_details = $request->input('p_details');
                                    
        $new_arrival_products = $request->input('new_arrival');
        $featured_products = $request->input('featured_products');
        $popular_products = $request->input('popular_products');
        $offers_products = $request->input('offers_products');
        $status = $request->input('status');
        
        Product::storemodel($name,$sub_category_id,$url,$small_description,$hasfileprod_image,$prod_image,
        $original_price,$offer_price,$quantity,$priority,$p_highlight_heading,$p_highlights,$p_description_heading,
        $p_description,$p_details_heading,$p_details,$new_arrival,$featured_products,$popular_products,$offers_products,$status);
        return redirect()->back()->with('status','Product added Successfully');
    }

    public function update(Request $request,$id){
 
        $name= $request->input('name');
        $sub_category_id = $request->input ('sub_category_id');
        $url = $request->input('url');
        $small_description = $request->input('small_description');
                        
        $hasfileprod_image = $request->hasfile('prod_image');
        $prod_image=$request->file('prod_image'); 
                                                          
        $original_price = $request->input('original_price');
        $offer_price = $request->input('offer_price');
        $quantity = $request->input('quantity');
        $priority = $request->input('priority');
        $p_highlight_heading = $request->input('p_highlight_heading');
        $p_highlights = $request->input('p_highlights');
        $p_description_heading = $request->input('p_description_heading');
        $P_description = $request->input('p_description');
        $p_det_heading = $request->input('p_details_heading');
        $p_details = $request->input('p_details');
                                    
        $new_arrival_products = $request->input('new_arrival');
        $featured_products = $request->input('featured_products');
        $popular_products = $request->input('popular_products');
        $offers_products = $request->input('offers_products');
        $status = $request->input('status');
        
        Product::updatemodel($id,$name,$sub_category_id,$url,$small_description,$hasfileprod_image,$prod_image,
        $original_price,$offer_price,$quantity,$priority,$p_highlight_heading,$p_highlights,$p_description_heading,
        $p_description,$p_details_heading,$p_details,$new_arrival,$featured_products,$popular_products,$offers_products,$status);
        return redirect()->back()->with('status','Product Updated Successfully');

    }

    public function delete($id){
        return Product::deletemodel($id);
        return redirect()->back()->with('status','Product Deleted Successfully.');

    }
}
