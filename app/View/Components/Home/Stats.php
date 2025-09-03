<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Pemilihan;
use App\Models\Kandidat;
use App\Models\Voting;
use App\Models\User;

class Stats extends Component
{
    public $stats;

    public function __construct()
    {
        $now = now();

        // Ambil pemilihan aktif
        $pemilihanAktif = Pemilihan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->where('status', 'aktif')
            ->first();

        $this->stats = [
            'total_pemilihan' => Pemilihan::count(),
            'pemilihan_aktif' => Pemilihan::where('status', 'aktif')
                ->where('tanggal_mulai', '<=', $now)
                ->where('tanggal_selesai', '>=', $now)
                ->count(),
            'total_kandidat' => Kandidat::count(),
            'kandidat_aktif' => $pemilihanAktif
                ? Kandidat::where('pemilihan_id', $pemilihanAktif->id)->count()
                : 0,
            'total_voters' => User::role('user')->count(), // Menggunakan Spatie Permission
            'total_votes' => Voting::count(),
            'votes_today' => Voting::whereDate('waktu', today())->count(),
            'votes_aktif' => $pemilihanAktif
                ? Voting::where('pemilihan_id', $pemilihanAktif->id)->count()
                : 0,
            'participation_rate' => $this->calculateParticipationRate($pemilihanAktif),
        ];
    }

    private function calculateParticipationRate($pemilihanAktif)
    {
        if (!$pemilihanAktif) return 0;

        $totalUsers = User::role('user')->count(); // Menggunakan Spatie Permission
        $totalVotes = Voting::where('pemilihan_id', $pemilihanAktif->id)->count();

        return $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;
    }

    public function render(): View|Closure|string
    {
        return view('components.home.stats');
    }
}
