<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
    'sub_category_id',
    'products',
    'name',
    'url',
    'small_description',
    'image',
    'p_highlight_heading',
    'p_highlights',
    'P_description_heading',
    'p_description',
    'p_det_heading',
    'P_details',
    'sale_tag',
    'original_price',
    'offer_price',
    'quantity',
    'priority',
    'new_arrival_products',
    'featured_products',
    'popular_products',
    'offers_products',
    'status'
    ];
 
    public function subcategory(){

        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public static function indexmodel(){
        return Product::where('status','!=','2')->paginate(3);
    }

    public static function editmodel($id){
        return Product::find($id);
    }

    public static function storemodel($name,$sub_category_id,$url,$small_description,$hasfileprod_image,$prod_image,
    $original_price,$offer_price,$quantity,$priority,$p_highlight_heading,$p_highlights,$p_description_heading,
    $p_description,$p_details_heading,$p_details,$new_arrival,$featured_products,$popular_products,$offers_products,$status){
       
        $products = new Product();
        $products->name= $name;
        $products->sub_category_id = $sub_category_id;
        $products->url = $url;
        $products->small_description = $small_description;
                        
        if($hasfileprod_image)
        {
            $image_file=$prod_image; 
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time(). '.'.$img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }              
                                            
        $products->original_price = $original_price;
        $products->offer_price = $offer_price;
        $products->quantity = $quantity;
        $products->priority = $priority;
        $products->p_highlight_heading = $p_highlight_heading;
        $products->p_highlights = $p_highlights;
        $products->p_description_heading = $p_description_heading;
        $products->P_description = $p_description;
        $products->p_det_heading = $p_details_heading;
        $products->p_details = $p_details;
                                    
        $products->new_arrival_products = $new_arrival == true ? '1':'0';
        $products->featured_products = $featured_products == true ? '1':'0';
        $products->popular_products = $popular_products == true ? '1':'0';
        $products->offers_products = $offers_products == true ? '1':'0';
        $products->status = $status == true ? '1':'0';
        
        $products->save();
    }

    public static function updatemodel($id,$name,$sub_category_id,$url,$small_description,$hasfileprod_image,$prod_image,
    $original_price,$offer_price,$quantity,$priority,$p_highlight_heading,$p_highlights,$p_description_heading,
    $p_description,$p_details_heading,$p_details,$new_arrival,$featured_products,$popular_products,$offers_products,$status){
   
        $products = Product::find($id);
        $products->name= $name;
        $products->sub_category_id = $sub_category_id;
        $products->url = $url;
        $products->small_description = $small_description;
                        
        if($hasfileprod_image)
        {
            $image_file=$prod_image; 
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time(). '.'.$img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }              
                                            
        $products->original_price = $original_price;
        $products->offer_price = $offer_price;
        $products->quantity = $quantity;
        $products->priority = $priority;
        $products->p_highlight_heading = $p_highlight_heading;
        $products->p_highlights = $p_highlights;
        $products->p_description_heading = $p_description_heading;
        $products->P_description = $p_description;
        $products->p_det_heading = $p_details_heading;
        $products->p_details = $p_details;
                                    
        $products->new_arrival_products = $new_arrival == true ? '1':'0';
        $products->featured_products = $featured_products == true ? '1':'0';
        $products->popular_products = $popular_products == true ? '1':'0';
        $products->offers_products = $offers_products == true ? '1':'0';
        $products->status = $status == true ? '1':'0';

        $products->update();

    }

    public static function deletemodel($id){
        $product = Product::find($id);
        $product->status='2';
        $product->update();
    }

    public static function searchautocomplete($query){
        return Product::where('name','LIKE','%'.$query.'%')->where('status', '0')->get();
    }
    public static function searchautoresult($query){
        return Product::where('name','LIKE','%'.$query.'%')->where('status', '0')->first();
    }

    public static function productviewmodelurl($prod_url){
        return Product::where('url',$prod_url)->where('status','!=','2')->where('status', '0')->first();
    }

    public static function productviewmodelid($subcategory_id){
    return Product::where('sub_category_id', $subcategory_id)->where('status','!=','2')->where('status', '0')->paginate(3);
    }

    public static function productviewmodelsort($subcategory_id,$wrt,$by){
        return Product::where('sub_category_id', $subcategory_id)
        ->orderBy($wrt, $by)
        ->where('status','!=','2')
        ->where('status','0')->paginate(3);
    }
}
