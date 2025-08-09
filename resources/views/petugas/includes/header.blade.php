<header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-end items-center shadow-sm">
    <div class="flex items-center space-x-6">
        <div class="relative cursor-pointer">
            <i class="fas fa-bell text-gray-500 text-lg"></i>
            <span
                class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5">
                {{ $jumlahNotif ?? 0 }}
            </span>
        </div>

        <div class="flex items-center gap-3">
            <img src="{{ asset('img/ai.png') }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover" />
            <div class="leading-tight">
                <p class="font-semibold text-sm text-gray-800">
                    {{ Auth::guard('petugas')->user()->nama_petugas ?? '-' }}
                </p>
                <p class="text-xs text-gray-500">
                    Petugas
                </p>
            </div>
        </div>
    </div>
</header>