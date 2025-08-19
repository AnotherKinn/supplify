{{-- resources/views/admin/produk/index.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-10">
        <!-- Title -->
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 tracking-tight">
            Daftar Produk <span class="text-yellow-600">(Pending)</span>
        </h1>

        @if ($produks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($produks as $produk)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 p-6 flex flex-col justify-between">
                        
                        <!-- Nama Produk -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">
                                {{ $produk->nama_produk }}
                            </h2>
                            <p class="text-sm text-gray-600 mb-3">
                                Status: 
                                <span class="inline-block bg-yellow-100 text-yellow-800 font-medium text-xs px-3 py-1 rounded-full">
                                    {{ ucfirst($produk->status) }}
                                </span>
                            </p>

                            <!-- Info Produk -->
                            <p class="text-sm text-gray-500 mb-1">
                                <span class="font-semibold">Deskripsi:</span> {{ Str::limit($produk->deskripsi, 50) }}
                            </p>
                            <p class="text-sm text-gray-500 mb-1">
                                <span class="font-semibold">Stok:</span> {{ $produk->stok }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <span class="font-semibold">Lokasi:</span> {{ $produk->lokasi }}
                            </p>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-6">
                            <a href="{{ route('admin.produk.show', $produk->id) }}" 
                               class="inline-block w-full text-center text-white bg-[#1F2544] hover:bg-[#14182d] px-4 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-100 border border-gray-300 rounded-lg p-6 text-center text-gray-600">
                Tidak ada produk dengan status 
                <span class="font-semibold text-yellow-600">pending</span>.
            </div>
        @endif
    </div>
</x-app-layout>
