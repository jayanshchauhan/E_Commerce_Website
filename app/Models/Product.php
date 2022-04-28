<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'sub_category_id',
        'products',
        'name',
        'url',
        'small_description',
        'image',
        'p_highlight_heading',
        'p_highlights',
        'P_description_heading',
        'p_description',
        'p_det_heading',
        'P_details',
        'sale_tag',
        'original_price',
        'offer_price',
        'quantity',
        'priority',
        'new_arrival_products',
        'featured_products',
        'popular_products',
        'offers_products',
        'status'
    ];

    /**
     * subcategory
     *
     * @return void
     */
    public function subcategory()
    {

        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    /**
     * indexmodel
     *
     * @return void
     */
    public static function indexmodel()
    {
        return Product::where('status', '!=', '2')->paginate(3);
    }

    /**
     * editmodel
     *
     * @param  mixed $id
     * @return void
     */
    public static function editmodel($id)
    {
        if (empty($id)) {
            return null;
        }
        return Product::find($id);
    }

    /**
     * storemodel
     *
     * @param  mixed $data
     * @param  mixed $hasfileprod_image
     * @param  mixed $prod_image
     * @return void
     */
    public static function storemodel($data, $hasfileprod_image, $prod_image)
    {
        if (empty($data)) {
            return null;
        }
        $products = new Product();
        foreach ($data as $attr => $value) {
            $products->{$attr} = $value;
        }
        if ($hasfileprod_image) {
            $image_file = $prod_image;
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }
        $products->save();
    }

    /**
     * updatemodel
     *
     * @param  mixed $id
     * @param  mixed $data
     * @param  mixed $hasfileprod_image
     * @param  mixed $prod_image
     * @return void
     */
    public static function updatemodel($id, $data, $hasfileprod_image, $prod_image)
    {
        if (empty($data) || empty($id)) {
            return null;
        }
        $products = Product::find($id);
        if (empty($products)) {
            return null;
        }
        foreach ($data as $attr => $value) {
            $products->{$attr} = $value;
        }
        if ($hasfileprod_image) {
            $image_file = $prod_image;
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/products/', $img_filename);
            $products->image = $img_filename;
        }
        $products->update();
    }

    /**
     * deletemodel
     *
     * @param  mixed $id
     * @return void
     */
    public static function deletemodel($id)
    {
        if (empty($id)) {
            return null;
        }
        $product = Product::find($id);
        $product->status = '2';
        $product->update();
    }

    /**
     * searchautocomplete
     *
     * @param  mixed $query
     * @return void
     */
    public static function searchautocomplete($query)
    {
        if (empty($query)) {
            return null;
        }
        return Product::where('name', 'LIKE', '%' . $query . '%')->where('status', '0')->get();
    }

    /**
     * searchautoresult
     *
     * @param  mixed $query
     * @return void
     */
    public static function searchautoresult($query)
    {
        if (empty($query)) {
            return null;
        }
        return Product::where('name', 'LIKE', '%' . $query . '%')->where('status', '0')->first();
    }

    /**
     * productviewmodelurl
     *
     * @param  mixed $prod_url
     * @return void
     */
    public static function productviewmodelurl($prod_url)
    {
        if (empty($prod_url)) {
            return null;
        }
        return Product::where('url', $prod_url)->where('status', '!=', '2')->where('status', '0')->first();
    }

    /**
     * productviewmodelid
     *
     * @param  mixed $subcategory_id
     * @return void
     */
    public static function productviewmodelid($subcategory_id)
    {
        if (empty($subcategory_id)) {
            return null;
        }
        return Product::where('sub_category_id', $subcategory_id)->where('status', '!=', '2')->where('status', '0')->paginate(3);
    }

    /**
     * productviewmodelsort
     *
     * @param  mixed $subcategory_id
     * @param  mixed $wrt
     * @param  mixed $by
     * @return void
     */
    public static function productviewmodelsort($subcategory_id, $wrt, $by)
    {
        if (empty($subcategory_id)) {
            return null;
        }
        return Product::where('sub_category_id', $subcategory_id)
            ->orderBy($wrt, $by)
            ->where('status', '!=', '2')
            ->where('status', '0')->paginate(3);
    }

    /**
     * productviewmodelsortwithoutsubid
     *
     * @param  mixed $wrt
     * @param  mixed $by
     * @return void
     */
    public static function productviewmodelsortwithoutsubid($wrt, $by)
    {
        return Product::orderBy($wrt, $by)->get();
    }

    /**
     * showbyapimodel
     *
     * @param  mixed $sortt
     * @param  mixed $idd
     * @param  mixed $namee
     * @param  mixed $pagee
     * @return void
     */
    public static function showbyapimodel($sortt, $idd, $namee, $pagee)
    {
        $query = Product::query();

        if ($sort = $sortt) {
            $query->orderBy('offer_price', $sort);
        }
        if ($id = $idd) {
            $query->where('id', '=', $id);
        }
        if ($name = $namee) {
            $query->where('name', '=', $name);
        }
        $perPage = 4;
        $page = $pagee;

        $total = $query->count();

        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();
        return [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'Last page' => ceil($total / $perPage)
        ];
    }
}
