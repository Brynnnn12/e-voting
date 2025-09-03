<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Kandidat as KandidatModel;
use App\Models\Pemilihan;
use App\Models\Voting;
use Illuminate\Support\Facades\Auth;

class Kandidat extends Component
{
    public $kandidats;
    public $pemilihanAktif;
    public $hasVoted;

    public function __construct()
    {
        $now = now();

        // Ambil pemilihan aktif
        $this->pemilihanAktif = Pemilihan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->where('status', 'aktif')
            ->first();

        // Ambil kandidat dari pemilihan aktif
        $this->kandidats = KandidatModel::whereHas('pemilihan', function ($query) use ($now) {
            $query->where('tanggal_mulai', '<=', $now)
                ->where('tanggal_selesai', '>=', $now)
                ->where('status', 'aktif');
        })->limit(3)->get();

        // Cek apakah user sudah vote (jika login)
        $this->hasVoted = false;
        if (Auth::check() && $this->pemilihanAktif) {
            $this->hasVoted = Voting::where('user_id', Auth::id())
                ->where('pemilihan_id', $this->pemilihanAktif->id)
                ->exists();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.home.kandidat');
    }
}
