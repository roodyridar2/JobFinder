<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savejob extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'job_id', 'created_at', 'updated_at'];
    public $timestamps = false;
}
