<section id="kandidat" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
            @if ($pemilihanAktif)
                Kandidat {{ $pemilihanAktif->nama }}
            @else
                Kandidat Pemilihan
            @endif
        </h2>

        @if ($kandidats->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($kandidats as $kandidat)
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl border border-gray-100">
                        <!-- Header dengan nomor urut -->
                        <div class="h-32 bg-gradient-to-br from-blue-500 to-blue-700 relative">
                            <div
                                class="absolute top-3 left-3 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-semibold">
                                No. {{ $loop->iteration }}
                            </div>
                            <div class="absolute inset-0 bg-black/10"></div>
                        </div>

                        <!-- Foto kandidat -->
                        <div class="relative -mt-16 flex justify-center">
                            <img src="{{ $kandidat->foto ? asset('storage/' . $kandidat->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kandidat->nama) . '&size=128&background=3B82F6&color=ffffff' }}"
                                alt="Kandidat {{ $kandidat->nama }}"
                                class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                        </div>

                        <!-- Konten kandidat -->
                        <div class="p-6 pt-4 text-center">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $kandidat->nama }}</h3>

                            <!-- Visi Misi Toggle -->
                            <div x-data="{ showVision: false }" class="mb-4">
                                <button @click="showVision = !showVision"
                                    class="text-blue-600 hover:text-blue-800 flex items-center justify-center mx-auto transition-colors text-sm">
                                    <span x-text="showVision ? 'Tutup Visi Misi' : 'Lihat Visi Misi'"></span>
                                    <i :class="showVision ? 'fa-chevron-up' : 'fa-chevron-down'"
                                        class="fas ml-1 text-xs transition-transform"></i>
                                </button>

                                <div x-show="showVision" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="mt-3 text-left bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-100">
                                    <div class="space-y-3">
                                        <div>
                                            <h4 class="font-semibold text-blue-700 mb-1 text-sm flex items-center">
                                                <i class="fas fa-eye mr-1"></i>Visi:
                                            </h4>
                                            <p class="text-xs text-gray-700 leading-relaxed">{{ $kandidat->visi }}</p>
                                        </div>

                                        <div>
                                            <h4 class="font-semibold text-blue-700 mb-1 text-sm flex items-center">
                                                <i class="fas fa-bullseye mr-1"></i>Misi:
                                            </h4>
                                            <div class="text-xs text-gray-700 leading-relaxed">
                                                {!! nl2br(e($kandidat->misi)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Vote -->
                            @auth
                                @if ($pemilihanAktif)
                                    @if ($hasVoted)
                                        <button
                                            class="w-full bg-gray-400 text-white py-2.5 rounded-xl cursor-not-allowed font-medium text-sm"
                                            disabled>
                                            <i class="fas fa-check-circle mr-2"></i>Sudah Memilih
                                        </button>
                                    @else
                                        <a href="{{ route('voting.index') }}"
                                            class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-2.5 rounded-xl transition-all duration-200 font-medium text-sm shadow-lg hover:shadow-xl">
                                            <i class="fas fa-vote-yea mr-2"></i>Pilih Kandidat
                                        </a>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-2.5 rounded-xl transition-all duration-200 font-medium text-sm shadow-lg hover:shadow-xl">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Memilih
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-users fa-4x"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Kandidat</h3>
                <p class="text-gray-500">Kandidat untuk pemilihan ini belum tersedia.</p>
            </div>
        @endif
    </div>
</section>
