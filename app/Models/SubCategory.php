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
    public static function indexmodel()
    {
        return SubCategory::where('status', '!=', '2')->paginate(21);
    }

    /**
     * editmodel
     *
     * @param  mixed $id
     * @return void
     */
    public static function editmodel($id)
    {
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
    public static function storemodel($data, $hasfileimage, $image)
    {
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
    public static function updatemodel($id, $data, $hasfileimage, $image)
    {
        $subcategory = SubCategory::find($id);
        if (empty($subcategory)) {
            return null;
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
    public static function deletemodel($id)
    {
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
    public static function subcategorymodelurl($subcate_url)
    {
        return Subcategory::where('url', $subcate_url)->first();
    }

    /**
     * subcategorymodelid
     *
     * @param  mixed $category_id
     * @return void
     */
    public static function subcategorymodelid($category_id)
    {
        return Subcategory::where('category_id', $category_id)->where('status', '!=', '2')->where('status', '0')->get();
    }
}
