<nav class="bg-[#FAE3AC] text-gray-800 shadow-md border-b border-gray-300 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
<div class="flex items-center gap-3">
    <img src="{{ asset('image/logo-supplify.png') }}" 
         alt="Supplify Logo" 
         class="h-10 w-auto md:h-[70px]">
</div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex gap-6 font-semibold">
            <a href="{{ route('penjual.dashboard') }}" class="hover:text-blue-700">Dashboard</a>
            <a href="{{ route('penjual.profile.index') }}" class="hover:text-blue-700">Biodata</a>
            <a href="{{ route('penjual.produk.index') }}" class="hover:text-blue-700">Produk</a>
            <a href="{{ route('penjual.produk.log') }}" class="hover:text-blue-700">Riwayat Produk</a>
            <a href="{{ route('penjual.transaksi.index') }}" class="hover:text-blue-700">Riwayat Penjualan</a>
        </div>

        <!-- Tombol Logout (Desktop) -->
        <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden md:block">
            @csrf
            <button type="button" id="logout-btn"
                class="bg-white text-yellow-600 px-4 py-1 rounded-lg font-semibold shadow hover:bg-gray-100 transition">
                Logout
            </button>
        </form>

        <!-- Tombol Burger (Mobile) -->
        <button id="menu-toggle" class="md:hidden text-2xl">
            ☰
        </button>
    </div>

    <!-- Menu Mobile (Sidebar) -->
    <div id="mobile-menu"
         class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="w-64 bg-[#FAE3AC] h-full p-6 space-y-4 transform -translate-x-full transition-transform duration-300"
             id="mobile-sidebar">
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg text-gray-800">Supplify</span>
                <button id="menu-close" class="text-2xl text-gray-800">✕</button>
            </div>

            <a href="{{ route('penjual.dashboard') }}" class="block py-2 hover:text-blue-700">Dashboard</a>
            <a href="{{ route('penjual.profile.index') }}" class="block py-2 hover:text-blue-700">Biodata</a>
            <a href="{{ route('penjual.produk.index') }}" class="block py-2 hover:text-blue-700">Produk</a>
            <a href="{{ route('penjual.produk.log') }}" class="block py-2 hover:text-blue-700">Riwayat Produk</a>
            <a href="{{ route('penjual.transaksi.index') }}" class="block py-2 hover:text-blue-700">Riwayat Penjualan</a>

            <!-- Logout di Mobile -->
            <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                @csrf
                <button type="button" id="logout-btn-mobile"
                    class="bg-white text-yellow-600 px-4 py-1 rounded-lg font-semibold shadow hover:bg-gray-100 transition w-full">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- SweetAlert2 --}}
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    // Logout Desktop
    document.getElementById('logout-btn').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin mau logout?',
            text: "Kamu akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });

    // Logout Mobile
    document.getElementById('logout-btn-mobile').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin mau logout?',
            text: "Kamu akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form-mobile').submit();
            }
        });
    });

    // Toggle Mobile Sidebar
    const menuToggle = document.getElementById("menu-toggle");
    const menuClose = document.getElementById("menu-close");
    const mobileMenu = document.getElementById("mobile-menu");
    const sidebar = document.getElementById("mobile-sidebar");

    menuToggle.addEventListener("click", () => {
        mobileMenu.classList.remove("hidden");
        setTimeout(() => {
            sidebar.classList.remove("-translate-x-full");
        }, 10);
    });

    menuClose.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        setTimeout(() => {
            mobileMenu.classList.add("hidden");
        }, 300);
    });
</script>
