<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\User;
use App\Models\Order;
use Auth;
use App\Http\Requests\UpdatePostFormRequest;

class CheckoutController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $id = Auth::id();
            $user = User::editmodel($id);
            return view('frontend.checkout.index')
                ->with('cart_data', $cart_data)
                ->with('user', $user);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {

        try {
            $user_id = Auth::id();
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            Order::orderhistorymodel($items_in_cart, $user_id);

            Cookie::queue(Cookie::forget('shopping_cart'));

            return view('frontend.checkout.thank-you-page');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
