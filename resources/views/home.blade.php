@extends('layouts.app')

@section('content')

@include('includes.navbar')

<!-- Hero Section -->
<section class="pt-28 md:pt-32 pb-20 bg-white text-center relative overflow-hidden">
    @php
        $blurs = [
            ['pos' => 'top-10 left-10', 'color' => 'bg-green-200'],
            ['pos' => 'bottom-10 right-10', 'color' => 'bg-yellow-200'],
        ];
        $delays = ['delay-100', 'delay-400'];
    @endphp

    @foreach ($blurs as $index => $blur)
        <div class="absolute {{ $blur['pos'] }} w-52 h-52 {{ $blur['color'] }}
            rounded-full opacity-40 blur-3xl animate-floating {{ $delays[$index % count($delays)] }} z-0"></div>
    @endforeach

    <div class="relative z-10 max-w-3xl mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold leading-tight text-gray-800 mb-6">
            Laporkan Masalah,<br>
            Bantu Wujudkan Pelayanan Publik yang Lebih Baik
        </h1>
        <a href="/lapor" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full font-medium text-sm transition-all duration-300">
            Laporkan Sekarang
        </a>
    </div>
</section>

<section class="relative bg-transparent py-10 -mt-8 z-20">
    <div class="absolute inset-0 bg-white/0 backdrop-blur-md z-0"></div>
    <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto text-center text-sm md:text-base font-medium text-gray-700">
        <div class="bg-white shadow-sm rounded-md p-4 hover:shadow-md transition">
            <span class="text-yellow-500 text-xl md:text-2xl font-bold block">{{ $totalLaporan }}+</span>
            Total Laporan
        </div>
        <div class="bg-white shadow-sm rounded-md p-4 hover:shadow-md transition">
            <span class="text-purple-600 text-xl md:text-2xl font-bold block">{{ $totalPengguna }}+</span>
            Jumlah Pengguna
        </div>
        <div class="bg-white shadow-sm rounded-md p-4 hover:shadow-md transition">
            <span class="text-cyan-600 text-xl md:text-2xl font-bold block">{{ $persenSelesai }}%</span>
            Tanggapan Diselesaikan
        </div>
    </div>
</section>

<section id="laporanterbaru" class="bg-white py-16 relative overflow-hidden">
    @foreach ($blurs as $index => $blur)
        <div class="absolute {{ $blur['pos'] }} w-44 h-44 {{ $blur['color'] }}
            rounded-full opacity-30 blur-3xl animate-floating {{ $delays[$index % count($delays)] }} z-0"></div>
    @endforeach

    <div class="text-center mb-12 px-4 relative z-10">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Laporan Terbaru</h2>
        <p class="text-gray-600 text-sm md:text-base max-w-xl mx-auto">
            Berikut adalah beberapa laporan terbaru yang telah disampaikan oleh masyarakat.
        </p>
    </div>

    <div class="max-w-6xl mx-auto px-4 relative z-10">
        <div class="grid gap-6 
            grid-cols-1 
            sm:grid-cols-{{ count($laporans) >= 2 ? 2 : 1 }} 
            md:grid-cols-{{ count($laporans) >= 3 ? 3 : count($laporans) }} 
            lg:grid-cols-{{ count($laporans) >= 4 ? 4 : count($laporans) }} 
            {{ count($laporans) < 4 ? 'justify-center' : '' }}">
            
            @php
                $statusMap = [
                    0 => 'Belum Ditanggapi',
                    'proses' => 'Proses',
                    'selesai' => 'Selesai'
                ];

                $statusColor = [
                    'Belum Ditanggapi' => 'bg-gray-200 text-gray-700 border border-gray-300',
                    'Proses' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                    'Selesai' => 'bg-green-100 text-green-800 border border-green-400',
                ];
            @endphp

            @forelse ($laporans as $laporan)
                @php
                    $statusText = $statusMap[$laporan->status] ?? ucfirst($laporan->status);
                @endphp

                <div class="bg-white p-4 rounded-md shadow-sm hover:shadow-md transition-all duration-300 w-full sm:w-64">
                    <h4 class="font-semibold text-gray-800 mb-1">{{ substr($laporan->masyarakat->nama, 0, 3) . '***' }}</h4>
                    <p class="text-xs text-gray-500 mb-2">{{ $laporan->created_at->format('d M Y') }}</p>
                    <p class="text-sm text-gray-600 mb-3">{{ $laporan->isi_laporan }}</p>
                    
                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs rounded-full font-medium {{ $statusColor[$statusText] ?? 'bg-gray-200 text-gray-700' }}">
                        @if($statusText === 'Proses')
                            <i class="fas fa-spinner animate-spin"></i>
                        @elseif($statusText === 'Selesai')
                            <i class="fas fa-check-circle"></i>
                        @endif
                        {{ $statusText }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500 text-center col-span-full">Belum ada laporan terbaru.</p>
            @endforelse

        </div>
    </div>
</section>

<section id="carakerja" class="bg-gray-50 py-16 relative overflow-hidden">
    @php
        $blurs = [
            ['pos' => 'top-10 left-10', 'color' => 'bg-yellow-200'],
            ['pos' => 'bottom-10 right-10', 'color' => 'bg-green-200'],
        ];
    @endphp

    @foreach ($blurs as $index => $blur)
        <div class="absolute {{ $blur['pos'] }} w-52 h-52 {{ $blur['color'] }}
            rounded-full opacity-40 blur-3xl animate-floating {{ $delays[$index % count($delays)] }} z-0"></div>
    @endforeach

    <div class="text-center mb-12 px-4 relative z-10">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Bagaimana Cara Kerjanya</h2>
        <p class="text-gray-600 text-sm md:text-base max-w-xl mx-auto">
            Layanan ini dirancang agar masyarakat dapat menyampaikan keluhan atau saran dengan cepat dan transparan.
            Ikuti langkah mudah berikut untuk mulai melapor.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-4 text-center relative z-10">
        @php
        $steps = [
            ['img' => 'step1.png', 'title' => 'Daftar Akun', 'desc' => 'Buat akun untuk mengakses layanan dan melapor dengan aman.'],
            ['img' => 'step2.png', 'title' => 'Kirim Laporan', 'desc' => 'Isi formulir laporan lengkap dengan detail masalah.'],
            ['img' => 'step3.png', 'title' => 'Verifikasi & Tanggapan', 'desc' => 'Petugas memverifikasi laporan dan memberikan tanggapan.'],
            ['img' => 'step4.png', 'title' => 'Pantau Proses', 'desc' => 'Pantau perkembangan laporan.'],
        ];
        @endphp

        @foreach ($steps as $step)
        <div class="bg-white p-5 rounded-lg shadow-sm hover:shadow-md hover:scale-105 transition-transform duration-300">
            <img src="/img/{{ $step['img'] }}" alt="{{ $step['title'] }}" class="h-20 mx-auto mb-4">
            <h4 class="font-semibold text-gray-800 mb-1">{{ $step['title'] }}</h4>
            <p class="text-sm text-gray-600">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<section id="faq" class="relative bg-gray-50 py-16 overflow-hidden">
    @foreach ($blurs as $index => $blur)
        <div class="absolute {{ $blur['pos'] }} w-44 h-44 {{ $blur['color'] }}
            rounded-full opacity-30 blur-3xl animate-floating {{ $delays[$index % count($delays)] }} z-0"></div>
    @endforeach

    <div class="relative max-w-6xl mx-auto grid md:grid-cols-2 gap-10 px-4 z-10">
        <div class="flex justify-center md:justify-end">
            <lottie-player src="{{ asset('img/faq.json') }}" background="transparent" speed="1" style="max-height: 300px; width: 100%;" loop autoplay></lottie-player>
        </div>
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-7">Pertanyaan yang Sering Ditanyakan</h2>
            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q'=>'Apakah identitas pelapor akan dirahasiakan?','a'=>'Ya, identitas pelapor dijamin kerahasiaannya dan hanya diketahui oleh petugas yang berwenang.'],
                        ['q'=>'Siapa yang menangani laporan?','a'=>'Laporan akan diteruskan ke instansi atau petugas yang terkait dengan laporan tersebut.'],
                        ['q'=>'Berapa lama waktu tanggapan?','a'=>'Tanggapan biasanya diberikan dalam waktu maksimal 7 hari kerja setelah laporan diverifikasi.'],
                    ];
                @endphp

                @foreach ($faqs as $faq)
                <div x-data="{ open: false }" class="border rounded-md px-4 py-3 transition-all duration-300">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-sm font-medium text-gray-700">{{ $faq['q'] }}</span>
                        <svg x-show="!open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <svg x-show="open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="mt-2 text-sm text-gray-600">{{ $faq['a'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
