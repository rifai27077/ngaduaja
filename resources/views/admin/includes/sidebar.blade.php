<aside class="w-64 bg-[#F9FAFB] min-h-screen px-6 py-8 fixed top-0 left-0 z-40 border-r border-gray-200">
    <div class="flex items-center text-2xl font-semibold mb-12">
        <span class="text-gray-800">Dash</span><span class="text-green-600">Hehe</span>
    </div>

    <nav class="flex flex-col space-y-1 text-[15px] font-medium">
        <a href="/admin/dashboard"
            class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out
                {{ request()->is('admin/dashboard') 
                    ? 'bg-green-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100 hover:text-green-600' }}">
            <i class="fas fa-chart-pie w-4 group-hover:text-green-600 
                {{ request()->is('admin/dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
            Dashboard
        </a>

        <a href="/admin/petugas"
            class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out
                {{ request()->is('admin/petugas*') 
                    ? 'bg-green-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100 hover:text-green-600' }}">
            <i class="fas fa-user-shield w-4 group-hover:text-green-600 
                {{ request()->is('admin/petugas*') ? 'text-white' : 'text-gray-500' }}"></i>
            Petugas
        </a>

        <a href="/admin/pengaduan"
            class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out
                {{ request()->is('admin/pengaduan*') 
                    ? 'bg-green-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100 hover:text-green-600' }}">
            <i class="fas fa-clipboard-check w-4 group-hover:text-green-600 
                {{ request()->is('admin/pengaduan*') ? 'text-white' : 'text-gray-500' }}"></i>
            Verifikasi Laporan
        </a>

        {{-- <a href="/admin/tanggapan"
            class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out
                {{ request()->is('admin/tanggapan*') 
                    ? 'bg-green-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100 hover:text-green-600' }}">
            <i class="fas fa-comments w-4 group-hover:text-green-600 
                {{ request()->is('admin/tanggapan*') ? 'text-white' : 'text-gray-500' }}"></i>
            Tanggapan
        </a> --}}

        <a href="/admin/laporan"
            class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out
                {{ request()->is('admin/laporan') 
                    ? 'bg-green-600 text-white' 
                    : 'text-gray-700 hover:bg-gray-100 hover:text-green-600' }}">
            <i class="fas fa-file-alt w-4 group-hover:text-green-600 
                {{ request()->is('admin/laporan') ? 'text-white' : 'text-gray-500' }}"></i>
            Generate Laporan
        </a>

        <div class="my-4 border-t border-gray-200"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left group flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-100 transition-all duration-150">
                <i class="fas fa-sign-out-alt w-4 group-hover:text-red-700"></i> Logout
            </button>
        </form>
    </nav>
</aside>
