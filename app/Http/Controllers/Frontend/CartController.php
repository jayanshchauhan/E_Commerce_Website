<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use App\Http\Requests\UpdatePostFormRequest;

class CartController extends Controller
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
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.cart.index')
            ->with('cart_data', $cart_data);
    }

    /**
     * addtocart
     *
     * @param  mixed $request
     * @return void
     */
    public function addToCart(Request $request)
    {

        try {
            $prod_id = $request->input('product_id');
            $quantity = $request->input('quantity');

            if (Cookie::get('shopping_cart')) {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
            } else {
                $cart_data = array();
            }

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if (in_array($prod_id_is_there, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                    if ($cart_data[$keys]["item_id"] == $prod_id) {
                        $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                        $item_data = json_encode($cart_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart', 'status2' => '2']);
                    }
                }
            } else {
                $products = Product::editModel($prod_id);
                $prod_name = $products->name;
                $prod_image = $products->image;
                $priceval = $products->offer_price;

                if ($products) {
                    $item_array = array(
                        'item_id' => $prod_id,
                        'item_name' => $prod_name,
                        'item_quantity' => $quantity,
                        'item_price' => $priceval,
                        'item_image' => $prod_image
                    );
                    $cart_data[] = $item_array;

                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
                }
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * cartloadbyajax
     *
     * @return void
     */
    public function cartloadByAjax()
    {
        try {
            if (Cookie::get('shopping_cart')) {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                $totalcart = count($cart_data);

                echo json_encode(array('totalcart' => $totalcart));
                die;
                return;
            } else {
                $totalcart = "0";
                echo json_encode(array('totalcart' => $totalcart));
                return;
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * updatetocart
     *
     * @param  mixed $request
     * @return void
     */
    public function updateToCart(Request $request)
    {
        try {
            $prod_id = $request->input('product_id');
            $quantity = $request->input('quantity');

            if (Cookie::get('shopping_cart')) {
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);

                $item_id_list = array_column($cart_data, 'item_id');
                $prod_id_is_there = $prod_id;

                if (in_array($prod_id_is_there, $item_id_list)) {
                    foreach ($cart_data as $keys => $values) {
                        if ($cart_data[$keys]["item_id"] == $prod_id) {
                            $cart_data[$keys]["item_quantity"] =  $quantity;
                            $item_data = json_encode($cart_data);
                            $minutes = 60;
                            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                            return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Quantity Updated']);
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * deletefromcart
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteFromCart(Request $request)
    {
        try {
            $prod_id = $request->input('product_id');

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if (in_array($prod_id_is_there, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                    if ($cart_data[$keys]["item_id"] == $prod_id) {
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status' => 'Item Removed from Cart']);
                    }
                }
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * clearcart
     *
     * @return void
     */
    public function clearCart()
    {
        try {
            Cookie::queue(Cookie::forget('shopping_cart'));
            return response()->json(['status' => 'Your Cart is Cleared']);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
