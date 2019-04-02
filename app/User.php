<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_adress',
    ];

    // dang nhap class
    public function loginTrue($email, $password) {
        $sql = $this->where('email', '=' , $email , 'password' , '=',  $password)->get();
        return $sql;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function updateUser($email, $name, $phone,  $gender, $bird, $address)
    {
        return User::where('email' , $email)
                    ->update(['name'     => $name,
                            'user_phone'    => $phone,
                            'user_gender'   => $gender,
                            'user_bird'     => $bird,
                            'user_adress'  => $address]);
    }

    public static function updateUser_2($email, $name,  $newpass, $phone,  $gender, $bird, $address)
    {
        return User::where('email' , $email)
                    ->update(['name'     => $name,
                            'password' => $newpass,
                            'user_phone'    => $phone,
                            'user_gender'   => $gender,
                            'user_bird'     => $bird,
                            'user_adress'  => $address]);
    }
}
