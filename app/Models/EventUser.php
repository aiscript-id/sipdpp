<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;
    protected $table = 'event_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class)
            ->where('user_id', $this->user_id)
            ->where('event_id', $this->event_id);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
