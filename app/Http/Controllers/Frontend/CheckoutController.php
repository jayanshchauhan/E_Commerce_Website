<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\User;
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
}
