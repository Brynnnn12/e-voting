<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    /** @use HasFactory<\Database\Factories\KandidatFactory> */
    use HasFactory;
    protected $fillable = [
        'nama',
        'pemilihan_id',
        'visi',
        'misi',
        'foto',
    ];

    public function pemilihan()
    {
        return $this->belongsTo(Pemilihan::class);
    }

    public function votings()
    {
        return $this->hasMany(Voting::class);
    }
}
