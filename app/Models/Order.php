<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
        'user_id',
        'Product',
        'Price',
        'Payment',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function myordermodel($id){
        return Order::where('user_id','=',$id)->get();
    }

    public static function profileupdatemodel($data,$hasFileimage,$image){

        $user_id=Auth::user()->id;
        $user = User::find($user_id);
        if (empty($user)) {
            return null;
          }

          foreach($data as $attr => $value) {    
              $user->{$attr} = $value;        
          }

        if($hasFileimage){
            $destination='uploads/profile/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$image;
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/profile/',$filename);
            $user->image=$filename;
        }

        $user->update();
    }

    public static function orderhistorymodel($items_in_cart,$user_id){
        foreach($items_in_cart as $items){
            $order = new Order();
            $order->user_id = $user_id; 
            $order->Product = $items['item_name'];
            $order->Price = $items['item_price'];
            $order->Payment = "Cash On Delivery";
            $order->Status = "Completed";
            $order->save();
        }
    }


}
