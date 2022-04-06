<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table='groups';
    protected $fillable=['name','url','descrip','status'];

    public static function indexmodel(){
        return Groups::where('status','!=','2')->get();
    }
    public static function groupmodel(){
        return Groups::where('status','0')->get();
    }

    public static function storemodel($name,$url,$descrip,$status){
        $group=new Groups(); 
        $group->name = $name;
        $group->url = $url;
        $group->descrip=$descrip;
        if($status == true){
        $group->status = "1";
        }else{
        $group->status = "0";
        }
        $group->save();
    }

    public static function editmodel($id){
        return Groups::find($id);
    }

    public static function updatemodel($id,$name,$url,$descrip,$status){
        $group= Groups::find($id);
        $group->name = $name;
        $group->url = $url;
        $group->descrip=$descrip;
        $group->status=$status==true?'1':'0';
        $group->update();
    }

    public static function deletemodel($id){
        $group= Groups::find($id);
        $group->status="2";
        $group->update();
    }

    public static function groupviewmodelurl($group_url){
        return Groups::where('url', $group_url)->first();
    }
}
