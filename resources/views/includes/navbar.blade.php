<nav id="navbar" class="fixed top-0 w-full z-[999] bg-white/0 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="/img/logo.png" alt="Logo" class="h-8 w-8">
                    <span class="font-bold text-lg text-gray-800">NgaduAja</span>
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex flex-1 justify-center space-x-6">
                <a href="{{ url('/') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-green-600" data-target="home">Beranda</a>
                <a href="#carakerja" class="nav-link text-sm text-gray-600 hover:text-green-600" data-target="carakerja">Cara Kerja</a>
                <a href="#laporanterbaru" class="nav-link text-sm text-gray-600 hover:text-green-600" data-target="laporanterbaru">Laporan Terbaru</a>
                <a href="#faq" class="nav-link text-sm text-gray-600 hover:text-green-600" data-target="faq">FAQ</a>

                @auth
                    <a href="{{ route('laporan.form') }}" class="text-sm text-gray-600 hover:text-green-600 transition">Form Laporan</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-600 transition"
                    onclick="return confirm('Silakan login terlebih dahulu untuk membuat laporan.')">
                    Form Laporan
                    </a>
                @endauth
            </div>

            <!-- Tombol Auth Desktop -->
            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-green-600 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-2 rounded-full text-sm hover:bg-green-700 transition">Daftar</a>
                @endguest

                @auth
                    <span class="text-sm text-gray-700">Halo, {{ Auth::user()->nama }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                @endauth
            </div>

            <!-- Tombol Mobile -->
            <div class="md:hidden">
                <button id="menu-toggle" class="focus:outline-none transition" aria-label="Toggle Menu">
                    <svg id="menu-icon" class="w-6 h-6 text-gray-700 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow transition-all duration-300">
        <div class="px-4 pb-4">
            <a href="#faq" class="nav-link block py-2 text-sm text-gray-600 hover:text-green-600" data-target="faq">FAQ</a>

            @auth
                <a href="{{ route('laporan.form') }}" class="block py-2 text-sm text-gray-600 hover:text-green-600">Form Laporan</a>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-600 hover:text-green-600"
                onclick="return confirm('Silakan login terlebih dahulu untuk membuat laporan.')">
                Form Laporan
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-600 hover:text-green-600">Masuk</a>
                <a href="{{ route('register') }}" class="block mt-2 bg-green-600 text-white px-4 py-2 rounded-full text-sm text-center hover:bg-green-700 transition">Daftar</a>
            @endguest

            @auth
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-700">Halo, {{ Auth::user()->nama }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const navbar = document.getElementById('navbar');
        const navLinks = document.querySelectorAll(".nav-link");
        const sections = document.querySelectorAll("section[id]");
        const mobileLinks = document.querySelectorAll("#mobile-menu a");
        
        console.log(menuToggle);
        

        // Toggle mobile menu
        menuToggle?.addEventListener('click', () => {
            console.log('humbuger clicked');
            mobileMenu.classList.toggle('hidden');
            menuIcon.innerHTML = mobileMenu.classList.contains('hidden')
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>` // Hamburger
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>`; // Close
        });

        // Tutup menu otomatis setelah klik link
        mobileLinks.forEach(link => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
                menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>`;
            });
        });

        // Smooth scrolling
        navLinks.forEach(link => {
            link.addEventListener("click", e => {
                const target = link.getAttribute("href");
                if (target.startsWith("#")) {
                    e.preventDefault();
                    document.querySelector(target).scrollIntoView({ behavior: "smooth", block: "start" });
                    if (!mobileMenu.classList.contains("hidden")) menuToggle.click();
                }
            });
        });

        // Scroll effect + ScrollSpy with underline
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('bg-white/50', window.scrollY > 10);
            navbar.classList.toggle('backdrop-blur-md', window.scrollY > 10);
            navbar.classList.toggle('shadow-md', window.scrollY > 10);

            let scrollPos = window.scrollY + 150;
            navLinks.forEach(link => link.classList.remove("active"));
            sections.forEach(section => {
                if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
                    document.querySelector(`.nav-link[data-target="${section.id}"]`)?.classList.add("active");
                }
            });
            if (window.scrollY < sections[0].offsetTop) {
                document.querySelector(`.nav-link[data-target="home"]`)?.classList.add("active");
            }
        });
    });
</script>
