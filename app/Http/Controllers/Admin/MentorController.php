<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentors = Mentor::latest()->paginate(10);
        return view('admin.mentors.index', compact('mentors'));
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
        $data = $request->all();
        // IMAGE
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = MyHelper::instance()->uploadImage($image, 'mentors');
            $data['image'] = $image_path;
        }

        Mentor::create($data);
        toastr()->success('Mentor created successfully.');
        return redirect()->route('mentors.index');
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
        $mentor = Mentor::findOrFail($id);
        $data = $request->all();
        // IMAGE
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = MyHelper::instance()->uploadImage($image, 'mentors');
            $data['image'] = $image_path;
        }
        $mentor->update($data);
        toastr()->success('Mentor updated successfully.');
        return redirect()->route('mentors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();
        toastr()->success('Mentor deleted successfully.');
        return redirect()->route('mentors.index');
    }
}
