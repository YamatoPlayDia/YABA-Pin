<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footprint extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'rights_write', 'rights_read', 'lastlogin_latitude', 'lastlogin_longitude', 'latest_latitude', 'latest_longitude'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
