<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    public function indikators()
    {
        return $this->belongsToMany(Indikator::class);
    }

    protected $guarded = [];
    
}
