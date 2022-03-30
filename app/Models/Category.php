<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable=[
        'group_id',
        'url',
        'name',
        'description',
        'image',
        'status',
    ];

    public function group(){
            return $this->belongsTo(Groups::class, 'group_id', 'id');
    }
}
