<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function joinSurvey($slug, $slug_survey)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $survey = Survey::where('slug', $slug_survey)->firstOrFail();
        $fields = $survey->fields()->get();
        // return response()->json($survey_fields);
        return view('user.survey.join', compact('event', 'survey', 'fields'));
    }
}
