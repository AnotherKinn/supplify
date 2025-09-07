<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            Riwayat Pembelian
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fadeIn">
        <div class="bg-[#FAE3AC] shadow-lg rounded-xl p-6 border border-[#2D3250]">
            @if ($transaksis->isEmpty())
            <p class="text-[#2D3250]/70 italic">Kamu belum melakukan pembelian apapun.</p>
            @else
            {{-- DESKTOP: Tabel --}}
            <div class="hidden md:block">
                <div class="overflow-x-auto rounded-lg border border-[#2D3250]/30">
                    <table class="min-w-full text-sm text-left border-collapse">
                        <thead class="bg-[#2D3250] text-[#FAE3AC] uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Produk</th>
                                <th class="px-4 py-3">Total Item</th>
                                <th class="px-4 py-3">Total Harga</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($transaksis as $transaksi)
                            <tr class="hover:bg-[#FAE3AC]/40 transition-colors">
                                <td class="px-4 py-3 text-[#2D3250]">
                                    @foreach ($transaksi->transaksis as $item)
                                    {{ $item->produk->nama_produk }}
                                    <span class="text-sm text-[#2D3250]/70">(x{{ $item->qty }})</span><br>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-[#2D3250]">
                                    {{ $transaksi->transaksis->sum('qty') }}
                                </td>
                                <td class="px-4 py-3 text-[#2D3250]">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($transaksi->status === 'done')
                                    <span
                                        class="inline-flex items-center gap-1 text-[#2D3250] bg-green-200 px-3 py-1 rounded-full text-xs font-medium border border-green-400">
                                        ✔ Selesai
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center gap-1 text-[#2D3250] bg-yellow-200 px-3 py-1 rounded-full text-xs font-medium border border-yellow-400">
                                        ⏳ Pending
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-[#2D3250]/80">
                                    {{ $transaksi->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- MOBILE: Card --}}
            <div class="block md:hidden space-y-4">
                @foreach ($transaksis as $transaksi)
                <div class="bg-white border border-[#2D3250]/30 rounded-lg shadow-sm p-4">
                    <div class="mb-3">
                        <h3 class="font-bold text-[#2D3250]">Produk:</h3>
                        <ul class="text-sm text-[#2D3250]/90">
                            @foreach ($transaksi->transaksis as $item)
                            <li>{{ $item->produk->nama_produk }}
                                <span class="text-xs text-[#2D3250]/70">(x{{ $item->qty }})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="text-sm text-[#2D3250]"><span class="font-semibold">Total Item:</span>
                        {{ $transaksi->transaksis->sum('qty') }}</p>
                    <p class="text-sm text-[#2D3250]"><span class="font-semibold">Total Harga:</span> Rp
                        {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-[#2D3250] flex items-center gap-2">
                        <span class="font-semibold">Status:</span>
                        @if($transaksi->status === 'done')
                        <span
                            class="inline-flex items-center gap-1 text-[#2D3250] bg-green-200 px-2 py-0.5 rounded-full text-xs font-medium border border-green-400">
                            ✔ Selesai
                        </span>
                        @else
                        <span
                            class="inline-flex items-center gap-1 text-[#2D3250] bg-yellow-200 px-2 py-0.5 rounded-full text-xs font-medium border border-yellow-400">
                            ⏳ Pending
                        </span>
                        @endif
                    </p>
                    <p class="text-sm text-[#2D3250]/80"><span class="font-semibold">Tanggal:</span>
                        {{ $transaksi->created_at->format('d M Y') }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- 🔽 Pagination -->
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


{{-- SweetAlert2 --}}
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
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
