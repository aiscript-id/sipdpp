<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyField;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::withCount('fields')->latest()->paginate(10);
        return view('admin.surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = route('surveys.store');
        return view('admin.surveys.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attr['slug'] = \Str::slug($attr['name']);
        $attr['publish'] = $request->has('publish');

        $survey = Survey::create($attr);

        toastr()->success('Survey created successfully.');
        return redirect()->route('surveys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::withCount('fields')->findOrFail($id);
        return view('admin.surveys.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        $url = route('surveys.update', $survey->id);
        return view('admin.surveys.form', compact('survey', 'url'));
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
        $survey = Survey::findOrFail($id);
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $attr['slug'] = \Str::slug($attr['name']);

        $survey->update($attr);

        toastr()->success('Survey updated successfully.');
        return redirect()->route('surveys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        toastr()->success('Survey deleted successfully.');
        return redirect()->route('surveys.index');
    }

    public function fields($id)
    {
        $survey = Survey::findOrFail($id);
        $fields = $survey->fields;
        return view('admin.surveys.field', compact('survey', 'fields'));
    }

    // field
    public function field($field)
    {
        $field = SurveyField::findOrFail($field);

        $survey = $field->survey;
        $answers = $field->filledAnswers()->get();
        $most_common_answer = $field->mostAnswer;;
        // return response()->json($field);

        $select_answers = null;
        if ($field->type == "select") {
            $options = $field->getOptions;
            foreach ($options as $key => $value) {
                $select_answers[$key] =  $field->answers()->where('answer','like', $value.'%')->count();
            }
            // return response()->json($select_answers);
        }

        // rate chart
        $rate_answers = null;
        if ($field->type == "number") {
            $rate_answers = $field->answers->avg('answer');
            // return response()->json($rate_answers);
        }

        return view('admin.surveys.answer', compact('field', 'answers', 'most_common_answer', 'survey', 'select_answers', 'rate_answers'));
    }
    
}
