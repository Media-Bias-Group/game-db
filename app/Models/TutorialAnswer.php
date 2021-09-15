<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialAnswer extends Model
{
    protected $fillable = ['user_id','tutorial_question_id','answer'];
    use HasFactory;
}
