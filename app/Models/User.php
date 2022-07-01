<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'born_place',
        'born_date',
        'gender',
        'phone',
        'address',
        'institute',
        'desa_id',
        'job_status',
        'verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getGetAvatarAttribute()
    {
        return $this->avatar ? asset($this->avatar) : 'https://ui-avatars.com/api/?background=46c35f&color=fff&name=' . $this->name;
    }

    public function getGetGenderAttribute()
    {
        return $this->gender ? ( ($this->gender == 1) ? 'Pria' : 'Wanita' ) : '-';
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    // village

    public function getCityAttribute()
    {
        $data = \Indonesia::findVillage($this->desa_id, $with = ['district.city']);
        // array $with : ['province', 'city', 'district', 'district.city', 'district.city.province']
        return $data->district->city->name;
    }


}
