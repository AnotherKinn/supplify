<x-app-layout>
    <div class="min-h-screen flex items-center justify-center  py-10 px-4">
        <div class="bg-white shadow-lg rounded-2xl max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 overflow-hidden">

            <!-- Left Content -->
            <div class="bg-[#FAE3AC] p-8 flex flex-col justify-center">
                <p class="uppercase text-sm tracking-widest text-[#0A1B2F]">Kami Siap Membantu</p>
                <h2 class="text-3xl font-bold text-[#0A1B2F] mt-2 leading-snug">
                    Ajukan Produk Anda<br> ke Supplify
                </h2>
                <p class="text-[#0A1B2F]/80 mt-4 text-sm">
                    Isi formulir di samping untuk mengajukan produk Anda agar dapat terhubung dengan pembeli yang tepat.
                </p>

                <!-- Contact Info -->
                {{-- <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-[#0A1B2F] p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#FAE3AC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7m0-7a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </div>
                        <span class="text-[#0A1B2F] text-sm">support@suplify.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-[#0A1B2F] p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#FAE3AC]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l3.6 7.59a1 1 0 00.92.58h6.96a1 1 0 00.92-.58L19 5h2" />
                            </svg>
                        </div>
                        <span class="text-[#0A1B2F] text-sm">+62 812 3456 7890</span>
                    </div>
                </div> --}}
            </div>

            <!-- Right Form -->
            <div class="p-8">
                <form action="{{ route('penjual.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="text" name="nama_produk" placeholder="Nama Produk" class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFDE63]">
                    <textarea name="deskripsi" placeholder="Deskripsi Produk" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFDE63]"></textarea>
                    <input type="number" name="harga" placeholder="Harga" class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFDE63]">
                    <input type="number" name="stok" placeholder="Stok" class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFDE63]">
                    <input type="text" name="lokasi" placeholder="Lokasi" class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#FFDE63]">
                    <input type="file" name="foto" class="w-full border border-gray-200 rounded-lg px-4 py-3 text-gray-500">

                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0A1B2F] text-[#FAE3AC] font-semibold py-3 rounded-lg hover:bg-[#142842] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        Kirim Produk
                    </button>
                </form>
            </div>
        </div>
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
        window.location.href = "{{ route('penjual.produk.index') }}";
    });
</script>
@endif

@if($errors->any())
<script>
    let errorMessages = `
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        `;
    Swal.fire({
        icon: 'error',
        title: 'Gagal mengajukan produk',
        html: errorMessages,
        showConfirmButton: true
    });
</script>
@endif