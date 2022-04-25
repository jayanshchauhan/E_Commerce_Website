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
    public static function indexmodel()
    {
        return Groups::where('status', '!=', '2')->get();
    }

    /**
     * groupmodel
     *
     * @return void
     */
    public static function groupmodel()
    {
        return Groups::where('status', '0')->get();
    }

    /**
     * storemodel
     *
     * @param  mixed $data
     * @return void
     */
    public static function storemodel($data)
    {
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
    public static function editmodel($id)
    {
        return Groups::find($id);
    }

    /**
     * updatemodel
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public static function updatemodel($id, $data)
    {
        $group = Groups::find($id);

        if (empty($group)) {
            return null;
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
    public static function deletemodel($id)
    {
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
    public static function groupviewmodelurl($group_url)
    {
        return Groups::where('url', $group_url)->first();
    }
}
