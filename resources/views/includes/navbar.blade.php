<nav id="navbar" class="fixed top-0 w-full z-50 bg-white/0 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center space-x-2">
                    <img src="/img/logo.png" alt="Logo" class="h-8 w-8">
                    <span class="font-bold text-lg text-gray-800">Pengaduan Masyarakat</span>
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex flex-1 justify-center space-x-6">
                <a href="/" class="text-sm text-green-700 font-medium hover:text-green-900 transition">Beranda</a>
                <a href="#carakerja" class="text-sm text-gray-600 hover:text-green-600 transition">Cara Kerja</a>
                <a href="#laporanterbaru" class="text-sm text-gray-600 hover:text-green-600 transition">Laporan Terbaru</a>
            </div>

            <!-- Tombol Auth Desktop -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/login" class="text-sm text-gray-600 hover:text-green-600 transition">Masuk</a>
                <a href="/register" class="bg-green-600 text-white px-6 py-2 rounded-full text-sm hover:bg-green-700 transition">Daftar</a>
            </div>

            <!-- Tombol Mobile -->
            <div class="md:hidden">
                <button id="menu-toggle" class="focus:outline-none transition">
                    <svg id="menu-icon" class="w-6 h-6 text-gray-700 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden max-h-0 overflow-hidden transition-all duration-300 bg-white shadow">
        <div class="px-4 pb-4">
            <a href="/" class="block py-2 text-sm text-green-700 font-medium hover:text-green-900">Beranda</a>
            <a href="#tentang" class="block py-2 text-sm text-gray-600 hover:text-green-600">Tentang</a>
            <a href="#carakerja" class="block py-2 text-sm text-gray-600 hover:text-green-600">Cara Kerja</a>
            <a href="/login" class="block py-2 text-sm text-gray-600 hover:text-green-600">Masuk</a>
            <a href="/register" class="block mt-2 bg-green-600 text-white px-4 py-2 rounded-full text-sm text-center hover:bg-green-700 transition">Daftar</a>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const navbar = document.getElementById('navbar');

    // Toggle mobile menu
    menuToggle?.addEventListener('click', () => {
        mobileMenu.classList.toggle('max-h-60');
        mobileMenu.classList.toggle('max-h-0');
        menuIcon.innerHTML = mobileMenu.classList.contains('max-h-60')
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>`;
    });

    // Scroll effect
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('bg-white/50', window.scrollY > 10);
        navbar.classList.toggle('backdrop-blur-md', window.scrollY > 10);
        navbar.classList.toggle('shadow-md', window.scrollY > 10);
    });
});
</script>
