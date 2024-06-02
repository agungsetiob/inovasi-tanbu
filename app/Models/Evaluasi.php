<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'link',
        'slug',
        'skpd_id',
        'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function skpd(){
        return $this->belongsTo(Skpd::class);
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->isoFormat('D MMMM Y');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->slug = Str::slug($model->judul, '-');
    //     });

    //     static::updating(function ($model) {
    //         $model->slug = Str::slug($model->judul, '-');
    //     });
    // }
}
