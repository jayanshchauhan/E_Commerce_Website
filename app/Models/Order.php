<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Order extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'Product',
        'Price',
        'Payment',
        'Quantity',
        'Status',
    ];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * myordermodel
     *
     * @param  mixed $id
     * @return void
     */
    public static function myordermodel($id)
    {
        if (empty($id)) {
            return null;
        }
        return Order::where('user_id', '=', $id)->get();
    }

    /**
     * profileupdatemodel
     *
     * @param  mixed $data
     * @param  mixed $hasFileimage
     * @param  mixed $image
     * @return void
     */
    public static function profileupdatemodel($data, $hasFileimage, $image)
    {
        if (empty($data)) {
            return null;
        }
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if (empty($user)) {
            return null;
        }

        foreach ($data as $attr => $value) {
            $user->{$attr} = $value;
        }

        if ($hasFileimage) {
            $destination = 'uploads/profile/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $image;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
        }

        $user->update();
    }

    /**
     * orderhistorymodel
     *
     * @param  mixed $items_in_cart
     * @param  mixed $user_id
     * @return void
     */
    public static function orderhistorymodel($items_in_cart, $user_id)
    {
        if (empty($user_id)) {
            return null;
        }
        foreach ($items_in_cart as $items) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->Product = $items['item_name'];
            $order->Price = $items['item_price'];
            $order->Quantity = $items['item_quantity'];
            $order->Payment = "Cash On Delivery";
            $order->Status = "Completed";
            $order->save();
        }
    }
}
