<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class SubCategory extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'url',
        'name',
        'description',
        'image',
    ];

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * indexmodel
     *
     * @return void
     */
    public static function indexModel()
    {
        return SubCategory::where('status', '!=', notShow)
            ->paginate(subCategoryPagination);
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
        return SubCategory::find($id);
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
        $subcategory = new Subcategory();
        foreach ($data as $attr => $value) {
            $subcategory->{$attr} = $value;
        }
        if ($hasfileimage) {
            $image_file = $image;
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }
        $subcategory->save();
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
        if (empty($data) || empty($id)) {
            return false;
        }
        $subcategory = SubCategory::find($id);
        if (empty($subcategory)) {
            return false;
        }
        foreach ($data as $attr => $value) {
            $subcategory->{$attr} = $value;
        }

        if ($hasfileimage) {
            $destination = 'uploads/subcategory/' . $subcategory->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $image_file = $image;
            $img_extension = $image_file->getclientOriginalExtension(); // getting image extension
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/subcategory', $img_filename);
            $subcategory->image = $img_filename;
        }
        $subcategory->update();
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
        $subcategory = SubCategory::find($id);
        $subcategory->status = '2';
        $subcategory->update();
    }

    /**
     * subcategorymodelurl
     *
     * @param  mixed $subcate_url
     * @return void
     */
    public static function subCategoryModelUrl($subcate_url)
    {
        if (empty($subcate_url)) {
            return null;
        }
        return Subcategory::where('url', $subcate_url)
            ->first();
    }

    /**
     * subcategorymodelid
     *
     * @param  mixed $category_id
     * @return void
     */
    public static function subCategoryModelId($category_id)
    {
        if (empty($category_id)) {
            return null;
        }
        return Subcategory::where('category_id', $category_id)
            ->where('status', '!=', notShow)
            ->where('status', show)
            ->get();
    }
}
