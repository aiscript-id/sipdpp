<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $fillable = ['name', 'slug', 'description', 'publish'];

    public function fields()
    {
        return $this->hasMany(SurveyField::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function scopePublished($query)
    {
        return $query->where('surveys.publish', 1);
    }

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
