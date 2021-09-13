<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyOutlet extends Model
{
    protected $fillable = ['survey_id','outlet_id'];
    use HasFactory;
}
