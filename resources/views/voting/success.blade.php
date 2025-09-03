<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Voting Berhasil
        </h2>
    </x-slot>

    <!-- Custom CSS for FontAwesome -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <div class="py-8 bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="max-w-4xl w-full">
                    <!-- Success Card -->
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-green-100 print-area"
                        x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 100)">

                        <!-- Header dengan animasi -->
                        <div
                            class="bg-gradient-to-br from-green-500 via-green-600 to-emerald-600 text-white p-12 text-center relative overflow-hidden">
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
                                        class="inline-flex items-center justify-center w-28 h-28 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/30 animate-pulse">
                                        <i class="fas fa-check-circle text-5xl animate-bounce"></i>
                                    </div>
                                </div>
                                <h1 class="text-4xl font-bold mb-4 tracking-wide">VOTING BERHASIL!</h1>
                                <p class="text-xl text-green-100 font-medium max-w-2xl mx-auto leading-relaxed">
                                    Terima kasih atas partisipasi Anda dalam
                                    <span class="font-bold text-white">{{ $userVote->pemilihan->nama }}</span>
                                </p>
                                <div class="mt-6 flex justify-center">
                                    <div
                                        class="bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full border border-white/30">
                                        <span class="text-sm font-medium">Suara Anda Telah Tercatat Secara
                                            Permanen</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-10">
                            <!-- Vote Confirmation -->
                            <div class="text-center mb-10">
                                <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center justify-center">
                                    <i class="fas fa-shield-check text-green-600 mr-3"></i>
                                    Konfirmasi Pilihan Anda
                                </h2>

                                <!-- Kandidat yang dipilih -->
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-8 mb-8 relative overflow-hidden">
                                    <!-- Decorative elements -->
                                    <div class="absolute top-4 right-4 w-12 h-12 bg-blue-200/50 rounded-full"></div>
                                    <div class="absolute bottom-4 left-4 w-8 h-8 bg-blue-200/50 rounded-full"></div>

                                    <div
                                        class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-8 relative z-10">
                                        <div class="relative">
                                            <img src="{{ $userVote->kandidat->foto ? asset('storage/' . $userVote->kandidat->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($userVote->kandidat->nama) . '&size=120&background=3B82F6&color=ffffff' }}"
                                                alt="Kandidat {{ $userVote->kandidat->nama }}"
                                                class="w-32 h-32 rounded-full border-4 border-blue-300 object-cover shadow-xl ring-4 ring-blue-100">
                                            <div
                                                class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                                                <i class="fas fa-check text-white text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <p class="text-sm text-blue-600 mb-2 font-medium tracking-wide uppercase">
                                                Pilihan Anda:</p>
                                            <h3 class="text-3xl font-bold text-blue-800 mb-2">
                                                {{ $userVote->kandidat->nama }}</h3>
                                            <p class="text-blue-600 font-medium">Kandidat
                                                {{ $userVote->pemilihan->nama }}</p>
                                            <div
                                                class="mt-4 inline-flex items-center bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                TERPILIH
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vote Details -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                    <div
                                        class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-clock text-white"></i>
                                            </div>
                                            <div class="text-purple-600 font-semibold">Waktu Voting</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">
                                            {{ $userVote->created_at->format('d M Y') }}</div>
                                        <div class="text-gray-600 text-sm">{{ $userVote->created_at->format('H:i') }}
                                            WIB</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-vote-yea text-white"></i>
                                            </div>
                                            <div class="text-blue-600 font-semibold">Jenis Pemilihan</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">{{ $userVote->pemilihan->nama }}
                                        </div>
                                        <div class="text-gray-600 text-sm">Sistem Voting Online</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user-check text-white"></i>
                                            </div>
                                            <div class="text-green-600 font-semibold">Status</div>
                                        </div>
                                        <div class="text-gray-800 font-bold text-lg">Berhasil</div>
                                        <div class="text-gray-600 text-sm">Suara tercatat</div>
                                    </div>
                                </div>

                                <!-- Important Information -->
                                <div
                                    class="bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-200 rounded-2xl p-8 mb-8">
                                    <div class="flex items-start">
                                        <div
                                            class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                            <i class="fas fa-shield-check text-amber-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-amber-800 mb-4 text-xl">Informasi Keamanan Voting:
                                            </h4>
                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-check-circle text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-amber-700 font-medium">Vote Anda telah
                                                            terenkripsi dan tersimpan aman</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-lock text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-amber-700 font-medium">Pilihan tidak dapat
                                                            diubah atau dibatalkan</span>
                                                    </div>
                                                </div>
                                                <div class="space-y-3">
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-chart-bar text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-amber-700 font-medium">Hasil akan diumumkan
                                                            setelah voting selesai</span>
                                                    </div>
                                                    <div class="flex items-start">
                                                        <i
                                                            class="fas fa-certificate text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                                        <span class="text-amber-700 font-medium">Halaman ini adalah
                                                            bukti sah partisipasi Anda</span>
                                                    </div>
                                                </div>
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
                                        class="flex-1 w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl no-print">
                                        <i class="fas fa-home mr-3"></i>Kembali ke Beranda
                                    </a>

                                    <button onclick="window.print()"
                                        class="flex-1 w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-gray-600 to-gray-700 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl no-print">
                                        <i class="fas fa-print mr-3"></i>Cetak Bukti
                                    </button>
                                </div>

                                <div class="text-center space-y-2 no-print">
                                    <p class="text-gray-500 text-sm">atau bagikan pencapaian Anda</p>
                                    <div class="flex justify-center space-x-4">
                                        <button onclick="shareVoting()"
                                            class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            <i class="fas fa-share-alt mr-2"></i>Bagikan
                                        </button>
                                        <button onclick="downloadCertificate()"
                                            class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium">
                                            <i class="fas fa-download mr-2"></i>Unduh Sertifikat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center mt-10 space-y-4">
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-info-circle text-blue-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Bantuan & Dukungan</h3>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Jika Anda memiliki pertanyaan atau mengalami masalah terkait proses voting,
                                jangan ragu untuk menghubungi tim dukungan kami.
                            </p>
                            <div
                                class="flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-6 text-sm">
                                <a href="mailto:support@voting.com"
                                    class="flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                    <i class="fas fa-envelope mr-2"></i>support@voting.com
                                </a>
                                <a href="tel:+6281234567890"
                                    class="flex items-center text-green-600 hover:text-green-700 font-medium">
                                    <i class="fas fa-phone mr-2"></i>+62 812-3456-7890
                                </a>
                                <span class="flex items-center text-purple-600 font-medium">
                                    <i class="fas fa-clock mr-2"></i>24/7 Support
                                </span>
                            </div>
                        </div>

                        <div class="text-gray-400 text-xs">
                            <p>© {{ date('Y') }} Sistem Voting Online. Semua hak cipta dilindungi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                .print-area,
                .print-area * {
                    visibility: visible;
                }

                .print-area {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                .no-print {
                    display: none !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
        <script>
            // Auto scroll to top
            window.scrollTo(0, 0);

            // Prevent back button after successful vote
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            window.onpopstate = function() {
                window.location.href = '/';
            };

            // Share voting function
            function shareVoting() {
                if (navigator.share) {
                    navigator.share({
                        title: 'Saya telah berpartisipasi dalam voting!',
                        text: 'Saya baru saja memberikan suara dalam {{ $userVote->pemilihan->nama }}. Mari berpartisipasi dalam demokrasi!',
                        url: window.location.origin
                    });
                } else {
                    // Fallback for browsers that don't support Web Share API
                    const text =
                        `Saya telah berpartisipasi dalam {{ $userVote->pemilihan->nama }}! Mari berpartisipasi dalam demokrasi! ${window.location.origin}`;
                    navigator.clipboard.writeText(text).then(() => {
                        alert('Link berhasil disalin ke clipboard!');
                    });
                }
            }

            // Download certificate function
            function downloadCertificate() {
                // Create a simple certificate
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 800;
                canvas.height = 600;

                // Background
                const gradient = ctx.createLinearGradient(0, 0, 800, 600);
                gradient.addColorStop(0, '#3B82F6');
                gradient.addColorStop(1, '#1E40AF');
                ctx.fillStyle = gradient;
                ctx.fillRect(0, 0, 800, 600);

                // Certificate content
                ctx.fillStyle = 'white';
                ctx.font = 'bold 36px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('SERTIFIKAT PARTISIPASI', 400, 150);

                ctx.font = '24px Arial';
                ctx.fillText('{{ $userVote->pemilihan->nama }}', 400, 250);

                ctx.font = '18px Arial';
                ctx.fillText('Diberikan kepada:', 400, 320);

                ctx.font = 'bold 28px Arial';
                ctx.fillText('{{ auth()->user()->name }}', 400, 370);

                ctx.font = '16px Arial';
                ctx.fillText('Telah berpartisipasi dalam proses voting demokratis', 400, 420);
                ctx.fillText('pada {{ $userVote->created_at->format('d F Y') }}', 400, 450);

                // Download
                const link = document.createElement('a');
                link.download = 'sertifikat-voting.png';
                link.href = canvas.toDataURL();
                link.click();
            }

            // Show success animation
            document.addEventListener('DOMContentLoaded', function() {
                // Add confetti effect if library is available
                if (typeof confetti !== 'undefined') {
                    confetti({
                        particleCount: 100,
                        spread: 70,
                        origin: {
                            y: 0.6
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
