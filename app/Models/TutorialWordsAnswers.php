<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialWordsAnswers extends Model
{
    protected $fillable=['word_id','user_id','annotaion','answer'];
    use HasFactory;
}
