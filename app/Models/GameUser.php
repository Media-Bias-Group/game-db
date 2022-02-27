<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $fillable = ['id','user_id','achievements','level','local_rank','money','slant','game_finished'];
    use HasFactory;
}
