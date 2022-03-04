<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentenceAnswer extends Model
{
    protected $fillable=['sentence_id','user_id','annotaion','answer'];
    use HasFactory;
}
