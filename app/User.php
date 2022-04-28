<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lname', 'image', 'address', 'city', 'state', 'pincode', 'phoneno',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function indexModel()
    {
        return User::where('status', '!=', notShow)->paginate(userPagination);
    }

    public static function editModel($id)
    {
        if (empty($id)) {
            return false;
        }
        return User::find($id);
    }

    public static function updateModel($id, $data)
    {
        if (empty($id) || empty($data)) {
            return false;
        }
        $user = User::find($id);
        if (empty($user)) {
            return false;
        }

        foreach ($data as $attr => $value) {
            $user->{$attr} = $value;
        }
        $user->update();
    }

    public static function deleteModel($id)
    {
        if (empty($id)) {
            return false;
        }
        $user = User::find($id);
        $user->status = '1';
        $user->update();
    }
}
