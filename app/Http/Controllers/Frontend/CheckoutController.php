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
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $id = Auth::id();
        try {
            $user = User::editModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.checkout.index')
            ->with('cart_data', $cart_data)
            ->with('user', $user);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $user_id = Auth::id();
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $items_in_cart = $cart_data;
        try {
            Order::orderHistoryModel($items_in_cart, $user_id);
            Cookie::queue(Cookie::forget('shopping_cart'));
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.checkout.thank-you-page');
    }
}
