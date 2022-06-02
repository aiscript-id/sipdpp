<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyUser extends Model
{
    use HasFactory;
    protected $table = 'survey_users';
    protected $fillable = ['event_survey_id', 'user_id', 'progress'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function event_survey()
    {
        return $this->belongsTo(EventSurvey::class, 'event_survey_id', 'id');
    }

}
