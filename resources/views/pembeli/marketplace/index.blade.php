<x-app-layout>
    <div class="py-12 bg-[#F5F7FA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#2D3250] rounded-xl shadow-xl p-8 text-white">

                {{-- 🔍 Form Pencarian & Filter --}}
                <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <form method="GET" action="{{ route('pembeli.marketplace.index') }}"
                        class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        {{-- Search --}}
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="col-span-1 md:col-span-2 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                   text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 
                   focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">

                        {{-- Filter harga --}}
                        <select name="filter_harga" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                   text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 
                   focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                            <option value="">Filter Harga</option>
                            <option value="murah" {{ request('filter_harga') == 'murah' ? 'selected' : '' }}>Termurah
                            </option>
                            <option value="mahal" {{ request('filter_harga') == 'mahal' ? 'selected' : '' }}>Termahal
                            </option>
                        </select>

                        {{-- Filter stok --}}
                        <select name="filter_stok" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                   text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 
                   focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                            <option value="">Filter Stok</option>
                            <option value="tersedia" {{ request('filter_stok') == 'tersedia' ? 'selected' : '' }}>
                                Tersedia</option>
                            <option value="habis" {{ request('filter_stok') == 'habis' ? 'selected' : '' }}>Habis
                            </option>
                        </select>

                        {{-- Button full width di mobile --}}
                        <button type="submit" class="w-full md:w-auto md:col-span-4 bg-[#FAE3AC] hover:bg-[#EFC66D] 
                   text-black font-semibold py-2 rounded-lg shadow-md transition">
                            Terapkan
                        </button>
                    </form>
                </div>


                {{-- Marketplace --}}
                {{-- Grid container --}}
                <div class="grid gap-4 sm:gap-6 
            [grid-template-columns:repeat(auto-fit,minmax(100px,1fr))] 
            md:grid-cols-3">
                    @foreach ($produk as $item)
                    {{-- Card produk --}}
                    <div class="group relative bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 
            rounded-xl shadow hover:shadow-xl transition overflow-hidden flex flex-col md:w-[300px]
            {{ $item->stok == 0 ? 'opacity-70 pointer-events-none' : '' }}">

                        {{-- Gambar produk --}}
                        <div class="relative">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}"
                                class="w-full h-32 sm:h-48 object-cover transform group-hover:scale-105 transition duration-300">

                            {{-- Tombol keranjang (tetap ada) --}}
                            @if($item->stok > 0)
                            <form action="{{ route('pembeli.cart.store') }}" method="POST"
                                class="absolute top-2 right-2">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit">
                                    <img src="{{ asset('image/icons/cart.svg') }}" class="w-5 h-5 sm:w-6 sm:h-6 bg-green-500 hover:bg-green-600 
                                        text-white p-1 sm:p-1.5 rounded-full shadow-lg 
                                        opacity-0 group-hover:opacity-100 transition duration-300">
                                </button>
                            </form>
                            @endif

                            {{-- Harga --}}
                            <span class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white 
                             text-[10px] sm:text-sm font-semibold px-2 sm:px-3 py-1 rounded-lg">
                                Rp {{ number_format($item->harga, 0, ',', '.') }} / Kg
                            </span>

                            {{-- Label Habis --}}
                            @if($item->stok == 0)
                            <span class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-60 
                                 text-white font-bold text-sm sm:text-lg">
                                Habis
                            </span>
                            @endif
                        </div>

                        {{-- Detail produk --}}
                        <div class="p-2 sm:p-4 flex flex-col flex-grow">
                            <h2 class="text-xs sm:text-sm md:text-lg font-bold text-gray-800 dark:text-white 
                           text-center mb-1 sm:mb-2">
                                {{ $item->nama_produk }}
                            </h2>

                            <p class="text-[10px] sm:text-sm text-center text-gray-600 dark:text-gray-300 mb-2 sm:mb-3">
                                Stok: {{ $item->stok }} Kg
                            </p>

                            @if($item->stok > 0)
                            <a href="{{ route('pembeli.transaksi.checkout', $item->id) }}" class="mt-auto block w-full text-center bg-[#FAE3AC] hover:bg-yellow-300 
                              text-[#2D3250] text-xs sm:text-sm font-semibold py-1.5 sm:py-2 rounded-lg">
                                Beli
                            </a>
                            @else
                            <button disabled class="mt-auto block w-full text-center bg-gray-400 text-white 
                              text-xs sm:text-sm font-semibold py-1.5 sm:py-2 rounded-lg cursor-not-allowed">
                                Tidak Tersedia
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
    </div>
    </div>

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
</x-app-layout>


{{-- SweetAlert2 --}}
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });

</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        showConfirmButton: true
    });

</script>
@endif
