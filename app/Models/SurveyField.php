<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
