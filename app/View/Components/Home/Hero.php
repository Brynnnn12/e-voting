<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Pemilihan;
use App\Models\Voting;
use Illuminate\Support\Facades\Auth;

class Hero extends Component
{
    public $pemilihanAktif;
    public $hasVoted;
    public $nextPemilihan;

    public function __construct()
    {
        $now = now();

        // Ambil pemilihan yang aktif
        $this->pemilihanAktif = Pemilihan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->where('status', 'aktif')
            ->first();

        // Cek apakah user sudah vote (jika login)
        $this->hasVoted = false;
        if (Auth::check() && $this->pemilihanAktif) {
            $this->hasVoted = Voting::where('user_id', Auth::id())
                ->where('pemilihan_id', $this->pemilihanAktif->id)
                ->exists();
        }

        // Ambil pemilihan mendatang jika tidak ada yang aktif
        $this->nextPemilihan = null;
        if (!$this->pemilihanAktif) {
            $this->nextPemilihan = Pemilihan::where('tanggal_mulai', '>', $now)
                ->where('status', 'aktif')
                ->orderBy('tanggal_mulai')
                ->first();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.home.hero');
    }
}
