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
            $products = Product::indexModel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.product.index')
            ->with('products', $products);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        try {
            $subcategory = Subcategory::indexModel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.product.create')
            ->with('subcategory', $subcategory);
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
        if (empty($id)) {
            return view('errors.error_show');
        }
        try {
            $subcategory = SubCategory::indexModel();
            $product = Product::editModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.product.edit')
            ->with('subcategory', $subcategory)
            ->with('product', $product);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
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

        try {
            Product::storeModel($data, $hasfileprod_image, $prod_image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Product added Successfully');
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
        if (empty($id)) {
            return view('errors.error_show');
        }
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

        try {
            Product::updateModel($id, $data, $hasfileprod_image, $prod_image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Product Updated Successfully');
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        if (empty($id)) {
            return view('errors.error_show');
        }
        try {
            return Product::deleteModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Product Deleted Successfully.');
    }
}
