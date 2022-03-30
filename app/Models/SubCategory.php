<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='subcategories';
    protected $fillable=[
        'category_id',
        'url',
        'name',
        'description',
        'image',
    ];

    public function category(){
            return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}

