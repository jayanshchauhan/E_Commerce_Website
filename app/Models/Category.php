<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
 
class Category extends Model
{
    protected $table='categories';
    protected $fillable=[
        'group_id',
        'url',
        'name',
        'description',
        'image',
        'status',
    ];

    public function group(){
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    public static function indexmodel(){
        return Category::where('status','!=','2')->paginate(3);
    }

    public static function editmodel($id){
        return Category::find($id);
    }

    public static function storemodel($data,$hasfileimage,$image){
        $category = new Category();
        foreach($data as $attr => $value) {    
            $category->{$attr} = $value;        
        }
        if($hasfileimage){
            $destination='uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$image;
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/category/',$filename);
            $category->image=$filename;
        }
        $category->save();
    }

    public static function updatemodel($id,$data,$hasfileimage,$image){
        $category = Category::find($id);

        if (empty($category)) {
            return null;
          }

          foreach($data as $attr => $value) {    
              $category->{$attr} = $value;        
          }
        if($hasfileimage){
            $destination='uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$image;
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/category/',$filename);
            $category->image=$filename;
        }
        $category->update();
    }

    public static function deletemodel($id){
        $category = Category::find($id);
        $category->status='2';
        $category->update();
    }

    public static function categoryviewmodelurl($cate_url){
        return Category::where('url', $cate_url)->first();
    }

    public static function categoryviewmodelid($group_id){
        return Category::where('group_id', $group_id)->where('status','!=','2')->where('status','0')->get();
    }
}
