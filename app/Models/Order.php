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

    public static function profileupdatemodel($user_id,$name,$lname,$hasFileimage,$image,$address,$city,$state,$pincode,$phoneno){
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->name = $name;
        $user->lname = $lname;

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

        $user->address = $address;
        $user->city = $city;
        $user->state = $state;
        $user->pincode = $pincode;
        $user->phoneno = $phoneno;

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
