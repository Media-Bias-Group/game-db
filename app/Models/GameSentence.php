<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSentence extends Model
{
    use HasFactory;
    protected $fillable = [
        'sentence',
        'link',
        'outlet',
        'topic',
        'type',
        'SentenceBias',
        'SentenceCount',
        'SentenceStatus',
    ];

}
