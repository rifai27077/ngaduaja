<!-- Header Topbar -->
<header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">
    <!-- Search -->
    <div class="relative w-64">
        <input
            type="text"
            placeholder="Search..."
            class="w-full border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-6">
        <!-- Notification Icon -->
        <div class="relative cursor-pointer">
            <i class="fas fa-bell text-gray-500 text-lg"></i>
            <span
                class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5">
                2
            </span>
        </div>

        <!-- Profile -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/ai.png') }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover" />
            <div class="leading-tight">
                <p class="font-semibold text-sm text-gray-800">Rifai</p>
                <p class="text-xs text-gray-500">Admin</p>
            </div>
        </div>
    </div>
</header>
