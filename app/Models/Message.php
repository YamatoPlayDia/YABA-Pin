<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['writer_id', 'reader_id', 'himitsu', 'spot_id', 'status'];

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function reader()
    {
        return $this->belongsTo(User::class, 'reader_id');
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
