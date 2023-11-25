<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->isoFormat('D MMMM Y');
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function proposals(){
        return $this->belongsToMany(Proposal::class);
    }
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    public function buktis(){
        return $this->hasMany(Bukti::class);
    }

    protected $guarded = [];
}
