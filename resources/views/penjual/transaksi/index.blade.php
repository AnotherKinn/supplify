<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            Riwayat Penjualan Produk
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fadeIn">
        <div class="bg-[#FAE3AC] shadow-lg rounded-lg p-6">

            {{-- 🖥️ Desktop: Tabel --}}
            <div class="hidden md:block overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-[#2D3250] text-[#FAE3AC] uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Produk</th>
                            <th class="px-4 py-3">Pembeli</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Alamat Pembeli</th>
                            <th class="px-4 py-3">Harga Total</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($transaksis as $transaksi)
                        <tr class="border-t hover:bg-[#FAE3AC]/30 transition">
                            <td class="px-4 py-3 font-medium text-[#2D3250]">
                                @foreach ($transaksi->transaksisProduk as $item)
                                {{ $item->produk->nama_produk }}
                                <span class="text-sm text-gray-500">(x{{ $item->qty }})</span><br>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-[#2D3250]/80">{{ $transaksi->pembeli->name ?? 'Tidak Diketahui' }}
                            </td>
                            <td class="px-4 py-3 text-[#2D3250]/80">{{ $transaksi->transaksisProduk->sum('qty') }}</td>
                            <td class="px-4 py-3 text-[#2D3250]/80 max-w-[200px] truncate">
                                {{ $transaksi->alamat_pengiriman }}</td>
                            <td class="px-4 py-3 text-[#2D3250]/80">
                                Rp{{ number_format($transaksi->transaksisProduk->sum(fn($item) => $item->qty * $item->harga), 0, ',', '.') }}
                            </td>
                            <td class="p-3">
                                <span class="px-3 py-1 text-sm rounded-full 
                                    @if ($transaksi->status == 'Selesai' || $transaksi->status == 'done')
                                        bg-green-100 text-green-700
                                    @elseif ($transaksi->status == 'Pending')
                                        bg-yellow-100 text-yellow-700
                                    @else
                                        bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucwords($transaksi->status) }}
                                </span>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-6 text-gray-500">
                                Belum ada transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 📱 Mobile: Card --}}
            <div class="grid grid-cols-1 gap-4 md:hidden mt-4">
                @forelse ($transaksis as $transaksi)
                <div class="bg-white rounded-lg shadow-md p-4 border">
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-800">Produk</h3>
                        @foreach ($transaksi->transaksisProduk as $item)
                        <p class="text-sm">{{ $item->produk->nama_produk }} <span
                                class="text-gray-500">(x{{ $item->qty }})</span></p>
                        @endforeach
                    </div>
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-800">Pembeli</h3>
                        <p class="text-sm text-gray-700">{{ $transaksi->pembeli->name ?? 'Tidak Diketahui' }}</p>
                    </div>
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-800">Jumlah</h3>
                        <p class="text-sm text-gray-700">{{ $transaksi->transaksisProduk->sum('qty') }}</p>
                    </div>
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-800">Alamat</h3>
                        <p class="text-sm text-gray-700">{{ $transaksi->alamat_pengiriman }}</p>
                    </div>
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-800">Harga Total</h3>
                        <p class="text-sm text-gray-700">
                            Rp{{ number_format($transaksi->transaksisProduk->sum(fn($item) => $item->qty * $item->harga), 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Status</h3>
                        <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full 
                            @if ($transaksi->status == 'Selesai' || $transaksi->status == 'done')
                                bg-green-100 text-green-700
                            @elseif ($transaksi->status == 'Pending')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-gray-100 text-gray-700
                            @endif">
                            {{ ucwords($transaksi->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 italic">Belum ada transaksi.</p>
                @endforelse
            </div>

        </div>

        {{-- 🔽 Pagination --}}
        <div class="mt-8">
            {{ $transaksis->links('pagination::tailwind') }}
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.4s ease-in-out;
        }

    </style>
</x-app-layout>


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
