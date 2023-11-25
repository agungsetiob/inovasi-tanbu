<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }
    public function bukti()
    {
        return $this->belongsTo(Bukti::class);
    }
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->isoFormat('D MMMM Y');
    }
    protected $fillable = [
        'informasi',
        'file',
        'user_id',
        'proposal_id',
        'indikator_id',
        'bukti_id',

    ];
}
