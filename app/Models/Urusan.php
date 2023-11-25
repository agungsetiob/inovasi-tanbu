<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    use HasFactory;
    public function proposals()
    {
        return $this->belongsToMany(Proposal::class);
    }

    public function tematik()
    {
        return $this->belongsTo(Tematik::class);
    }
    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->isoFormat('D MMMM Y');
    }

    protected $guarded = [];
}
