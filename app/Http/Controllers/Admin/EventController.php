<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Survey;
use App\Models\SurveyField;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::withCount('users')->latest()->orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = route('events.store');
        return view('admin.events.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $attr = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $attr['slug'] = \Str::slug($attr['name']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = MyHelper::instance()->uploadImage($image, 'events');
            $attr['image'] = $image_path;
        }

        $event = Event::create($attr);

        toastr()->success('Event created successfully');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::withCount(['users'])->findOrFail($id);
        $users = $event->users()->latest()->paginate(10);
        return view('admin.events.show', compact('event', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $url = route('events.update', $event->id);
        return view('admin.events.form', compact('event', 'url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $attr = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $attr['slug'] = \Str::slug($attr['name']);

        if ($request->hasFile('image')) {
            if ($event->image) {
                MyHelper::instance()->deleteImage($event->image);
            }
            $image = $request->file('image');
            $image_path = MyHelper::instance()->uploadImage($image, 'events');
            $attr['image'] = $image_path;
        }

        $event->update($attr);

        toastr()->success('Event updated successfully');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        toastr()->success('Event deleted successfully');
        return redirect()->route('events.index');
    }

    public function survey($id)
    {
        $event = Event::findOrFail($id);
        $surveys = $event->surveys;
        // ->with('survey_user.answers')->get();
        $survey_user = $surveys->load('survey_user');
        // get all id survey_user
        $survey_user_id = $survey_user->pluck('id')->toArray();
        // return response()->json($survey_user);
        $all_surveys = Survey::latest()->get();
        return view('admin.events.survey', compact('event', 'surveys', 'all_surveys'));
    }

    // surveyField
    public function surveyField($event, $field)
    {
        $event = Event::findOrFail($event);
        $survey = $event->surveys->first();
        $survey_user = $survey->survey_user;
        $survey_user_id = $survey_user->pluck('id')->toArray();

        // get answer by field
        $field = SurveyField::findOrFail($field);
        // GET ANSWER
        $answers = $field->getAllAnswersAttribute($survey_user_id)->get();
        // return response()->json($answers);

        $most_common_answer = $field->mostAnswer;;
        // return response()->json($field);

        $select_answers = null;
        if ($field->type == "select") {
            $options = $field->getOptions;
            foreach ($options as $key => $value) {
                $select_answers[$key] =  $field->getAllAnswersAttribute($survey_user_id)->where('answer','like', $value.'%')->count();
            }
            // return response()->json($select_answers);
        }

        // rate chart
        $rate_answers = null;
        if ($field->type == "number") {
            $rate_answers = $answers->avg('answer');
            // return response()->json($rate_answers);
        }

        // $survey_user = $surveys->survey_user->load('answers');
        return view('admin.surveys.answer', compact('event', 'survey', 'answers', 'field', 'select_answers', 'rate_answers'));
    }

    public function surveyStore(Request $request)
    {
        $attr = request()->validate([
            'event_id' => 'required|exists:events,id',
            'survey_id' => 'required|exists:surveys,id',
        ]);
        
        $event = Event::findOrFail($attr['event_id']);
        $survey = Survey::findOrFail($attr['survey_id']);
        $event->surveys()->attach($survey);
        // dd($event);
        
        toastr()->success('Survey added successfully');
        return redirect()->route('events.surveys', $event->id);
    }

    public function surveyDestroy(Request $request)
    {
        $attr = request()->validate([
            'event_id' => 'required|exists:events,id',
            'survey_id' => 'required|exists:surveys,id',
        ]);

        $event = Event::findOrFail($attr['event_id']);
        $survey = Survey::findOrFail($attr['survey_id']);
        $event->surveys()->detach($survey);
        // dd($event);
        
        toastr()->success('Survey deleted successfully');
        return redirect()->route('events.surveys', $event->id);
    }
}
