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
}
