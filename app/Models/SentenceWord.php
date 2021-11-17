<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentenceWord extends Model
{protected $fillable = ['sentence_id','word_id'];
    use HasFactory;
}
