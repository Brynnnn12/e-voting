<section class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        @if ($pemilihanAktif)
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $pemilihanAktif->nama }}</h1>
            <p class="text-xl mb-8">
                {{ $pemilihanAktif->deskripsi ?? 'Gunakan hak pilih Anda untuk menentukan masa depan organisasi kita' }}
            </p>

            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 max-w-2xl mx-auto" x-data="{ days: 0, hours: 0, minutes: 0, seconds: 0, isExpired: false }"
                x-init="const updateCountdown = () => {
                    const targetDate = new Date('{{ $pemilihanAktif->tanggal_selesai->toISOString() }}').getTime();
                    const now = new Date().getTime();
                    const distance = targetDate - now;
                
                    if (distance < 0) {
                        isExpired = true;
                        days = hours = minutes = seconds = 0;
                    } else {
                        isExpired = false;
                        days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    }
                };
                
                updateCountdown();
                setInterval(updateCountdown, 1000);">

                <div x-show="!isExpired">
                    <h2 class="text-2xl font-semibold mb-4">Waktu Pemilihan Berakhir:</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white bg-opacity-30 rounded-lg p-3">
                            <span x-text="days" class="text-3xl font-bold block"></span>
                            <p class="text-sm">Hari</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-lg p-3">
                            <span x-text="hours" class="text-3xl font-bold block"></span>
                            <p class="text-sm">Jam</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-lg p-3">
                            <span x-text="minutes" class="text-3xl font-bold block"></span>
                            <p class="text-sm">Menit</p>
                        </div>
                        <div class="bg-white bg-opacity-30 rounded-lg p-3">
                            <span x-text="seconds" class="text-3xl font-bold block"></span>
                            <p class="text-sm">Detik</p>
                        </div>
                    </div>

                    <div class="mt-4 text-sm opacity-90">
                        <p>Dimulai: {{ $pemilihanAktif->tanggal_mulai->format('d M Y, H:i') }} WIB</p>
                        <p>Berakhir: {{ $pemilihanAktif->tanggal_selesai->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>

                <div x-show="isExpired" class="text-center">
                    <i class="fas fa-clock fa-3x mb-4 opacity-75"></i>
                    <h2 class="text-2xl font-semibold mb-2">Pemilihan Telah Berakhir</h2>
                    <p class="opacity-90">Terima kasih atas partisipasi Anda</p>
                </div>
            </div>

            <div class="mt-8">
                @auth
                    @if ($hasVoted)
                        <div
                            class="inline-flex items-center bg-green-500 text-white px-8 py-3 rounded-lg font-bold text-lg">
                            <i class="fas fa-check-circle mr-2"></i>
                            Anda Sudah Voting
                        </div>
                    @else
                        <a href="{{ route('voting.index') }}"
                            class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg hover:shadow-xl">
                            <i class="fas fa-vote-yea mr-2"></i>
                            Vote Sekarang
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg hover:shadow-xl">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login untuk Vote
                    </a>
                @endauth
            </div>
        @else
            <!-- Tidak ada pemilihan aktif -->
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Informasi Voting</h1>
            <p class="text-xl mb-8">Saat ini tidak ada pemilihan yang sedang berlangsung</p>

            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 max-w-2xl mx-auto">
                <i class="fas fa-calendar-times fa-3x mb-4 opacity-75"></i>
                <h2 class="text-2xl font-semibold mb-2">Tidak Ada Pemilihan Aktif</h2>
                <p class="opacity-90">Silakan tunggu pengumuman pemilihan selanjutnya</p>
            </div>

            @if ($nextPemilihan)
                <div class="mt-6 bg-white bg-opacity-10 rounded-lg p-4 max-w-md mx-auto">
                    <h3 class="font-semibold mb-2">Pemilihan Mendatang:</h3>
                    <p class="text-lg">{{ $nextPemilihan->nama }}</p>
                    <p class="text-sm opacity-90">Mulai: {{ $nextPemilihan->tanggal_mulai->format('d M Y, H:i') }} WIB
                    </p>
                </div>
            @endif
        @endif
    </div>
</section>
