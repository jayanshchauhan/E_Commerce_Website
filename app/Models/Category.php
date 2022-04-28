<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Category extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'url',
        'name',
        'description',
        'image',
        'status',
    ];

    /**
     * group
     *
     * @return void
     */
    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    /**
     * indexmodel
     *
     * @return void
     */
    public static function indexmodel()
    {
        return Category::where('status', '!=', '2')->paginate(11);
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
        return Category::find($id);
    }

    /**
     * storemodel
     *
     * @param  mixed $data
     * @param  mixed $hasfileimage
     * @param  mixed $image
     * @return void
     */
    public static function storemodel($data, $hasfileimage, $image)
    {
        if (empty($data)) {
            return null;
        }
        $category = new Category();
        foreach ($data as $attr => $value) {
            $category->{$attr} = $value;
        }
        if ($hasfileimage) {
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $image;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->save();
    }

    /**
     * updatemodel
     *
     * @param  mixed $id
     * @param  mixed $data
     * @param  mixed $hasfileimage
     * @param  mixed $image
     * @return void
     */
    public static function updatemodel($id, $data, $hasfileimage, $image)
    {
        if (empty($id) || empty($data)) {
            return null;
        }
        $category = Category::find($id);

        foreach ($data as $attr => $value) {
            $category->{$attr} = $value;
        }
        if ($hasfileimage) {
            $destination = 'uploads/category/' . $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $image;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->update();
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

        $category = Category::find($id);
        $category->status = '2';
        $category->update();
    }

    /**
     * categoryviewmodelurl
     *
     * @param  mixed $cate_url
     * @return void
     */
    public static function categoryviewmodelurl($cate_url)
    {
        if (empty($cate_url)) {
            return null;
        }
        return Category::where('url', $cate_url)->first();
    }

    /**
     * categoryviewmodelid
     *
     * @param  mixed $group_id
     * @return void
     */
    public static function categoryviewmodelid($group_id)
    {
        if (empty($group_id)) {
            return null;
        }
        return Category::where('group_id', $group_id)->where('status', '!=', '2')->where('status', '0')->get();
    }
}
