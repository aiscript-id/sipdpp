<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSurvey extends Model
{
    use HasFactory;
    // table
    protected $table = 'event_survey';
    protected $fillable = ['event_id', 'survey_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    // survey_user
    public function survey_user()
    {
        return $this->hasManyThrough(
            SurveyUser::class,
            EventSurvey::class,
            'survey_id',
            'event_survey_id'
        );
    }

}
