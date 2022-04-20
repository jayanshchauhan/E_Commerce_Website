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
        'name', 'email', 'password','lname','image','address','city','state','pincode','phoneno',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function indexmodel(){
        return User::where('status','!=','1')->paginate(3);
    }

    public static function editmodel($id){
        return User::find($id);
    }

    public static function updatemodel($id,$data){
        $user=User::find($id);
        if (empty($user)) {
            return null;
          }

          foreach($data as $attr => $value) {    
              $user->{$attr} = $value;        
        }
        $user->update();
    }

    public static function deletemodel($id){
        $user = User::find($id);
        $user->status='1';
        $user->update();
    }
}
