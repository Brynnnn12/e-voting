<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    /** @use HasFactory<\Database\Factories\PemilihanFactory> */
    use HasFactory;

    const STATUS_AKTIF = 'aktif';
    const STATUS_NONAKTIF = 'nonaktif';
    const STATUS_SELESAI = 'selesai';

    protected $table = 'pemilihans';

    protected $fillable = [
        'nama',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'published_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'published_at' => 'datetime',
    ];

    // Scope untuk pemilihan yang aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk pemilihan yang sudah dipublikasi
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    // Cek apakah pemilihan sedang berlangsung
    public function isBerlangsung()
    {
        return $this->status === 'aktif' &&
            now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    // Cek apakah pemilihan sudah selesai
    public function isSelesai()
    {
        return now()->gt($this->tanggal_selesai);
    }

    // Cek apakah pemilihan belum dimulai
    public function isBelumDimulai()
    {
        return now()->lt($this->tanggal_mulai);
    }

    // Status display
    public function getStatusDisplayAttribute()
    {
        if ($this->status === 'nonaktif') {
            return 'Non Aktif';
        }

        if ($this->isBelumDimulai()) {
            return 'Belum Dimulai';
        }

        if ($this->isBerlangsung()) {
            return 'Sedang Berlangsung';
        }

        if ($this->isSelesai()) {
            return 'Selesai';
        }

        return ucfirst($this->status);
    }

    // Cek apakah sudah dipublikasikan
    public function isPublished(): bool
    {
        return !is_null($this->published_at) && $this->published_at <= now();
    }

    public function kandidats()
    {
        return $this->hasMany(Kandidat::class);
    }

    public function votings()
    {
        return $this->hasMany(Voting::class);
    }
}
