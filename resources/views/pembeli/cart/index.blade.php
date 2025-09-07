<x-app-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Keranjang Belanja</h2>

                    @if ($cartItems->isEmpty())
                        <p class="text-center text-gray-600 dark:text-gray-300">Keranjang kosong. Yuk, belanja dulu!</p>
                    @else

                        {{-- DESKTOP: Tabel --}}
                        <div class="hidden md:block">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-300 dark:border-gray-600">
                                        <th class="p-3">Produk</th>
                                        <th class="p-3">Harga</th>
                                        <th class="p-3">Jumlah</th>
                                        <th class="p-3">Subtotal</th>
                                        <th class="p-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($cartItems as $item)
                                        @php 
                                            $subtotal = $item->produk->harga * $item->qty; 
                                            $total += $subtotal; 
                                        @endphp
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="p-3 flex items-center gap-3">
                                                <img src="{{ asset('storage/' . $item->produk->foto) }}" 
                                                     alt="{{ $item->produk->nama_produk }}" 
                                                     class="w-16 h-16 object-cover rounded">
                                                {{ $item->produk->nama_produk }}
                                            </td>
                                            <td class="p-3">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                            <td class="p-3">{{ $item->qty }}</td>
                                            <td class="p-3">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                            <td class="p-3">
                                                <form action="{{ route('pembeli.cart.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="flex justify-between items-center mt-6">
                                <p class="text-xl font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                                <form action="{{ route('pembeli.cart.checkout') }}" method="GET">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                        Checkout Semua
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- MOBILE: Card --}}
                        <div class="block md:hidden">
                            <div class="space-y-4">
                                @php $totalMobile = 0; @endphp
                                @foreach ($cartItems as $item)
                                    @php 
                                        $subtotal = $item->produk->harga * $item->qty; 
                                        $totalMobile += $subtotal; 
                                    @endphp
                                    <div class="border rounded-lg p-4 flex gap-4 items-center shadow-sm">
                                        <img src="{{ asset('storage/' . $item->produk->foto) }}" 
                                             alt="{{ $item->produk->nama_produk }}" 
                                             class="w-20 h-20 object-cover rounded">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-lg">{{ $item->produk->nama_produk }}</h3>
                                            <p class="text-white text-sm">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                            <p class="text-white mt-1">Jumlah: {{ $item->qty }}</p>
                                            <p class="font-bold mt-1">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                        <form action="{{ route('pembeli.cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center mt-6 border-t pt-4">
                                <p class="text-lg font-bold">Total: Rp {{ number_format($totalMobile, 0, ',', '.') }}</p>
                                <form action="{{ route('pembeli.cart.checkout') }}" method="GET">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                        Checkout Semua
                                    </button>
                                </form>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Footer --}}
<footer class="bg-[#FAE3AC] text-black"
    data-aos="fade-up" data-aos-duration="1000">
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
                    <a href="https://www.instagram.com/supplify_project?igsh=MTR6a3VqZTgzZ21zYg==" target="_blank" class="hover:underline text-[#223A5E]">
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
    <div class="bg-[#1F2544] text-white text-center py-4"
        data-aos="fade-in" data-aos-duration="1000">
        <p class="text-sm">© 2025 Supplify. All rights reserved.</p>
    </div>
</footer>
