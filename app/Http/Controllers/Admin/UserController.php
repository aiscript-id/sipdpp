<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('user')->latest()->paginate(10);
        return view('admin.users.index', compact('users', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = route('users.store');
        return view('admin.users.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'born_place' => 'nullable|string|max:255',
            'born_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'institute' => 'nullable|string|max:255',
        ]);
        
        $attr['password'] = Hash::make($attr['password']);
        // dd($attr);
        $user = User::create($attr);
        $user->assignRole('user');

        toastr()->success('User created successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $url = route('users.update', $user->id);
        return view('admin.users.form', compact('user', 'url'));
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
        $user = User::findOrFail($id);
        $attr = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'born_place' => 'nullable|string|max:255',
            'born_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'institute' => 'nullable|string|max:255',
        ]);

        if ($request->password != null) {
            $attr['password'] = Hash::make($attr['password']);
        } else {
            unset($attr['password']);
        }

        $user->update($attr);

        toastr()->success('User updated successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toastr()->success('User deleted successfully');
        return redirect()->route('users.index');
    }
}
