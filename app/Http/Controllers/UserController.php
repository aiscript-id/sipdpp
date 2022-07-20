<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // event not yet join
        $user = User::find(Auth::id());
        $join = $user->events()->pluck('event_id')->toArray();
        $events = Event::with('users')->published()->whereNotIn('id', $join)->latest()->paginate(10);
        return view('user.dashboard', compact('events'));
    }

    public function profile()
    {
        $user = auth()->user();
        $provinces = new WilayahController();
        $provinces = $provinces->provinces();

        $desa = \Indonesia::findVillage($user->desa_id, $with = ['district.city.province']);
        // return response()->json($desa);

        return view('user.profile', compact('user', 'provinces', 'desa'));
    }

    public function updateProfile(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'born_place' => 'required|string|max:255',
            'born_date' => 'required|date',
            'gender' => 'required|string',
            'job_status' => 'required|string',
            'institute' => 'required|string',
            'desa_id' => 'required',
            'address' => 'required|string|max:255'
        ]);
        // dd($attr);

        $user = User::find(Auth::user()->id);
        if ($user->verified_at == null) {
            $attr['verified_at'] = now();
        }
        $user->update($attr);

        toastr()->success('Profile updated successfully');
        return redirect()->route('user.profile');
    }

    public function updatePassword(Request $request)
    {
        $attr = $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // dd($attr);
        $user = User::find(Auth::user()->id);
        if (Hash::check($attr['old_password'], $user->password)) {
            $user->update(['password' => Hash::make($attr['password'])]);
            toastr()->success('Password updated successfully');
            return redirect()->route('user.profile');
        } else {
            toastr()->error('Old password is wrong');
            return redirect()->route('user.profile');
        }
    }

    public function updateAvatar(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $attr = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        // store avatar to storage and resize avatar
        $avatar = $request->file('avatar');
        $avatar_name = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('public/avatars', $avatar_name);
        $avatar_path = 'storage/avatars/' . $avatar_name;
        $avatar_resize = \Image::make($avatar_path)->resize(300, 300);
        $avatar_resize->save($avatar_path);
        // update avatar to database
        $user->update(['avatar' => $avatar_path]);
        toastr()->success('Avatar updated successfully');
        return redirect()->route('user.profile');
    }

    public function getJob()
    {
        $jobs = ['1' => 'Pelajar', '2' => 'Mahasiswa', '3' => 'Pensiunan', '4' => 'Pegawai Negeri', '5' => 'Pegawai Swasta', '6' => 'Wiraswasta', '7' => 'Lainnya'];
        return $jobs;
    }

    public function bantuan()
    {
        return view('user.bantuan');
    }


}
