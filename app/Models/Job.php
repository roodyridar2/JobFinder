<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // protected $table = 'jobs';
    protected $fillable = ['title', 'category', 'company', 'job_region', 'job_type', 'vacancy', 'experience', 'salary', 'gender', 'application_deadline', 'jobdescription', 'responsibilities', 'education_experience', 'otherbenefits', 'image', 'created_at', 'updated_at'];
    public $timestamps = false;
}
