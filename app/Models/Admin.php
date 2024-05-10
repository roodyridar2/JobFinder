<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable 
{

    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'created_at', 'updated_at'];

    protected $hidden = ['password'];


}
