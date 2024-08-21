<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_new';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Id',
        'Name',
        'Phone',
        'Address',
        'City',
        'Email',
        'Password',
        'Role',
        'created_at'
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

    // public function hasRole($role)
    // {
    //     // Giả sử vai trò của người dùng được lưu dưới dạng mảng JSON trong cột 'roles'
    //     $roles = json_decode($this->roles, true); // Chuyển đổi từ JSON thành mảng PHP

    //     // Kiểm tra xem vai trò có trong mảng vai trò của người dùng hay không
    //     return is_array($roles) && in_array($role, $roles);
    // }
}
