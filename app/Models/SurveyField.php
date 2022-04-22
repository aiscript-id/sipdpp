<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyField extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'survey_id', 'type'];
}
