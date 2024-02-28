<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset extends Model
{
    use HasFactory;

    public function skpd(){
        return $this->belongsTo(Skpd::class);
    }
    protected $guarded = [];
}
