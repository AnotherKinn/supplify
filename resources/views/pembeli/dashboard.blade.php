<x-app-layout>
    {{-- Tambahkan AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="bg-[#1F2544] px-4 md:px-12 py-12 rounded-[10px] mt-6 mb-8 mx-4 md:mx-8 overflow-hidden">
        <div class="grid md:grid-cols-2 gap-8 items-center max-w-7xl mx-auto">
            <!-- Left Content -->
            <div class="flex flex-col gap-6 text-white" data-aos="fade-right" data-aos-duration="1200">
                <h1 class="font-extrabold text-3xl md:text-5xl leading-tight">
                    Simplify Your <br> Supply, Amplify <br> Your Growth.
                </h1>
                <p class="text-gray-200 text-base leading-relaxed">
                    Suplify mempertemukan penjual dan pembeli dalam satu platform
                    untuk memudahkan jual beli bahan baku dan produk berkualitas
                    secara cepat, transparan, dan tepat waktu.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#about"
                        class="bg-[#FAE3AC] text-[#1F2544] px-6 py-3 rounded-lg font-semibold hover:bg-[#f7d98a] transition text-center">
                        Pelajari Lebih Lanjut
                    </a>
                    <a href="#produk"
                        class="border border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#1F2544] transition text-center">
                        Lihat Produk
                    </a>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative" data-aos="fade-left" data-aos-duration="1200">
                <img src="{{ asset('image/hero-seller.jpg') }}" alt="Hero Image"
                    class="rounded-lg shadow-lg w-full h-[250px] md:h-[450px] object-cover hidden md:block lg:block">
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <div id="about" class="bg-[#1F2544] rounded-[10px] p-4 md:p-8 mx-4 md:mx-8 mb-8">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="w-full md:w-1/2" data-aos="zoom-in" data-aos-duration="1200">
                <img src="{{ asset('image/logo-putih.png') }}" alt="Tentang Kami"
                    class="hidden md:block lg:block rounded-lg shadow-lg w-full md:w-[400px] h-auto object-cover">

            </div>
            <div class="w-full mt-5 md:ml-5 text-white" data-aos="fade-left" data-aos-duration="1200">
                <h2 class="text-2xl md:text-3xl font-bold mb-3">Tentang Supplify</h2>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed mb-4">
                    Supplify adalah platform inovatif yang hadir untuk mempermudah proses pemenuhan kebutuhan Anda
                    dengan cepat, aman, dan efisien.
                </p>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                    Dengan komitmen pada transparansi, kemudahan, dan layanan pelanggan yang responsif, Suplify berupaya
                    menjadi solusi terbaik bagi individu maupun bisnis dalam mendapatkan barang yang mereka butuhkan.
                </p>
            </div>
        </div>
    </div>
    {{-- Produk Terlaris --}}
    <section id="produk" class="bg-[#1F2544] px-4 md:px-10 py-10 rounded-[10px] mb-8 mx-4 md:mx-8 overflow-hidden"
        data-aos="fade-up">
        <div class="max-w-7xl mx-auto">
            <div class="text-white mb-6 text-center">
                <h2 class="text-2xl md:text-4xl font-extrabold">Produk Terlaris</h2>
                <p class="text-gray-200 text-sm md:text-base">Favorit nomor satu, kualitas terjamin, terbukti paling
                    dicari.</p>
            </div>

            <div class="swiper mySwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @forelse ($produks as $produk)
                    <div class="swiper-slide flex justify-center">
                        <div class="card bg-white rounded-xl p-5 flex flex-col items-center shadow-lg w-44 sm:w-60">
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}"
                                class="w-28 h-28 sm:w-40 sm:h-40 object-contain rounded-md mb-4 transform hover:scale-105 transition duration-300">
                            <h3 class="text-gray-800 font-semibold text-sm sm:text-base text-center">
                                {{ $produk->nama_produk }}</h3>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-white w-full py-8">Belum ada data terlaris.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Tombol Cari Lebih Banyak --}}
        <div class="text-center mt-6">
            <a href="{{ route('pembeli.marketplace.index') }}"
                class="inline-block px-6 py-3 bg-[#F2613F] text-white font-semibold rounded-lg shadow-md hover:bg-[#d94c2e] transition">
                Cari Lebih Banyak
            </a>
        </div>
    </section>



    {{-- Contoh Kreasi Produk --}}
    <section
        class="bg-[#1F2544] dark:bg-gray-800 rounded-xl p-6 md:p-8 mb-8 mx-4 md:mx-8 transition-colors duration-300"
        data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-white font-bold text-2xl md:text-3xl mb-8 text-center" data-aos="fade-down"
            data-aos-duration="900">
            Contoh Kreasi Produk
        </h2>

        <div class="grid md:grid-cols-2 gap-6 max-w-6xl mx-auto">

            {{-- Kulit sintetis jadi Sabuk --}}
            <div class="bg-[#FAE3AC] dark:bg-yellow-50 rounded-lg p-5 md:p-6 flex flex-col items-center text-center transition-colors duration-300"
                data-aos="fade-right" data-aos-duration="1000">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-800 mb-4">Kulit sintetis</h3>
                <div class="flex items-center gap-3 md:gap-4 mb-4">
                    <img src="{{ asset('image/leather.jpg') }}"
                        class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md shadow-sm">
                    <span class="text-xl md:text-2xl font-bold text-gray-700 dark:text-gray-800">→</span>
                    <img src="{{ asset('image/belts.jpg') }}"
                        class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md shadow-sm">
                </div>
                <p class="text-gray-700 dark:text-gray-800 leading-relaxed text-sm md:text-base">
                    Dari potongan <span class="font-semibold">kulit sintetis</span>, kita bisa membuat <span
                        class="font-semibold">sabuk handmade</span>.
                    Prosesnya tidak sulit, cukup dengan sedikit keterampilan menjahit dan alat sederhana.
                    Hasil akhirnya kokoh, elegan, dan ramah lingkungan karena memanfaatkan bahan sisa yang biasanya
                    terbuang.
                </p>
            </div>

            {{-- Benang jadi Boneka Rajut --}}
            <div class="bg-[#FAE3AC] dark:bg-yellow-50 rounded-lg p-5 md:p-6 flex flex-col items-center text-center transition-colors duration-300"
                data-aos="fade-left" data-aos-duration="1000">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-800 mb-4">Benang wol</h3>
                <div class="flex items-center gap-3 md:gap-4 mb-4">
                    <img src="{{ asset('image/benang.png') }}"
                        class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md shadow-sm">
                    <span class="text-xl md:text-2xl font-bold text-gray-700 dark:text-gray-800">→</span>
                    <img src="{{ asset('image/bebek.png') }}"
                        class="w-24 h-24 md:w-32 md:h-32 object-cover rounded-md shadow-sm">
                </div>
                <p class="text-gray-700 dark:text-gray-800 leading-relaxed text-sm md:text-base">
                    Dari sisa <span class="font-semibold">benang wol</span>, kita bisa mengolahnya menjadi <span
                        class="font-semibold">boneka rajut (amigurumi)</span>.
                    Membuatnya membutuhkan kesabaran, tapi tidak sulit untuk dipelajari dengan pola sederhana.
                    Produk ini sangat diminati karena unik, lucu, dan bisa jadi hadiah spesial buatan tangan.
                </p>
            </div>

        </div>
    </section>


    <!-- Statistik -->
    <section class="bg-[#1F2544] text-white py-12 px-6 mx-8 mb-8 rounded-lg" data-aos="fade-up">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

            <!-- Kiri: Deskripsi -->
            <div data-aos="fade-right" data-aos-delay="100">
                <h2 class="text-3xl font-bold mb-4">Statistik & Kontribusi Supplify</h2>
                <p class="text-gray-300 leading-relaxed mb-4">
                    Supplify terus berkembang berkat kontribusi dari para <span class="font-semibold">penjual</span>,
                    <span class="font-semibold">pembeli (UMKM)</span>, dan ratusan <span
                        class="font-semibold">produk</span> yang diajukan.
                    Data berikut menunjukkan perkembangan ekosistem Supplify.
                </p>
                <p class="text-gray-300 leading-relaxed">
                    Statistik ini mencerminkan bagaimana platform kami menjadi jembatan penting dalam
                    mendorong pertumbuhan bisnis berkelanjutan.
                </p>
            </div>

            <!-- Kanan: Chart -->
            <div class="bg-white p-6 rounded-xl shadow-md" data-aos="fade-left" data-aos-delay="200">
                <canvas id="supplifyStatsChart"></canvas>
            </div>

        </div>
    </section>

    {{-- Our Location --}}
    <section class="bg-[#1F2544] rounded-[10px] p-6 md:p-8 mb-8 mx-8" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-white font-bold text-2xl md:text-3xl mb-6 text-center">
            Lokasi
        </h2>
        <div id="map" class="w-full h-[400px] rounded-lg shadow-lg"></div>
    </section>



    {{-- Footer --}}
    <footer class="bg-[#FAE3AC] text-black" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                <img src="{{ asset('image/logo-supplify.png') }}" class="h-[50px] w-auto">
                <p class="text-sm mb-4">Supplify mempermudah Anda terhubung dengan pemasok terpercaya.</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <h3 class="font-bold mb-3">Customer Service</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <img src="{{ asset('image/icons/gmail.svg') }}" class="w-5 h-5">
                        <a href="mailto:ajipamungkasoffice7308@gmail.com" class="hover:underline text-[#223A5E]">
                            ajipamungkasoffice7308@gmail.com
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <img src="{{ asset('image/icons/whatsapp.svg') }}" class="w-5 h-5">
                        <a href="https://wa.me/6282329453188" target="_blank" class="hover:underline text-[#223A5E]">
                            +62 823-2945-3188
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <img src="{{ asset('image/icons/instagram.svg') }}" class="w-5 h-5">
                        <a href="https://www.instagram.com/supplify_project?igsh=MTR6a3VqZTgzZ21zYg==" target="_blank"
                            class="hover:underline text-[#223A5E]">
                            @supplify
                        </a>
                    </li>
                </ul>
            </div>
            <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                <h3 class="font-bold mb-3">Jam Layanan</h3>
                <p class="text-sm">Senin - Jumat: 08:00 - 17:00 WIB</p>
                <p class="text-sm">Sabtu: 09:00 - 15:00 WIB</p>
                <p class="text-sm">Minggu & Libur Nasional: Tutup</p>
            </div>
        </div>
        <div class="bg-[#1F2544] text-white text-center py-4" data-aos="fade-in" data-aos-duration="1000">
            <p class="text-sm">© 2025 Supplify. All rights reserved.</p>
        </div>
    </footer>

    {{-- Tambahkan AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('supplifyStatsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Perusahaan (Penjual)', 'Produk Diajukan', 'UMKM (Pembeli)'],
            datasets: [{
                label: 'Jumlah',
                data: @json([$totalPenjual, $totalProduk, $totalPembeli]),
                backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#374151'
                    }
                },
                x: {
                    ticks: {
                        color: '#374151'
                    }
                }
            }
        }
    });

</script>
