<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sudah Voting
            </h2>
            <a href="/" class="text-gray-600 hover:text-blue-600 text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </x-slot>

    <!-- Custom CSS for FontAwesome -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <div class="py-8 bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="max-w-4xl w-full">
                    <!-- Already Voted Card -->
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-blue-100"
                        x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 100)">

                        <!-- Header -->
                        <div
                            class="bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 text-white p-12 text-center relative overflow-hidden">
                            <!-- Background decoration -->
                            <div class="absolute inset-0 opacity-10">
                                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
                                <div class="absolute bottom-10 right-10 w-24 h-24 bg-white rounded-full"></div>
                                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full"></div>
                            </div>

                            <div class="relative z-10" x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0 transform scale-75 -translate-y-8"
                                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0" x-show="animate">
                                <div class="mb-6">
                                    <div
                                        class="inline-flex items-center justify-center w-28 h-28 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/30">
                                        <i class="fas fa-user-check text-5xl"></i>
                                    </div>
                                </div>
                                <h1 class="text-4xl font-bold mb-4 tracking-wide">SUARA ANDA SUDAH TERCATAT</h1>
                                <p class="text-xl text-blue-100 font-medium max-w-2xl mx-auto leading-relaxed">
                                    Terima kasih atas partisipasi aktif Anda dalam
                                    <span class="font-bold text-white">{{ $pemilihanAktif->nama }}</span>
                                </p>
                                <div class="mt-6 flex justify-center">
                                    <div
                                        class="bg-green-500/90 backdrop-blur-sm px-6 py-2 rounded-full border border-green-400">
                                        <span class="text-sm font-bold flex items-center">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            STATUS: SUDAH VOTING
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-10">
                            <div class="text-center mb-10">
                                <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center justify-center">
                                    <i class="fas fa-vote-yea text-blue-600 mr-3"></i>
                                    Rekap Pilihan Anda
                                </h2>

                                <!-- Kandidat yang dipilih -->
                                <div
                                    class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-8 mb-8 relative overflow-hidden">
                                    <!-- Decorative elements -->
                                    <div class="absolute top-4 right-4 w-12 h-12 bg-green-200/50 rounded-full"></div>
                                    <div class="absolute bottom-4 left-4 w-8 h-8 bg-green-200/50 rounded-full"></div>

                                    <div
                                        class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-8 relative z-10">
                                        <div class="relative">
                                            <img src="{{ $userVote->kandidat->foto ? asset('storage/' . $userVote->kandidat->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($userVote->kandidat->nama) . '&size=120&background=10B981&color=ffffff' }}"
                                                alt="Kandidat {{ $userVote->kandidat->nama }}"
                                                class="w-32 h-32 rounded-full border-4 border-green-300 object-cover shadow-xl ring-4 ring-green-100">
                                            <div
                                                class="absolute -bottom-2 -right-2 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <p class="text-sm text-green-600 mb-2 font-medium tracking-wide uppercase">
                                                Pilihan Anda:</p>
                                            <h3 class="text-3xl font-bold text-green-800 mb-2">
                                                {{ $userVote->kandidat->nama }}</h3>
                                            <p class="text-green-600 font-medium">Kandidat {{ $pemilihanAktif->nama }}
                                            </p>
                                            <div
                                                class="mt-4 inline-flex items-center bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                                                <i class="fas fa-thumbs-up mr-2"></i>
                                                PILIHAN TERDAFTAR
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vote Details -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-clock text-white"></i>
                                            </div>
                                            <div class="text-blue-600 font-semibold">Waktu Voting</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">
                                            {{ $userVote->created_at->format('d M Y') }}</div>
                                        <div class="text-gray-600 text-sm">{{ $userVote->created_at->format('H:i') }}
                                            WIB</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-check-circle text-white"></i>
                                            </div>
                                            <div class="text-green-600 font-semibold">Status Voting</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">Terkonfirmasi</div>
                                        <div class="text-gray-600 text-sm">Suara tersimpan</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-shield-check text-white"></i>
                                            </div>
                                            <div class="text-purple-600 font-semibold">Keamanan</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">Terenkripsi</div>
                                        <div class="text-gray-600 text-sm">Data aman</div>
                                    </div>
                                </div>

                                <!-- Countdown untuk hasil -->
                                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-2xl p-8 mb-8"
                                    x-data="{ days: 0, hours: 0, minutes: 0, seconds: 0, isExpired: false }" x-init="const updateCountdown = () => {
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
                                        <h3
                                            class="text-2xl font-bold text-indigo-700 mb-6 flex items-center justify-center">
                                            <i class="fas fa-trophy mr-3"></i>
                                            Hasil akan diumumkan dalam
                                        </h3>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                            <div class="bg-indigo-600 text-white rounded-xl p-6 text-center">
                                                <span x-text="days" class="text-4xl font-bold block mb-2"></span>
                                                <p class="text-sm font-medium opacity-90">HARI</p>
                                            </div>
                                            <div class="bg-indigo-600 text-white rounded-xl p-6 text-center">
                                                <span x-text="hours" class="text-4xl font-bold block mb-2"></span>
                                                <p class="text-sm font-medium opacity-90">JAM</p>
                                            </div>
                                            <div class="bg-indigo-600 text-white rounded-xl p-6 text-center">
                                                <span x-text="minutes" class="text-4xl font-bold block mb-2"></span>
                                                <p class="text-sm font-medium opacity-90">MENIT</p>
                                            </div>
                                            <div class="bg-indigo-600 text-white rounded-xl p-6 text-center">
                                                <span x-text="seconds" class="text-4xl font-bold block mb-2"></span>
                                                <p class="text-sm font-medium opacity-90">DETIK</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="isExpired" class="text-center">
                                        <div class="bg-yellow-100 rounded-2xl p-8 border border-yellow-300">
                                            <i class="fas fa-trophy text-yellow-500 text-5xl mb-6"></i>
                                            <h3 class="text-2xl font-bold text-yellow-700 mb-4">Voting Telah Berakhir
                                            </h3>
                                            <p class="text-yellow-600 text-lg">Hasil sedang dalam proses perhitungan
                                                dan akan segera diumumkan</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Information -->
                                <div
                                    class="bg-gradient-to-r from-teal-50 to-cyan-50 border-2 border-teal-200 rounded-2xl p-8 mb-8">
                                    <div class="flex items-start">
                                        <div
                                            class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                            <i class="fas fa-info-circle text-teal-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-teal-800 mb-4 text-xl">Informasi Partisipasi
                                                Anda:</h4>
                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-check-circle text-teal-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-teal-700 font-medium">Anda telah
                                                            berpartisipasi dalam {{ $pemilihanAktif->nama }}</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-lock text-teal-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-teal-700 font-medium">Pilihan Anda tidak
                                                            dapat diubah lagi</span>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-chart-line text-teal-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-teal-700 font-medium">Pantau website untuk
                                                            pengumuman hasil</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-medal text-teal-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-teal-700 font-medium">Suara Anda
                                                            berkontribusi untuk perubahan</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6 p-4 bg-teal-100 rounded-xl border border-teal-300">
                                                <p class="text-teal-800 font-semibold text-center">
                                                    <i class="fas fa-heart text-red-500 mr-2"></i>
                                                    Terima Kasih Telah Menjadi Bagian dari Perubahan Positif!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="text-center space-y-6">
                                <div
                                    class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-md mx-auto">
                                    <a href="/"
                                        class="flex-1 w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-home mr-3"></i>Kembali ke Beranda
                                    </a>

                                    <button onclick="shareParticipation()"
                                        class="flex-1 w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-share-alt mr-3"></i>Bagikan
                                    </button>
                                </div>

                                <div class="flex justify-center space-x-6 text-sm">
                                    <button onclick="checkResults()"
                                        class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium">
                                        <i class="fas fa-chart-bar mr-2"></i>Cek Hasil (Segera)
                                    </button>
                                    <button onclick="downloadParticipationCert()"
                                        class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
                                        <i class="fas fa-certificate mr-2"></i>Sertifikat Partisipasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center mt-10 space-y-4">
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-handshake text-green-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Terima Kasih Atas Partisipasi Anda!
                                </h3>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Dengan memberikan suara, Anda telah berkontribusi dalam proses demokrasi dan
                                membantu menentukan arah masa depan yang lebih baik.
                            </p>
                            <div
                                class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4 border border-blue-200">
                                <p class="text-blue-800 font-medium">
                                    <i class="fas fa-quote-left mr-2"></i>
                                    "Demokrasi adalah pemerintahan dari rakyat, oleh rakyat, dan untuk rakyat"
                                    <i class="fas fa-quote-right ml-2"></i>
                                </p>
                                <p class="text-blue-600 text-sm mt-2">- Abraham Lincoln</p>
                            </div>
                        </div>

                        <div class="text-gray-400 text-xs">
                            <p>© {{ date('Y') }} Sistem Voting Online. Hak suara Anda terlindungi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
        <script>
            function shareParticipation() {
                if (navigator.share) {
                    navigator.share({
                        title: 'Saya telah berpartisipasi dalam voting!',
                        text: 'Saya telah memberikan suara dalam {{ $pemilihanAktif->nama }}. Mari berpartisipasi dalam demokrasi!',
                        url: window.location.origin
                    });
                } else {
                    const text =
                        `Saya telah berpartisipasi dalam {{ $pemilihanAktif->nama }}! Mari berpartisipasi dalam demokrasi! ${window.location.origin}`;
                    navigator.clipboard.writeText(text).then(() => {
                        alert('Link berhasil disalin ke clipboard!');
                    });
                }
            }

            function checkResults() {
                alert(
                    'Hasil voting akan diumumkan setelah periode voting berakhir. Pantau terus website ini untuk update terbaru!');
            }

            function downloadParticipationCert() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 800;
                canvas.height = 600;

                // Background
                const gradient = ctx.createLinearGradient(0, 0, 800, 600);
                gradient.addColorStop(0, '#059669');
                gradient.addColorStop(1, '#047857');
                ctx.fillStyle = gradient;
                ctx.fillRect(0, 0, 800, 600);

                // Certificate content
                ctx.fillStyle = 'white';
                ctx.font = 'bold 36px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('SERTIFIKAT PARTISIPASI', 400, 150);

                ctx.font = '24px Arial';
                ctx.fillText('{{ $pemilihanAktif->nama }}', 400, 250);

                ctx.font = '18px Arial';
                ctx.fillText('Diberikan kepada:', 400, 320);

                ctx.font = 'bold 28px Arial';
                ctx.fillText('{{ auth()->user()->name }}', 400, 370);

                ctx.font = '16px Arial';
                ctx.fillText('Telah berpartisipasi aktif dalam proses voting demokratis', 400, 420);
                ctx.fillText('pada {{ $userVote->created_at->format('d F Y') }}', 400, 450);

                // Download
                const link = document.createElement('a');
                link.download = 'sertifikat-partisipasi-voting.png';
                link.href = canvas.toDataURL();
                link.click();
            }
        </script>
    @endpush
</x-app-layout>
