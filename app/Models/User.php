<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function articles(){
        return $this->hasMany(Article::class,'user_id','id');
    }


    public function logout()
    {
        $this->api_token=null;
        $this->save();
        return $this;
    }

    public function toArray()
    {
//        $data=parent::toArray();;
//        dd($this->attributes);
//        dd(($this->username));
        return [
            'id'=>$this->id,
            'username'=>$this->name,
            'email'=>$this->email,
        ];
//        if(request()->with==='articles'){
//         $data['article']=$this->articles;
//        }
//        return $data;
    }

    public function getFooAttribute()
    {
        return 'foo '.$this->id;
    }
}
