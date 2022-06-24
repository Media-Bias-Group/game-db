<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $fillable = ['id','global_skill','global_XP','game_finished'];
    use HasFactory;
}
