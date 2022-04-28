<?php

namespace App\Http\Controllers\Frontend;

//use Illuminate\Http\Request;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Http\Requests\UpdatePostFormRequest;


class CollectionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $groups = Groups::groupmodel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.collections.index')
            ->with('groups', $groups);
    }

    /**
     * groupview
     *
     * @param  mixed $group_url
     * @return void
     */
    public function groupview($group_url)
    {
        $group = Groups::groupviewmodelurl($group_url);
        $group_id = $group->id;
        try {
            $category = Category::categoryviewmodelid($group_id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.collections.category')
            ->with('category', $category)
            ->with('group', $group);
    }

    /**
     * categoryview
     *
     * @param  mixed $group_url
     * @param  mixed $cate_url
     * @return void
     */
    public function categoryView($group_url, $cate_url)
    {
        $category = Category::categoryviewmodelurl($cate_url);
        $category_id = $category->id;
        try {
            $subcategory = Subcategory::subcategorymodelid($category_id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.collections.sub-category')
            ->with('category', $category)
            ->with('subcategory', $subcategory);
    }

    /**
     * subcategoryview
     *
     * @param  mixed $group_url
     * @param  mixed $cate_url
     * @param  mixed $subcate_url
     * @return void
     */
    public function subCategoryView($group_url, $cate_url, $subcate_url)
    {
        try {
            $subcategory = Subcategory::subcategorymodelurl($subcate_url);
            $subcategory_id = $subcategory->id;

            if (Request::get('sort') == 'price_asc') {

                $products = Product::productviewmodelsort($subcategory_id, 'offer_price', 'asc');
            } elseif (Request::get('sort') == 'price_desc') {

                $products = Product::productviewmodelsort($subcategory_id, 'offer_price', 'desc');
            } elseif (Request::get('sort') == 'newest') {

                $products = Product::productviewmodelsort($subcategory_id, 'created_at', 'desc');
            } else {
                $products = Product::productviewmodelid($subcategory_id);
            }
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.collections.products')
            ->with('products', $products)
            ->with('subcategory', $subcategory);
    }

    /**
     * productview
     *
     * @param  mixed $group_url
     * @param  mixed $cate_url
     * @param  mixed $subcate_url
     * @param  mixed $prod_url
     * @return void
     */
    public function productView($group_url, $cate_url, $subcate_url, $prod_url)
    {
        try {
            $products = Product::productviewmodelurl($prod_url);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('frontend.collections.products-view')
            ->with('products', $products);
    }

    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        if (Request::get('sort') == 'price_asc') {

            $products = Product::productviewmodelsortwithoutsubid('offer_price', 'asc');
        } elseif (Request::get('sort') == 'price_desc') {

            $products = Product::productviewmodelsortwithoutsubid('offer_price', 'desc');
        } elseif (Request::get('sort') == 'newest') {

            $products = Product::productviewmodelsortwithoutsubid('created_at', 'desc');
        } else {
            $products = Product::all();
        }
        return view('frontend.collections.allproducts')->with('products', $products);
    }

    /**
     * showbyapi
     *
     * @return void
     */
    public function showbyapi()
    {

        $sort = Request::input('sort');
        $id = Request::input('id');
        $name = Request::input('name');
        $page = Request::input('page', 1);
        try {
            return Product::showbyapimodel($sort, $id, $name, $page);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }

        //   return response()->json($products);
    }

    /**
     * views
     *
     * @param  mixed $prod_url
     * @return void
     */
    public function views($prod_url)
    {
        try {
            $products = Product::productviewmodelurl($prod_url);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect('collection/' . $products->subcategory->category->group->url . '/' .
            $products->subcategory->category->url . '/' . $products->subcategory->url . '/' . $products->url);
    }
}
