{{-- Produk Seller --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            Produk Saya
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fadeIn">
        <div class="bg-[#FAE3AC] shadow-lg rounded-lg p-6">

            {{-- 🔍 Search & Tambah Produk --}}
            <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">
                <form action="{{ route('penjual.produk.index') }}" method="GET" class="flex flex-1 items-center gap-2">
                    <input type="text" name="search" placeholder="Cari produk..."
                        value="{{ old('search', $search ?? '') }}"
                        class="flex-1 px-4 py-2 rounded-lg bg-white text-[#2D3250] w-full sm:w-auto" />
                    <button type="submit"
                        class="bg-[#ffffff] text-[#FAE3AC] px-4 py-2 rounded-lg font-semibold transition flex items-center justify-center">
                        <img src="{{ asset('image/icons/search.svg') }}" alt="search" class="w-5 h-5">
                    </button>
                </form>

                <a href="{{ route('penjual.produk.create') }}"
                    class="bg-[#2D3250] hover:bg-[#1f233a] text-[#FAE3AC] px-5 py-2 rounded-lg font-semibold transition text-center">
                    + Tambah Produk
                </a>
            </div>

            {{-- ❌ Jika kosong --}}
            @if($produks->isEmpty())
            <p class="text-[#2D3250]/70 italic text-center py-8">Kamu belum menambahkan produk.</p>
            @else

            {{-- 🖥️ Desktop: Tabel --}}
            <div class="hidden md:block overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-[#2D3250] text-[#FAE3AC] uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Produk</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Foto Produk</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($produks as $index => $produk)
                        <tr class="hover:bg-[#FAE3AC]/40 transition-colors">
                            <td class="px-4 py-3 text-[#2D3250]">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-[#2D3250]">{{ $produk->nama_produk }}</td>
                            <td class="px-4 py-3 text-[#2D3250]/80 max-w-[200px] truncate">
                                {{ $produk->deskripsi }}
                            </td>
                            <td class="px-4 py-3">
                                @if($produk->foto)
                                <img src="{{ asset('storage/' . $produk->foto) }}"
                                    class="w-20 h-20 object-cover rounded-lg border shadow-sm mx-auto">
                                @else
                                <span class="text-gray-400 italic">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-[#2D3250]">{{ $produk->stok }}</td>
                            <td class="px-4 py-3 space-y-2 sm:space-y-0 sm:space-x-2 sm:flex sm:items-center">
                                @if(in_array($produk->status, ['rejected', 'pending']))
                                <a href="{{ route('penjual.produk.edit', $produk->id) }}"
                                    class="bg-[#2D3250] hover:bg-[#1f233a] text-[#FAE3AC] px-3 py-1 rounded-lg font-semibold transition block text-center">
                                    Edit
                                </a>
                                <form action="{{ route('penjual.produk.destroy', $produk) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg font-semibold transition w-full sm:w-auto delete-btn">
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <span class="text-gray-400 italic text-sm">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 📱 Mobile: Cards --}}
            <div class="grid grid-cols-1 gap-4 md:hidden">
                @foreach($produks as $produk)
                <div class="bg-white rounded-lg shadow-md p-4 border">
                    {{-- Foto produk --}}
                    @if($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}" class="w-full h-40 object-cover rounded-lg mb-3">
                    @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-lg mb-3 text-gray-400">
                        Belum ada foto
                    </div>
                    @endif

                    {{-- Detail produk --}}
                    <h3 class="text-lg font-bold text-[#2D3250] mb-1">{{ $produk->nama_produk }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($produk->deskripsi, 100) }}</p>
                    <p class="text-sm text-gray-800 font-semibold mb-2">Stok: {{ $produk->stok }}</p>

                    {{-- Aksi --}}
                    <div class="flex gap-2">
                        @if(in_array($produk->status, ['rejected', 'pending']))
                        <a href="{{ route('penjual.produk.edit', $produk->id) }}"
                            class="flex-1 bg-[#2D3250] hover:bg-[#1f233a] text-[#FAE3AC] px-3 py-2 rounded-lg font-semibold text-center">
                            Edit
                        </a>
                        <form action="{{ route('penjual.produk.destroy', $produk) }}" method="POST"
                            class="delete-form flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg font-semibold delete-btn">
                                Hapus
                            </button>
                        </form>
                        @else
                        <span class="text-gray-400 italic text-sm">Tidak tersedia</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @endif

            {{-- 🔽 Pagination --}}
            <div class="mt-8">
                {{ $produks->links('pagination::tailwind') }}
            </div>
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

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    });

</script>
@endif

@if(session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33',
        });
    });

</script>
@endif




{{-- SweetAlert2 --}}
<script>
    // Konfirmasi sebelum hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus produk ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

</script>
