<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Pemilihan</h2>
            <p class="text-lg text-gray-600">Data real-time sistem voting</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pemilihan -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Pemilihan</p>
                        <p class="text-3xl font-bold" x-data="{ count: 0 }"
                            x-intersect="
                            let target = {{ $stats['total_pemilihan'] }};
                            let duration = 2000;
                            let step = target / (duration / 16);
                            let current = 0;
                            
                            let interval = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    count = target;
                                    clearInterval(interval);
                                } else {
                                    count = Math.round(current);
                                }
                            }, 16);
                        "
                            x-text="count">0</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-vote-yea text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-blue-100 text-sm">
                    <i class="fas fa-calendar-check mr-2"></i>
                    <span>{{ $stats['pemilihan_aktif'] }} pemilihan aktif</span>
                </div>
            </div>

            <!-- Total Kandidat -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Kandidat</p>
                        <p class="text-3xl font-bold" x-data="{ count: 0 }"
                            x-intersect="
                            let target = {{ $stats['total_kandidat'] }};
                            let duration = 2000;
                            let step = target / (duration / 16);
                            let current = 0;
                            
                            let interval = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    count = target;
                                    clearInterval(interval);
                                } else {
                                    count = Math.round(current);
                                }
                            }, 16);
                        "
                            x-text="count">0</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-green-100 text-sm">
                    <i class="fas fa-user-check mr-2"></i>
                    <span>{{ $stats['kandidat_aktif'] }} kandidat tersedia</span>
                </div>
            </div>

            <!-- Total Pemilih -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Total Pemilih</p>
                        <p class="text-3xl font-bold" x-data="{ count: 0 }"
                            x-intersect="
                            let target = {{ $stats['total_voters'] }};
                            let duration = 2000;
                            let step = target / (duration / 16);
                            let current = 0;
                            
                            let interval = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    count = target;
                                    clearInterval(interval);
                                } else {
                                    count = Math.round(current);
                                }
                            }, 16);
                        "
                            x-text="count">0</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-user-friends text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-purple-100 text-sm">
                    <i class="fas fa-percentage mr-2"></i>
                    <span>{{ $stats['participation_rate'] }}% partisipasi</span>
                </div>
            </div>

            <!-- Total Suara -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Total Suara</p>
                        <p class="text-3xl font-bold" x-data="{ count: 0 }"
                            x-intersect="
                            let target = {{ $stats['total_votes'] }};
                            let duration = 2000;
                            let step = target / (duration / 16);
                            let current = 0;
                            
                            let interval = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    count = target;
                                    clearInterval(interval);
                                } else {
                                    count = Math.round(current);
                                }
                            }, 16);
                        "
                            x-text="count">0</p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 rounded-lg p-3">
                        <i class="fas fa-chart-bar text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-orange-100 text-sm">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $stats['votes_today'] }} suara hari ini</span>
                </div>
            </div>
        </div>

        <!-- Statistik Detail Pemilihan Aktif -->
        @if ($stats['pemilihan_aktif'] > 0)
            @php
                $now = now();
                $pemilihanAktif = \App\Models\Pemilihan::where('tanggal_mulai', '<=', $now)
                    ->where('tanggal_selesai', '>=', $now)
                    ->where('status', 'aktif')
                    ->with([
                        'kandidats' => function ($query) {
                            $query->withCount('votings');
                        },
                    ])
                    ->first();
            @endphp

            @if ($pemilihanAktif && $pemilihanAktif->kandidats->count() > 0)
                <div class="mt-12">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                        Perolehan Suara - {{ $pemilihanAktif->nama }}
                    </h3>

                    <div class="bg-gray-50 rounded-xl p-6">
                        <div
                            class="grid grid-cols-1 md:grid-cols-{{ min($pemilihanAktif->kandidats->count(), 3) }} gap-6">
                            @foreach ($pemilihanAktif->kandidats as $kandidat)
                                @php
                                    $totalVotes = $stats['votes_aktif'];
                                    $percentage =
                                        $totalVotes > 0 ? round(($kandidat->votings_count / $totalVotes) * 100, 1) : 0;
                                @endphp

                                <div class="bg-white rounded-lg p-6 text-center shadow-sm border">
                                    <!-- Foto Kandidat -->
                                    <div class="mb-4">
                                        <img src="{{ $kandidat->foto ? asset('storage/' . $kandidat->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kandidat->nama) . '&size=80&background=3B82F6&color=ffffff' }}"
                                            alt="{{ $kandidat->nama }}"
                                            class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-gray-200">
                                    </div>

                                    <!-- Nama Kandidat -->
                                    <h4 class="font-bold text-lg text-gray-900 mb-2">{{ $kandidat->nama }}</h4>

                                    <!-- Jumlah Suara -->
                                    <div class="mb-3">
                                        <span
                                            class="text-3xl font-bold text-blue-600">{{ $kandidat->votings_count }}</span>
                                        <p class="text-sm text-gray-500">suara</p>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="mb-2">
                                        <div class="bg-gray-200 rounded-full h-3">
                                            <div class="bg-blue-600 h-3 rounded-full transition-all duration-500"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Persentase -->
                                    <p class="text-lg font-semibold text-gray-700">{{ $percentage }}%</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary -->
                        <div class="mt-6 text-center text-gray-600">
                            <p class="text-sm">
                                <i class="fas fa-info-circle mr-2"></i>
                                Total {{ $stats['votes_aktif'] }} suara dari {{ $stats['total_voters'] }} pemilih
                                terdaftar
                                ({{ $stats['participation_rate'] }}% partisipasi)
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <!-- Real-time Update Info -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                <i class="fas fa-sync-alt mr-2"></i>
                Data diperbarui secara real-time | Terakhir update: {{ now()->format('d M Y, H:i:s') }} WIB
            </p>
        </div>
    </div>
</section>
