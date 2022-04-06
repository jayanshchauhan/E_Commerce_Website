<?php

namespace App\Http\Controllers\Frontend;
 
//use Illuminate\Http\Request;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;


class CollectionController extends Controller
{
    public function index()
        {
            $groups = Groups::groupmodel();
            return view('frontend.collections.index')
            ->with('groups', $groups);
        }
        
    public function groupview($group_url)
    {
        $group = Groups::groupviewmodelurl($group_url);
        $group_id = $group->id;
        $category = Category::categoryviewmodelid($group_id);
        return view('frontend.collections.category')
            ->with('category', $category)
            ->with('group', $group);
    }

    public function categoryview($group_url,$cate_url){
        $category = Category::categoryviewmodelurl($cate_url);
        $category_id = $category->id;
        $subcategory = Subcategory::subcategorymodelid($category_id);
        return view('frontend.collections.sub-category')
            ->with('category', $category)
            ->with('subcategory', $subcategory);
    }

    public function subcategoryview($group_url,$cate_url,$subcate_url){
        $subcategory = Subcategory::subcategorymodelurl($subcate_url);
        $subcategory_id = $subcategory->id;

        if(Request::get('sort') =='price_asc'){

            $products = Product::productviewmodelsort($subcategory_id,'offer_price','asc');
                       
        }elseif(Request::get('sort')=='price_desc'){

            $products = Product::productviewmodelsort($subcategory_id,'offer_price','desc');

         }elseif(Request::get('sort')=='newest'){

            $products = Product::productviewmodelsort($subcategory_id,'created_at','desc');

        }else{
        $products = Product::productviewmodelid($subcategory_id);
        }
        return view('frontend.collections.products')
            ->with('products', $products)
            ->with('subcategory', $subcategory);
    }

    public function productview($group_url,$cate_url,$subcate_url,$prod_url){
        $products = Product::productviewmodelurl($prod_url);
        return view('frontend.collections.products-view')
            ->with('products', $products);
    }

    
}
