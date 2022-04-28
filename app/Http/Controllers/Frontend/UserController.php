<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\UpdatePostFormRequest;

class UserController extends Controller
{

    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        return view('frontend.index');
    }

    /**
     * myprofile
     *
     * @return void
     */
    public function myprofile()
    {
        try {
            return view('frontend.user.profile');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * myorder
     *
     * @param  mixed $id
     * @return void
     */
    public function myorder($id)
    {
        try {
            $order = Order::myordermodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.user.order')
            ->with('order', $order);
    }

    /**
     * profileupdate
     *
     * @param  mixed $request
     * @return void
     */
    public function profileupdate(UpdatePostFormRequest $request)
    {
        $data = [];
        $data['name'] = $request->input('name');
        $data['lname'] = $request->input('lname');

        $hasFileimage = $request->hasFile('image');
        $image = $request->file('image');

        $data['address'] = $request->input('address');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['pincode'] = $request->input('pincode');
        $data['phoneno'] = $request->input('phoneno');
        try {
            Order::profileupdatemodel($data, $hasFileimage, $image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()->back()->with('status', 'Profile Updated');
    }

    /**
     * SearchautoComplete
     *
     * @param  mixed $request
     * @return void
     */
    public function SearchautoComplete(Request $request)
    {
        try {
            $query = $request->get('term', '');
            $products = Product::searchautocomplete($query);
            $data = [];
            foreach ($products as $items) {
                $data[] = [
                    'value' => $items->name,
                    'id' => $items->id
                ];
            }
            if (count($data)) {
                return $data;
            } else {
                return ['value' => 'No Result Found', 'id' => ''];
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * result
     *
     * @param  mixed $request
     * @return void
     */
    public function result(Request $request)
    {
        try {
            $searchingdata = $request->input('search_product');
            $products = Product::searchautoresult($searchingdata);
            if ($products) {
                if (isset($_POST['searchbtn'])) {
                    return redirect('collection/' . $products->subcategory->category->group->url . '/' .
                        $products->subcategory->category->url . '/' . $products->subcategory->url);
                } else {
                    return redirect('collection/' . $products->subcategory->category->group->url . '/' .
                        $products->subcategory->category->url . '/' . $products->subcategory->url . '/' . $products->url);
                }
            }
            // return redirect('search/'.$products->url);
            else {
                return redirect('/')->with('status', 'Product Not Available');
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
