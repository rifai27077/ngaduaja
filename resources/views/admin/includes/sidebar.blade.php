<aside 
    x-data="{ open: false }"
    @mouseenter="open = true" 
    @mouseleave="open = false"
    :class="open ? 'w-64' : 'w-20'"
    class="bg-white shadow-lg min-h-screen px-4 py-6 fixed top-0 left-0 z-40 border-r border-gray-200 transition-all duration-300">

    <div class="flex items-center justify-center mb-10 relative">
        <div x-show="open" class="text-2xl font-bold text-green-600 transition-opacity duration-300">DashHehe</div>
        <div x-show="!open" class="text-green-600 text-3xl font-bold transition-opacity duration-300">D</div>
    </div>

    <nav class="flex flex-col space-y-1 text-[15px] font-medium">

        <div class="relative group">
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out 
                    {{ request()->is('admin/dashboard') 
                        ? 'bg-green-600 text-white shadow-md' 
                        : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <i class="fas fa-chart-pie w-5 text-center {{ request()->is('admin/dashboard') ? 'text-white' : 'text-green-600' }}"></i>
                <span x-show="open" x-transition.opacity>Dashboard</span>
            </a>
            <span x-show="!open"
                :class="{'tooltip-delay': $el.classList.contains('group-hover:opacity-100'), 'tooltip-delay-hidden': !$el.classList.contains('group-hover:opacity-100')}"
                class="absolute left-20 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 pointer-events-none">
                Dashboard
            </span>
        </div>

        <div class="relative group">
            <a href="/admin/petugas"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out 
                    {{ request()->is('admin/petugas*') 
                        ? 'bg-green-600 text-white shadow-md' 
                        : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <i class="fas fa-user-shield w-5 text-center {{ request()->is('admin/petugas*') ? 'text-white' : 'text-green-600' }}"></i>
                <span x-show="open" x-transition.opacity>Petugas</span>
            </a>
            <span x-show="!open" class="absolute left-20 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 tooltip-delay group-hover:opacity-100 pointer-events-none">
                Petugas
            </span>
        </div>

        <div class="relative group">
            <a href="/admin/pengaduan"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out 
                    {{ request()->is('admin/pengaduan*') 
                        ? 'bg-green-600 text-white shadow-md' 
                        : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <i class="fas fa-clipboard-check w-5 text-center {{ request()->is('admin/pengaduan*') ? 'text-white' : 'text-green-600' }}"></i>
                <span x-show="open" x-transition.opacity>Verifikasi Laporan</span>
            </a>
            <span x-show="!open" class="absolute left-20 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 tooltip-delay group-hover:opacity-100 pointer-events-none">
                Verifikasi Laporan
            </span>
        </div>

        <div class="relative group">
            <a href="/admin/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 ease-in-out 
                    {{ request()->is('admin/laporan') 
                        ? 'bg-green-600 text-white shadow-md' 
                        : 'text-gray-700 hover:bg-green-50 hover:text-green-600' }}">
                <i class="fas fa-file-alt w-5 text-center {{ request()->is('admin/laporan') ? 'text-white' : 'text-green-600' }}"></i>
                <span x-show="open" x-transition.opacity>Generate Laporan</span>
            </a>
            <span x-show="!open" class="absolute left-20 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 tooltip-delay group-hover:opacity-100 pointer-events-none">
                Generate Laporan
            </span>
        </div>

        <div class="my-4 border-t border-gray-200"></div>

        <div class="relative group">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-100 transition-all duration-150">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span x-show="open" x-transition.opacity>Logout</span>
                </button>
            </form>
            <span x-show="!open" class="absolute left-20 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 tooltip-delay group-hover:opacity-100 pointer-events-none">
                Logout
            </span>
        </div>
    </nav>
</aside>
