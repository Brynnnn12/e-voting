<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    /** @use HasFactory<\Database\Factories\VotingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pemilihan_id',
        'kandidat_id',
        'waktu',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemilihan()
    {
        return $this->belongsTo(Pemilihan::class);
    }

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
