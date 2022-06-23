<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'publish',
        'image'
    ];

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

    public function event_users()
    {
        return $this->hasMany(EventUser::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class);
    }

    public function scopePublished()
    {
        return $this->where('publish', 1);
    }

    public function scopeNotJoined($user)
    {
        $join = $user->events()->pluck('event_id')->toArray();
        return $this->whereNotIn('id', $join);
    }

    public function sesi()
    {
        return $this->hasMany(Sesi::class);
    }
}
