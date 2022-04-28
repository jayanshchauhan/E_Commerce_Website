<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'descrip',
        'status'
    ];

    /**
     * indexmodel
     *
     * @return void
     */
    public static function indexModel()
    {
        return Groups::where('status', '!=', notShow)->get();
    }

    /**
     * groupmodel
     *
     * @return void
     */
    public static function groupModel()
    {
        return Groups::where('status', show)->get();
    }

    /**
     * storemodel
     *
     * @param  mixed $data
     * @return void
     */
    public static function storeModel($data)
    {
        if (empty($data)) {
            return false;
        }
        $group = new Groups();
        foreach ($data as $attr => $value) {
            $group->{$attr} = $value;
        }
        $group->save();
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
        return Groups::find($id);
    }

    /**
     * updatemodel
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public static function updateModel($id, $data)
    {
        if (empty($data) || empty($id)) {
            return false;
        }
        $group = Groups::find($id);

        if (empty($group)) {
            return false;
        }

        foreach ($data as $attr => $value) {
            $group->{$attr} = $value;
        }
        $group->update();
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
        $group = Groups::find($id);
        $group->status = "2";
        $group->update();
    }

    /**
     * groupviewmodelurl
     *
     * @param  mixed $group_url
     * @return void
     */
    public static function groupViewModelUrl($group_url)
    {
        if (empty($group_url)) {
            return null;
        }
        return Groups::where('url', $group_url)->first();
    }
}
