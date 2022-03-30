<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table='products';
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

    public function subcategory(){

        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
}
