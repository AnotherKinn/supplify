<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            Riwayat Produk
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fadeIn">
        <div class="bg-[#FAE3AC] shadow-lg rounded-lg p-6">

            {{-- 🔍 Search Produk --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <form action="{{ route('penjual.produk.log') }}" method="GET" class="flex items-center gap-2 w-full md:w-auto">
                    <input type="text" name="search" placeholder="Cari produk..."
                        value="{{ old('search', $search ?? '') }}"
                        class="flex-1 px-4 py-2 rounded-lg bg-white text-[#2D3250]" />
                    <button type="submit"
                        class="bg-white text-[#FAE3AC] px-4 py-2 rounded-lg font-semibold transition">
                        <img src="{{ asset('image/icons/search.svg') }}" alt="search" class="w-5 h-5">
                    </button>
                </form>
            </div>

            {{-- 🖥️ Desktop: Tabel --}}
            <div class="hidden md:block overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-[#2D3250] text-[#FAE3AC] uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Produk</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Foto Produk</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Pesan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($produks as $index => $produk)
                        <tr class="border-t hover:bg-[#FAE3AC]/30 transition">
                            <td class="px-4 py-3 text-[#2D3250]">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-[#2D3250]">{{ $produk->nama_produk }}</td>
                            <td class="px-4 py-3 text-[#2D3250]/80 max-w-[200px] truncate">{{ $produk->deskripsi }}</td>
                            <td class="px-4 py-3">
                                <img src="{{ asset('storage/' . $produk->foto) }}"
                                    alt="{{ $produk->nama_produk }}"
                                    class="w-16 h-16 object-cover rounded-lg border border-[#2D3250] shadow-sm mx-auto" />
                            </td>
                            <td class="px-4 py-3">
                                @if ($produk->status === 'pending')
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @elseif ($produk->status === 'approved')
                                    <span class="text-green-600 font-semibold">Approved</span>
                                @elseif ($produk->status === 'rejected')
                                    <span class="text-red-600 font-semibold">Rejected</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 max-w-xs text-sm">
                                @if ($produk->status === 'pending')
                                    <p class="text-yellow-700">Produk anda saat ini masih menunggu validasi oleh admin.</p>
                                @elseif ($produk->status === 'approved')
                                    <p class="text-green-700">Produk anda sudah disetujui dan akan tampil di halaman marketplace.</p>
                                @elseif ($produk->status === 'rejected')
                                    <p class="text-red-700">Produk anda ditolak, mohon periksa dan revisi data produk anda.</p>
                                @else
                                    <p class="text-gray-500">Status tidak diketahui.</p>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-6 text-gray-500">
                                Belum ada produk yang diajukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 📱 Mobile: Card --}}
            <div class="grid grid-cols-1 gap-4 md:hidden">
                @forelse ($produks as $produk)
                    <div class="bg-white rounded-lg shadow-md p-4 border">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                alt="{{ $produk->nama_produk }}"
                                class="w-20 h-20 object-cover rounded-lg border shadow-sm">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-[#2D3250]">{{ $produk->nama_produk }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($produk->deskripsi, 80) }}</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="text-sm font-semibold">
                                Status:
                                @if ($produk->status === 'pending')
                                    <span class="text-yellow-600">Pending</span>
                                @elseif ($produk->status === 'approved')
                                    <span class="text-green-600">Approved</span>
                                @elseif ($produk->status === 'rejected')
                                    <span class="text-red-600">Rejected</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </p>
                            <div class="mt-2 text-sm">
                                @if ($produk->status === 'pending')
                                    <p class="text-yellow-700">Produk anda masih menunggu validasi admin.</p>
                                @elseif ($produk->status === 'approved')
                                    <p class="text-green-700">Produk anda sudah disetujui dan tampil di marketplace.</p>
                                @elseif ($produk->status === 'rejected')
                                    <p class="text-red-700">Produk anda ditolak, mohon revisi data produk.</p>
                                @else
                                    <p class="text-gray-500">Status tidak diketahui.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 italic">Belum ada produk yang diajukan.</p>
                @endforelse
            </div>

        </div>

        {{-- 🔽 Pagination --}}
        <div class="mt-8">
            {{ $produks->links('pagination::tailwind') }}
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-in-out; }
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
    <div class="bg-[#1F2544] text-white text-center py-4" data-aos="fade-in" data-aos-duration="1000">
        <p class="text-sm">© 2025 Supplify. All rights reserved.</p>
    </div>
</footer>
