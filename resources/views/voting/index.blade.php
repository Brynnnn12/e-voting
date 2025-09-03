<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pemilihanAktif->nama }}
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
    <div class="py-8 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Voting Header -->
            <div class="text-center mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-blue-100">
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <i class="fas fa-vote-yea text-blue-600 text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistem Voting Online</h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            {{ $pemilihanAktif->deskripsi ?? 'Pilih kandidat pilihan Anda dengan mengklik tombol "PILIH". Suara Anda sangat berharga untuk menentukan masa depan yang lebih baik.' }}
                        </p>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-xl border-0 rounded-2xl p-8 max-w-4xl mx-auto"
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
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center justify-center">
                            <i class="fas fa-clock mr-3"></i>
                            Waktu Voting Berakhir
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div
                                class="bg-white/20 backdrop-blur-sm text-white rounded-xl p-6 text-center border border-white/30">
                                <span x-text="days" class="text-4xl font-bold block mb-2"></span>
                                <p class="text-sm font-medium opacity-90">HARI</p>
                            </div>
                            <div
                                class="bg-white/20 backdrop-blur-sm text-white rounded-xl p-6 text-center border border-white/30">
                                <span x-text="hours" class="text-4xl font-bold block mb-2"></span>
                                <p class="text-sm font-medium opacity-90">JAM</p>
                            </div>
                            <div
                                class="bg-white/20 backdrop-blur-sm text-white rounded-xl p-6 text-center border border-white/30">
                                <span x-text="minutes" class="text-4xl font-bold block mb-2"></span>
                                <p class="text-sm font-medium opacity-90">MENIT</p>
                            </div>
                            <div
                                class="bg-white/20 backdrop-blur-sm text-white rounded-xl p-6 text-center border border-white/30">
                                <span x-text="seconds" class="text-4xl font-bold block mb-2"></span>
                                <p class="text-sm font-medium opacity-90">DETIK</p>
                            </div>
                        </div>
                    </div>

                    <div x-show="isExpired" class="text-center">
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-8 border border-white/30">
                            <i class="fas fa-clock text-red-300 text-5xl mb-6"></i>
                            <h3 class="text-2xl font-bold text-white mb-4">Waktu Voting Telah Berakhir</h3>
                            <p class="text-white/90 text-lg">Terima kasih atas partisipasi Anda dalam proses demokrasi
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kandidat Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($kandidats as $kandidat)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-gray-100 group"
                        x-data="{
                            showVisi: false,
                            isVoting: false,
                            vote: function(kandidatId) {
                                if (this.isVoting) return;
                        
                                this.isVoting = true;
                        
                                fetch('{{ route('voting.store') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            kandidat_id: kandidatId
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Show success message
                                            this.$dispatch('show-toast', {
                                                type: 'success',
                                                message: data.message
                                            });
                        
                                            // Redirect after 2 seconds
                                            setTimeout(() => {
                                                window.location.href = data.redirect;
                                            }, 2000);
                                        } else {
                                            // Show error message
                                            this.$dispatch('show-toast', {
                                                type: 'error',
                                                message: data.message
                                            });
                                            this.isVoting = false;
                                        }
                                    })
                                    .catch(error => {
                                        this.$dispatch('show-toast', {
                                            type: 'error',
                                            message: 'Terjadi kesalahan. Silakan coba lagi.'
                                        });
                                        this.isVoting = false;
                                    });
                            }
                        }">

                        <!-- Nomor Urut -->
                        <div
                            class="h-40 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 relative flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="text-white text-center relative z-10">
                                <div class="text-5xl font-bold mb-2">{{ $loop->iteration }}</div>
                                <div class="text-sm font-medium tracking-wide uppercase opacity-90">Nomor Urut</div>
                            </div>
                            <!-- Decorative elements -->
                            <div class="absolute top-4 right-4 w-16 h-16 bg-white/10 rounded-full"></div>
                            <div class="absolute bottom-4 left-4 w-8 h-8 bg-white/10 rounded-full"></div>
                        </div>

                        <!-- Foto Kandidat -->
                        <div class="flex justify-center -mt-20 mb-6 relative z-20">
                            <div class="relative">
                                <img src="{{ $kandidat->foto ? asset('storage/' . $kandidat->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kandidat->nama) . '&size=160&background=3B82F6&color=ffffff' }}"
                                    alt="Kandidat {{ $kandidat->nama }}"
                                    class="w-40 h-40 rounded-full border-6 border-white shadow-2xl object-cover ring-4 ring-blue-100">
                                <div
                                    class="absolute -bottom-2 -right-2 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                                    <i class="fas fa-user-check text-white text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Info Kandidat -->
                        <div class="px-8 pb-8 text-center">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $kandidat->nama }}</h3>

                            <!-- Toggle Visi Misi -->
                            <button @click="showVisi = !showVisi"
                                class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm mb-6 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-all duration-200">
                                <span x-text="showVisi ? 'Sembunyikan Visi Misi' : 'Lihat Visi Misi'"
                                    class="font-medium"></span>
                                <i :class="showVisi ? 'fa-chevron-up' : 'fa-chevron-down'"
                                    class="fas ml-2 transform transition-transform duration-200"></i>
                            </button>

                            <!-- Visi Misi Content -->
                            <div x-show="showVisi" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0" class="mb-8">
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl p-6 text-left border border-blue-100">
                                    <div class="mb-4">
                                        <h4 class="font-bold text-blue-700 mb-3 flex items-center">
                                            <i class="fas fa-eye mr-2"></i>Visi:
                                        </h4>
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $kandidat->visi }}</p>
                                    </div>

                                    <div>
                                        <h4 class="font-bold text-blue-700 mb-3 flex items-center">
                                            <i class="fas fa-target mr-2"></i>Misi:
                                        </h4>
                                        <div class="text-sm text-gray-700 leading-relaxed">
                                            {!! nl2br(e($kandidat->misi)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vote Button -->
                            <button @click="vote({{ $kandidat->id }})" :disabled="isVoting"
                                :class="isVoting ? 'bg-gray-400 cursor-not-allowed transform-none' :
                                    'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transform hover:scale-105 active:scale-95'"
                                class="w-full text-white py-4 px-8 rounded-xl font-bold text-lg transition-all duration-200 shadow-lg hover:shadow-xl relative overflow-hidden group">
                                <span x-show="!isVoting" class="flex items-center justify-center">
                                    <i class="fas fa-vote-yea mr-3 text-xl"></i>
                                    <span class="tracking-wide">PILIH KANDIDAT</span>
                                </span>
                                <span x-show="isVoting" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="tracking-wide">MEMPROSES...</span>
                                </span>
                                <!-- Button shine effect -->
                                <div
                                    class="absolute inset-0 -top-2 -bottom-2 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                                </div>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Informasi Voting -->
            <div
                class="bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-200 rounded-2xl p-8 max-w-4xl mx-auto shadow-lg">
                <div class="flex items-start">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-6">
                        <i class="fas fa-info-circle text-amber-600 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-amber-800 mb-4 text-xl flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Informasi Penting Sebelum Voting
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                    <span class="text-amber-700 font-medium">Anda hanya dapat memilih satu
                                        kandidat</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-lock text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                    <span class="text-amber-700 font-medium">Pilihan tidak dapat diubah setelah
                                        dikonfirmasi</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-eye text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                    <span class="text-amber-700 font-medium">Pastikan pilihan Anda sudah tepat sebelum
                                        memilih</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-clock text-amber-600 mt-1 mr-3 flex-shrink-0"></i>
                                    <span class="text-amber-700 font-medium">Voting akan berakhir secara otomatis
                                        sesuai waktu</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-amber-100 rounded-xl border border-amber-300">
                            <p class="text-amber-800 font-semibold text-center">
                                <i class="fas fa-heart text-red-500 mr-2"></i>
                                Suara Anda adalah Suara Perubahan untuk Masa Depan yang Lebih Baik
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div x-data="{
            show: false,
            message: '',
            type: 'success',
            showToast(data) {
                this.message = data.message;
                this.type = data.type;
                this.show = true;
                setTimeout(() => { this.show = false; }, 5000);
            }
        }" @show-toast.window="showToast($event.detail)" x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2 scale-95"
            x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 transform translate-y-2 scale-95"
            class="fixed top-6 right-6 z-50 max-w-sm">

            <div :class="type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600' :
                'bg-gradient-to-r from-red-500 to-red-600'"
                class="text-white p-6 rounded-2xl shadow-2xl border-0">
                <div class="flex items-center">
                    <div :class="type === 'success' ? 'bg-green-400' : 'bg-red-400'"
                        class="w-10 h-10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i :class="type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'"
                            class="fas text-white"></i>
                    </div>
                    <div class="flex-1">
                        <span x-text="message" class="font-medium text-sm leading-relaxed"></span>
                    </div>
                    <button @click="show = false"
                        class="ml-4 text-white hover:text-gray-200 transition-colors duration-200 w-6 h-6 flex items-center justify-center rounded-full hover:bg-white/20">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
