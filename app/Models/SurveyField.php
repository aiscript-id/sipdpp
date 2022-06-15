<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SurveyField extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'survey_id', 'type', 'options'];

    public function getGetOptionsAttribute()
    {
        // explode options to array
        $options = explode(',', $this->options);
        // remove empty values
        $options = array_filter($options);
        // return options
        return $options;
    }

    // with answer
    public function getAnswerAttribute($survey_user_id = null)
    {
        // add select answer
        if ($survey_user_id) {
            $this->addselect('answers.answer');
            $this->join('answers', 'answers.field_id', '=', 'survey_fields.id')
                ->where('answers.survey_user_id', $survey_user_id);
        }
        return $this;
        // $this->selectAnswer = Answer::where('field_id', $this->id)->where('survey_user_id', $survey_user_id)->first();
    }

    // get all answer
    public function getAllAnswersAttribute($survey_user_id)
    {
        return $this->hasMany(Answer::class, 'field_id', 'id')
        ->whereIn('survey_user_id', $survey_user_id);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'field_id', 'id');
    }

    public function filledAnswers()
    {
        return $this->answers()->whereNotNull('answer');
    }

    // most answer and count
    public function getMostAnswerAttribute()
    {
        return $this->answers()->select('answer', DB::raw('count(*) as total'))->groupBy('answer')->orderBy('total', 'desc')->first();
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }


}
