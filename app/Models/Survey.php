<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
     protected $fillable = ['user_id','gender','age','education','proficiency','behaviour','averageNewsCheck'];
    use HasFactory;
}
