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

    public static function storemodel($data){
        $group=new Groups(); 
        foreach($data as $attr => $value) {    
            $group->{$attr} = $value;        
        }
        $group->save();
    }

    public static function editmodel($id){
        return Groups::find($id);
    }

    public static function updatemodel($id,$data){
        $group= Groups::find($id);

        if (empty($group)) {
            return null;
          }

          foreach($data as $attr => $value) {    
              $group->{$attr} = $value;        
          }
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
