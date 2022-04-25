<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Product;
use App\Http\Requests\UpdatePostFormRequest;

class ProductsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $products = Product::indexmodel();
            return view('admin.collection.product.index')
                ->with('products', $products);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        try {
            $subcategory = Subcategory::indexmodel();
            return view('admin.collection.product.create')
                ->with('subcategory', $subcategory);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * edit
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        try {
            $subcategory = SubCategory::indexmodel();
            $product = Product::editmodel($id);
            return view('admin.collection.product.edit')
                ->with('subcategory', $subcategory)
                ->with('product', $product);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {

        try {
            $data = [];
            $data['name'] = $request->input('name');
            $data['sub_category_id'] = $request->input('sub_category_id');
            $data['url'] = $request->input('url');
            $data['small_description'] = $request->input('small_description');

            $hasfileprod_image = $request->hasfile('prod_image');
            $prod_image = $request->file('prod_image');

            $data['original_price'] = $request->input('original_price');
            $data['offer_price'] = $request->input('offer_price');
            $data['quantity'] = $request->input('quantity');
            $data['priority'] = $request->input('priority');
            $data['p_highlight_heading'] = $request->input('p_highlight_heading');
            $data['p_highlights'] = $request->input('p_highlights');
            $data['p_description_heading'] = $request->input('p_description_heading');
            $data['P_description'] = $request->input('p_description');
            $data['p_det_heading'] = $request->input('p_details_heading');
            $data['p_details'] = $request->input('p_details');

            $data['new_arrival_products'] = $request->input('new_arrival') == true ? '1' : '0';
            $data['featured_products'] = $request->input('featured_products') == true ? '1' : '0';
            $data['popular_products'] = $request->input('popular_products') == true ? '1' : '0';
            $data['offers_products'] = $request->input('offers_products') == true ? '1' : '0';
            $data['status'] = $request->input('status') == true ? '1' : '0';

            Product::storemodel($data, $hasfileprod_image, $prod_image);
            return redirect()->back()->with('status', 'Product added Successfully');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {

        try {
            $data = [];
            $data['name'] = $request->input('name');
            $data['sub_category_id'] = $request->input('sub_category_id');
            $data['url'] = $request->input('url');
            $data['small_description'] = $request->input('small_description');

            $hasfileprod_image = $request->hasfile('prod_image');
            $prod_image = $request->file('prod_image');

            $data['original_price'] = $request->input('original_price');
            $data['offer_price'] = $request->input('offer_price');
            $data['quantity'] = $request->input('quantity');
            $data['priority'] = $request->input('priority');
            $data['p_highlight_heading'] = $request->input('p_highlight_heading');
            $data['p_highlights'] = $request->input('p_highlights');
            $data['p_description_heading'] = $request->input('p_description_heading');
            $data['P_description'] = $request->input('p_description');
            $data['p_det_heading'] = $request->input('p_details_heading');
            $data['p_details'] = $request->input('p_details');

            $data['new_arrival_products'] = $request->input('new_arrival') == true ? '1' : '0';
            $data['featured_products'] = $request->input('featured_products') == true ? '1' : '0';
            $data['popular_products'] = $request->input('popular_products') == true ? '1' : '0';
            $data['offers_products'] = $request->input('offers_products') == true ? '1' : '0';
            $data['status'] = $request->input('status') == true ? '1' : '0';

            Product::updatemodel($id, $data, $hasfileprod_image, $prod_image);
            return redirect()->back()->with('status', 'Product Updated Successfully');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        try {
            return Product::deletemodel($id);
            return redirect()->back()->with('status', 'Product Deleted Successfully.');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
