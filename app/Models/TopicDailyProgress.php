<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicDailyProgress extends Model
{
    protected $fillable = ['user_id','topic_id'];
    use HasFactory;
}
