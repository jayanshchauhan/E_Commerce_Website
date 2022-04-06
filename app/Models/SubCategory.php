<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class SubCategory extends Model
{
    protected $table='subcategories';
    protected $fillable=[
        'category_id',
        'url',
        'name',
        'description',
        'image',
    ];

    public function category(){
            return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public static function indexmodel(){
        return SubCategory::where('status','!=','2')->paginate(3);
    }

    public static function editmodel($id){
        return SubCategory::find($id);
    }

    public static function storemodel($category_id,$url,$name,$description,$hasfileimage,$image,$priority,$status){
        $subcategory=new Subcategory();
        $subcategory->category_id =  $category_id;
        $subcategory->url = $url;
        $subcategory->name = $name;
        $subcategory->description = $description;

        if($hasfileimage)
        {
            $image_file=$image;
            $img_extension= $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename=time().'.'.$img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }        
        $subcategory->priority = $priority;
        $subcategory->status = $status==true ?'1':'0';
        $subcategory->save();
    }

    public static function updatemodel($id,$category_id,$url,$name,$description,$hasfileimage,$image,$priority,$status){
        $subcategory = SubCategory::find($id);
        $subcategory->category_id =  $category_id;
        $subcategory->url = $url;
        $subcategory->name = $name;
        $subcategory->description = $description;

        if($hasfileimage)
        {
            $destination='uploads/subcategory/'.$subcategory->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image_file=$image;
            $img_extension= $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename=time().'.'.$img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }  

        $subcategory->priority =$priority;
        $subcategory->status = $status==true ?'1':'0';
        $subcategory->update();
    }

    public static function deletemodel($id){
        $subcategory = SubCategory::find($id);
        $subcategory->status='2';
        $subcategory->update();
    }

    public static function subcategorymodelurl($subcate_url){
        return Subcategory::where('url', $subcate_url)->first();
    }

    public static function subcategorymodelid($category_id){
        return Subcategory::where('category_id', $category_id)->where('status','!=','2')->where('status','0')->get();
    }
}

