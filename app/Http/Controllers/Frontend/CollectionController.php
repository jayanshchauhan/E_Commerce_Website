<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Groups;
use App\Models\SubCategory;
use App\Models\Product;


class CollectionController extends Controller
{
    public function index()
        {
            $groups = Groups::where('status', '0')->get();
            return view('frontend.collections.index')
            ->with('groups', $groups);
        }
        
    public function groupview($group_url)
    {
        $group = Groups::where('url', $group_url)->first();
        $group_id = $group->id;
        $category = Category::where('group_id', $group_id)->where('status','!=','2')->where('status','0')->get();
        return view('frontend.collections.category')
            ->with('category', $category)
            ->with('group', $group);
    }

    public function categoryview($group_url,$cate_url){
        $category = Category::where('url', $cate_url)->first();
        $category_id = $category->id;
        $subcategory = Subcategory::where('category_id', $category_id)->where('status','!=','2')->where('status','0')->get();
        return view('frontend.collections.sub-category')
            ->with('category', $category)
            ->with('subcategory', $subcategory);
    }

    public function subcategoryview($group_url,$cate_url,$subcate_url){
        $subcategory = Subcategory::where('url', $subcate_url)->first();
        $subcategory_id = $subcategory->id;
        $products = Product::where('sub_category_id', $subcategory_id)->where('status','!=','2')->where('status', '0')->get();
        return view('frontend.collections.products')
            ->with('products', $products)
            ->with('subcategory', $subcategory);
    }
}
