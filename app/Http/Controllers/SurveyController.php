<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Event;
use App\Models\EventSurvey;
use App\Models\Survey;
use App\Models\SurveyField;
use App\Models\SurveyUser;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function joinSurvey($slug, $slug_survey)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $survey = Survey::where('slug', $slug_survey)->firstOrFail();
        $event_survey = EventSurvey::where('event_id', $event->id)->where('survey_id', $survey->id)->firstOrFail(); 

        // create new survey_user
        $survey_user = SurveyUser::where('event_survey_id', $event_survey->id)->where('user_id', auth()->user()->id)->first();
        if (!$survey_user) {
            $data = [
                'event_survey_id' => $event_survey->id,
                'user_id' => auth()->user()->id,
                'progress' => 0,
            ];
            $survey_user = SurveyUser::create($data);
            toastr()->success('You have successfully joined the survey.');
        }
        

        $fields = $survey->fields(function($query) use ($survey_user) {
            $query->answer($survey_user->id);
        })->get();
        return response()->json($fields);
        // return response()->json($survey_fields);
        return view('user.survey.join', compact('event', 'survey', 'fields', 'survey_user'));
    }

    public function store(Request $request)
    {
        $survey_user = SurveyUser::findOrFail($request->survey_user);
        $survey_event = $survey_user->event_survey;
        $surveys = SurveyField::where('survey_id', $survey_event->survey_id)->get();

        // return response()->json($surveys);
        $progress = 0;
        foreach ($surveys as $survey) {
            // insert to answers table
            $id = $survey->id;
            if ($request->$id) {
                Answer::updateOrCreate(
                    ['survey_user_id' => $survey_user->id, 'field_id' => $id],
                    ['answer' => $request->$id]
                );
                $progress =+ 1;
            }
        }

        // update survey_user progress
        $survey_user->progress = $progress;
        $survey_user->save();

        toastr()->success('You have successfully submitted the survey.');
        return redirect()->route('user.events.show', ['slug' => $survey_event->event->slug]);
    }
}
