<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Informasi Pembeli --}}
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            {{-- Informasi Pembeli + Produk --}}
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                {{-- Informasi Pembeli --}}
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Informasi Pembeli</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nama:</span> {{ $user->name }}</p>
                        <p><span class="font-medium">No. HP:</span> {{ $user->profile->no_hp ?? '-' }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ $user->profile->alamat ?? 'Belum diisi' }}</p>
                        <p><span class="font-medium">Email Kontak:</span>
                            {{ $user->profile->email_kontak ?? $user->email }}</p>
                    </div>
                </div>

                {{-- Informasi Produk & Penjual --}}
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Informasi Produk & Penjual</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nama Produk:</span> {{ $produk->nama_produk }}</p>
                        <p><span class="font-medium">Deskripsi:</span> {{ $produk->deskripsi }}</p>
                        <p><span class="font-medium">Lokasi:</span> {{ $produk->lokasi }}</p>
                        <p><span class="font-medium">Email Penjual:</span>
                            {{ $produk->penjual->profile->email_kontak ?? $produk->penjual->email }}</p>
                        <p><span class="font-medium">No. HP Penjual:</span>
                            {{ $produk->penjual->profile->no_hp ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="pembeli-checkout" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
        </div>

        <form action="{{ route('pembeli.transaksi.bayar') }}" method="POST" class="grid md:grid-cols-3 gap-6">
            @csrf

            {{-- Kolom Kiri: Metode Pembayaran --}}
            <div class="bg-white p-6 rounded-lg shadow md:col-span-2">
                <h3 class="text-lg font-semibold mb-4">Pilih Metode Pembayaran</h3>
                <div class="space-y-4">
                    <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:border-blue-500">
                        <input type="radio" name="metode_pembayaran" value="BCA Virtual Account" class="mr-3" required>
                        <img src="{{ asset('image/bca.png') }}" alt="BCA" class="h-6 mr-2">
                        <span>BCA Virtual Account</span>
                    </label>
                    <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:border-blue-500">
                        <input type="radio" name="metode_pembayaran" value="Mandiri Virtual Account" class="mr-3">
                        <img src="{{ asset('image/mandiri.png') }}" alt="Mandiri" class="h-6 mr-2">
                        <span>Mandiri Virtual Account</span>
                    </label>
                    <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:border-blue-500">
                        <input type="radio" name="metode_pembayaran" value="QRIS" class="mr-3">
                        <img src="{{ asset('image/qris.png') }}" alt="QRIS" class="h-6 mr-2">
                        <span>QRIS</span>
                    </label>
                </div>
            </div>

            {{-- Kolom Kanan: Ringkasan Pesanan --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}"
                        class="w-20 h-20 rounded mr-4 object-cover">
                    <div>
                        <h4 class="font-semibold">{{ $produk->nama }}</h4>
                        <p class="text-gray-600 text-sm">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Hidden inputs untuk data transaksi --}}
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="alamat_pengiriman" value="{{ $user->profile->alamat ?? 'Belum diisi' }}">

                <div class="border-t pt-4 mt-4 space-y-2">
                    {{-- Stepper Jumlah --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Jumlah</label>
                        <div class="flex items-center mt-2">
                            <!-- Tombol minus -->
                            <button type="button" id="btn-minus"
                                class="px-3 py-2 bg-blue-500 text-white rounded-l hover:bg-blue-600">-</button>

                            <!-- Input jumlah -->
                            <input type="number" id="jumlah" name="jumlah" min="1" max="{{ $produk->stok }}" value="1"
                                class="w-16 text-center border-t border-b" readonly>

                            <!-- Tombol plus -->
                            <button type="button" id="btn-plus"
                                class="px-3 py-2 bg-blue-500 text-white rounded-r hover:bg-blue-600">+</button>
                        </div>
                    </div>

                    <p class="flex justify-between text-gray-700">
                        <span>Total</span>
                        <span class="font-bold" id="total-harga">Rp
                            {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </p>
                    <p id="metode-pembayaran-ringkasan" class="flex justify-between text-gray-700">
                        <span>Metode Pembayaran</span>
                        <span class="font-bold text-black" id="metode-pembayaran-text">-</span>
                    </p>
                </div>

                <button type="submit" class="w-full mt-6 py-3 rounded-lg font-semibold transition
                    @if($biodataIncomplete)
                        bg-gray-400 cursor-not-allowed
                    @else
                        bg-blue-600 hover:bg-blue-700 text-white
                    @endif" @if ($biodataIncomplete) disabled @endif>
                    Bayar Sekarang
                </button>

                @if ($biodataIncomplete)
                <div class="mt-4 text-sm text-red-600">
                    ⚠ Lengkapi biodata Anda dulu di
                    <a href="{{ route('pembeli.profile.edit') }}" class="text-blue-600 underline">halaman profil</a>.
                </div>
                @endif
            </div>
        </form>
    </div>
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
        timer: 1500
    }).then(() => {
        window.location.href = "{{ route('pembeli.transaksi.index')}}";
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

@if ($biodataIncomplete)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'warning',
            title: 'Lengkapi Biodata',
            text: 'Alamat dan nomor HP harus dilengkapi sebelum melanjutkan pembayaran.',
            confirmButtonText: 'OK'
        });
    });

</script>
@endif

{{-- Script interaktif --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const root = document.getElementById('pembeli-checkout');

        const hargaSatuan = Number(root && root.dataset.harga ? root.dataset.harga : 0);
        const stok = Number(root && root.dataset.stok ? root.dataset.stok : 0);

        const radios = document.querySelectorAll('input[name="metode_pembayaran"]');
        const ringkasanText = document.getElementById('metode-pembayaran-text');
        const jumlahInput = document.getElementById('jumlah');
        const totalHargaText = document.getElementById('total-harga');

        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');

        if (!jumlahInput || !totalHargaText || !ringkasanText) return;

        // update metode pembayaran
        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                ringkasanText.textContent = this.value;
            });
        });

        // fungsi update total
        const updateTotal = () => {
            let qty = parseInt(jumlahInput.value, 10) || 1;
            if (qty < 1) qty = 1;
            if (qty > stok) {
                qty = stok;
                jumlahInput.value = stok;
            }
            const total = hargaSatuan * qty;
            totalHargaText.textContent = 'Rp ' + total.toLocaleString('id-ID');
        };

        // tombol minus
        btnMinus.addEventListener('click', () => {
            let val = parseInt(jumlahInput.value, 10) || 1;
            if (val > 1) {
                jumlahInput.value = val - 1;
                updateTotal();
            }
        });

        // tombol plus
        btnPlus.addEventListener('click', () => {
            let val = parseInt(jumlahInput.value, 10) || 1;
            if (val < stok) {
                jumlahInput.value = val + 1;
                updateTotal();
            }
        });

        // trigger awal
        updateTotal();
    });

</script>
