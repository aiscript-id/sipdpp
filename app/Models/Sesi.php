<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;
    protected $table = 'sesi';
    protected $guarded = [];

    public function getGetDateAttribute()
    {
        // carbon date to d-m-Y
        return $this->date ? Carbon::parse($this->date)->format('d M Y') : null;
    }

    public function getGetTimeAttribute()
    {
        // carbon date to H:i
        $start = $this->start_time ? Carbon::parse($this->start_time)->format('H:i') : null;
        $end = $this->end_time ? Carbon::parse($this->end_time)->format('H:i') : null;

        return $start . ' - ' . $end;
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getColorTypeAttribute()
    {
        $color = ['primary', 'warning', 'danger'];
        $type = ['materi', 'video', 'tugas'];
        $index = array_search($this->type, $type);
        return $color[$index];
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'sesi_id', 'id');
    }

    public function MyTugas($user_id = null)
    {
        $tugas = $this->nilai()->where('user_id', $user_id ?? auth()->user()->id);
        return $tugas->count() == 0 ? null : $tugas->first();
        // return $tugas;
    }
}
