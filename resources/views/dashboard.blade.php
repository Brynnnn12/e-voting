<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                {{ __('Dashboard User') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fas fa-clock"></i>
                <span id="current-time"></span>
            </div>
        </div>
    </x-slot>

    <!-- Custom CSS for FontAwesome and Animations -->
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            .float-animation {
                animation: float 3s ease-in-out infinite;
            }

            .pulse-animation {
                animation: pulse 2s ease-in-out infinite;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
        </style>
    @endpush

    <div class="py-8 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-3xl shadow-2xl overflow-hidden mb-8"
                x-data="{ animate: false }" x-init="setTimeout(() => animate = true, 100)">
                <div class="relative p-8 md:p-12">
                    <!-- Background decorations -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-10 right-10 w-32 h-32 bg-white rounded-full float-animation"></div>
                        <div class="absolute bottom-10 left-10 w-24 h-24 bg-white rounded-full float-animation"
                            style="animation-delay: 1s;"></div>
                        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full float-animation"
                            style="animation-delay: 2s;"></div>
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="text-white mb-6 md:mb-0" x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform -translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0" x-show="animate">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                                Selamat Datang, {{ Auth::user()->name }}! 👋
                            </h1>
                            <p class="text-xl text-blue-100 mb-6">
                                Kelola aktivitas voting Anda dengan mudah dan aman
                            </p>
                            <div class="flex items-center space-x-4 text-blue-100">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user-tag mr-2"></i>
                                    <span>{{ Auth::user()->roles->pluck('name')->join(', ') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="relative" x-transition:enter="transition ease-out duration-700 delay-300"
                            x-transition:enter-start="opacity-0 transform translate-x-8"
                            x-transition:enter-end="opacity-100 transform translate-x-0" x-show="animate">
                            <div
                                class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm pulse-animation">
                                <i class="fas fa-user-circle text-6xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Votes Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Suara</p>
                            <p class="text-3xl font-bold text-gray-800">
                                {{ \App\Models\Voting::where('user_id', Auth::id())->count() }}
                            </p>
                            <p class="text-green-600 text-sm flex items-center mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>
                                Terdaftar
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-vote-yea text-2xl text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Elections Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Pemilihan Aktif</p>
                            <p class="text-3xl font-bold text-gray-800">
                                {{ \App\Models\Pemilihan::where('status', 'aktif')->count() }}</p>
                            <p class="text-orange-600 text-sm flex items-center mt-1">
                                <i class="fas fa-clock mr-1"></i>
                                Berlangsung
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-poll text-2xl text-orange-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Candidates Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kandidat</p>
                            <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Kandidat::count() }}</p>
                            <p class="text-purple-600 text-sm flex items-center mt-1">
                                <i class="fas fa-users mr-1"></i>
                                Terdaftar
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-2xl text-purple-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Status Akun</p>
                            <p class="text-3xl font-bold text-green-600">Aktif</p>
                            <p class="text-green-600 text-sm flex items-center mt-1">
                                <i class="fas fa-check-circle mr-1"></i>
                                Terverifikasi
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-check text-2xl text-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Quick Actions -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-rocket mr-3 text-blue-600"></i>
                            Aksi Cepat
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('voting.index') }}"
                                class="group bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold mb-2">Mulai Voting</h4>
                                        <p class="text-blue-100 text-sm">Berpartisipasi dalam pemilihan yang sedang
                                            berlangsung</p>
                                    </div>
                                    <i
                                        class="fas fa-vote-yea text-3xl text-blue-200 group-hover:text-white transition-colors"></i>
                                </div>
                            </a>

                            <a href="#"
                                class="group bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold mb-2">Lihat Hasil</h4>
                                        <p class="text-green-100 text-sm">Cek hasil pemilihan yang telah selesai</p>
                                    </div>
                                    <i
                                        class="fas fa-chart-bar text-3xl text-green-200 group-hover:text-white transition-colors"></i>
                                </div>
                            </a>

                            <a href="{{ route('profile.edit') }}"
                                class="group bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold mb-2">Profil Saya</h4>
                                        <p class="text-purple-100 text-sm">Kelola informasi akun Anda</p>
                                    </div>
                                    <i
                                        class="fas fa-user-edit text-3xl text-purple-200 group-hover:text-white transition-colors"></i>
                                </div>
                            </a>

                            <a href="#"
                                class="group bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-semibold mb-2">Bantuan</h4>
                                        <p class="text-orange-100 text-sm">Panduan dan dukungan sistem</p>
                                    </div>
                                    <i
                                        class="fas fa-question-circle text-3xl text-orange-200 group-hover:text-white transition-colors"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-history mr-3 text-green-600"></i>
                            Aktivitas Terbaru
                        </h3>
                        <div class="space-y-4">
                            @php
                                $userVote = \App\Models\Voting::where('user_id', Auth::id())
                                    ->with(['kandidat', 'pemilihan'])
                                    ->latest()
                                    ->first();
                            @endphp

                            @if ($userVote)
                                <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-200">
                                    <div
                                        class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">Voting Berhasil</p>
                                        <p class="text-gray-600 text-sm">Anda telah memilih
                                            {{ $userVote->kandidat->nama }} pada {{ $userVote->pemilihan->nama }} -
                                            {{ $userVote->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <span
                                        class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Selesai</span>
                                </div>
                            @else
                                <div class="flex items-center p-4 bg-blue-50 rounded-xl border border-blue-200">
                                    <div
                                        class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-info text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">Belum Ada Aktivitas</p>
                                        <p class="text-gray-600 text-sm">Anda belum pernah melakukan voting. Mulai
                                            berpartisipasi sekarang!</p>
                                    </div>
                                    <span
                                        class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Pending</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">
                    <!-- User Profile Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user mr-3 text-indigo-600"></i>
                            Profil Pengguna
                        </h3>
                        <div class="text-center mb-6">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span
                                    class="text-2xl font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-800">{{ Auth::user()->name }}</h4>
                            <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Role:</span>
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ Auth::user()->roles->pluck('name')->join(', ') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Bergabung:</span>
                                <span
                                    class="text-gray-800 font-medium">{{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->hasRole('Admin'))
                        <!-- Admin Panel Access -->
                        <div class="bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl shadow-xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <i class="fas fa-crown mr-3"></i>
                                Admin Panel
                            </h3>
                            <p class="text-red-100 mb-4 text-sm">
                                Anda memiliki akses administrator untuk mengelola sistem voting.
                            </p>
                            <a href="/admin"
                                class="inline-flex items-center bg-white text-red-600 px-4 py-2 rounded-xl font-semibold hover:bg-red-50 transition-colors duration-300">
                                <i class="fas fa-cog mr-2"></i>
                                Buka Admin Panel
                            </a>
                        </div>
                    @endif

                    <!-- System Status -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-server mr-3 text-green-600"></i>
                            Status Sistem
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Server</span>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-green-600 text-sm font-medium">Online</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Database</span>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-green-600 text-sm font-medium">Terhubung</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Keamanan</span>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-green-600 text-sm font-medium">Aman</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-chart-pie mr-3 text-blue-600"></i>
                            Statistik Cepat
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Total User</span>
                                <span class="font-bold text-2xl text-blue-600">{{ \App\Models\User::count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Total Voting</span>
                                <span
                                    class="font-bold text-2xl text-green-600">{{ \App\Models\Voting::count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Pemilihan</span>
                                <span
                                    class="font-bold text-2xl text-purple-600">{{ \App\Models\Pemilihan::count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
        <script>
            // Update current time
            function updateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };
                document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
            }

            // Update time every second
            setInterval(updateTime, 1000);
            updateTime(); // Initial call

            // Add some interactive effects
            document.addEventListener('DOMContentLoaded', function() {
                // Animate stat cards on scroll
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.style.opacity = '1';
                        }
                    });
                }, {
                    threshold: 0.1
                });

                // Observe all cards
                document.querySelectorAll('.card-hover').forEach((card) => {
                    card.style.transform = 'translateY(20px)';
                    card.style.opacity = '0';
                    card.style.transition = 'all 0.6s ease';
                    observer.observe(card);
                });
            });
        </script>
    @endpush
</x-app-layout>
