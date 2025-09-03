<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Models\Kandidat;
use App\Models\Pemilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = now();

        // Ambil pemilihan yang aktif
        $pemilihanAktif = Pemilihan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->where('status', 'aktif')
            ->first();

        if (!$pemilihanAktif) {
            return redirect('/')->with('error', 'Tidak ada pemilihan yang sedang berlangsung saat ini.');
        }

        // Cek apakah user sudah voting
        $hasVoted = Voting::where('user_id', Auth::id())
            ->where('pemilihan_id', $pemilihanAktif->id)
            ->exists();

        if ($hasVoted) {
            $userVote = Voting::where('user_id', Auth::id())
                ->where('pemilihan_id', $pemilihanAktif->id)
                ->with('kandidat')
                ->first();

            return view('voting.already-voted', compact('pemilihanAktif', 'userVote'));
        }

        // Ambil kandidat untuk pemilihan aktif
        $kandidats = Kandidat::where('pemilihan_id', $pemilihanAktif->id)
            ->orderBy('id')
            ->get();

        return view('voting.index', compact('pemilihanAktif', 'kandidats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kandidat_id' => 'required|exists:kandidats,id',
        ]);

        $now = now();

        // Ambil pemilihan yang aktif
        $pemilihanAktif = Pemilihan::where('tanggal_mulai', '<=', $now)
            ->where('tanggal_selesai', '>=', $now)
            ->where('status', 'aktif')
            ->first();

        if (!$pemilihanAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pemilihan yang sedang berlangsung.'
            ]);
        }

        // Cek apakah kandidat benar untuk pemilihan ini
        $kandidat = Kandidat::where('id', $request->kandidat_id)
            ->where('pemilihan_id', $pemilihanAktif->id)
            ->first();

        if (!$kandidat) {
            return response()->json([
                'success' => false,
                'message' => 'Kandidat tidak valid untuk pemilihan ini.'
            ]);
        }

        // Cek apakah user sudah voting
        $hasVoted = Voting::where('user_id', Auth::id())
            ->where('pemilihan_id', $pemilihanAktif->id)
            ->exists();

        if ($hasVoted) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan voting untuk pemilihan ini.'
            ]);
        }

        try {
            DB::beginTransaction();

            // Simpan vote
            Voting::create([
                'user_id' => Auth::id(),
                'kandidat_id' => $request->kandidat_id,
                'pemilihan_id' => $pemilihanAktif->id,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vote berhasil disimpan!',
                'redirect' => route('voting.success')
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan vote.'
            ]);
        }
    }

    /**
     * Show success page after voting
     */
    public function success()
    {
        $userVote = Voting::where('user_id', Auth::id())
            ->with(['kandidat', 'pemilihan'])
            ->latest()
            ->first();

        if (!$userVote) {
            return redirect('/')->with('error', 'Data vote tidak ditemukan.');
        }

        return view('voting.success', compact('userVote'));
    }
}
