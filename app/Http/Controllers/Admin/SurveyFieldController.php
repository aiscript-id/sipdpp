<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyField;
use Illuminate\Http\Request;

class SurveyFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $attr = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'survey_id' => 'required|integer',
            'options' => 'nullable|string',
        ]);

        $survey_field = SurveyField::create($attr);

        toastr()->success('Survey field created successfully.');
        return redirect()->route('surveys.fields', $survey_field->survey_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $attr = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'survey_id' => 'required|integer',
            'options' => 'nullable|string',
        ]);

        $survey_field = SurveyField::findOrFail($id);
        $survey_field->update($attr);

        toastr()->success('Survey field updated successfully.');
        return redirect()->route('surveys.fields', $survey_field->survey_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field = SurveyField::findOrFail($id);
        $field->delete();
        toastr()->success('Field deleted successfully.');
        return redirect()->back();
    }
}
