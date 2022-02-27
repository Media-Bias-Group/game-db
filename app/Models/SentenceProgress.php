<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentenceProgress extends Model
{
    protected $fillable=['user_id','sentence_id'];
    use HasFactory;
}
