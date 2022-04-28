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
    public static function indexModel()
    {
        return Category::where('status', '!=', notShow)->paginate(categoryPagination);
    }

    /**
     * editmodel
     *
     * @param  mixed $id
     * @return void
     */
    public static function editModel($id)
    {
        if (empty($id)) {
            return false;
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
    public static function storeModel($data, $hasfileimage, $image)
    {
        if (empty($data)) {
            return false;
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
    public static function updateModel($id, $data, $hasfileimage, $image)
    {
        if (empty($id) || empty($data)) {
            return false;
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
    public static function deleteModel($id)
    {
        if (empty($id)) {
            return false;
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
    public static function categoryViewModelUrl($cate_url)
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
    public static function categoryViewModelId($group_id)
    {
        if (empty($group_id)) {
            return null;
        }
        return Category::where('group_id', $group_id)
            ->where('status', '!=', notShow)
            ->where('status', show)->get();
    }
}
