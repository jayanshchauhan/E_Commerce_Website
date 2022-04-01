<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\User;
use App\Models\Order;
use Auth;

class CheckoutController extends Controller
{
    public function index(){
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $id = Auth::id();
        $user=User::find($id);
        return view('frontend.checkout.index')
        ->with('cart_data',$cart_data)
        ->with('user',$user);
    }

    public function store(){

            $user_id = Auth::id();
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            foreach($items_in_cart as $items){
                
                $order = new Order();
                $order->user_id = $user_id; 
                $order->Product = $items['item_name'];
                $order->Price = $items['item_price'];
                $order->Payment = "Cash On Delivery";
                $order->Status = "Completed";
                $order->save();
            }
            
            Cookie::queue(Cookie::forget('shopping_cart'));
        
        return view('frontend.checkout.thank-you-page');
    }
}
