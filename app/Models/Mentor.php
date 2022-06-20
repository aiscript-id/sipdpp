<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getGetImageAttribute()
    {
        // check image is exist or not
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        } else {
            return 'https://ui-avatars.com/api/?background=46c35f&color=fff&name=' . $this->name;
        }
    }
}
