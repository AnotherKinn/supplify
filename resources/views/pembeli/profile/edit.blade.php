<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- Bagian Kiri (Info Panel) --}}
                <div class="bg-[#FAE3AC] p-8 flex flex-col justify-center">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">
                        Edit Biodata Anda di Suplify
                    </h1>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Isi formulir di samping untuk memperbarui informasi perusahaan Anda agar data tetap akurat,
                        memudahkan proses transaksi dan menjaga pengalaman belanja lebih nyaman.
                    </p>
                </div>

                {{-- Bagian Kanan (Form) --}}
                <div class="p-8">
                    <form method="POST" action="{{ route('pembeli.profile.update') }}" class="space-y-5">
                        @csrf

                        <input type="text" name="alamat"
                            placeholder="Alamat"
                            value="{{ old('alamat', $profile->alamat ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <input type="text" name="no_hp"
                            placeholder="Nomor HP"
                            value="{{ old('no_hp', $profile->no_hp ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <input type="email" name="email_kontak"
                            placeholder="Email Kontak"
                            value="{{ old('email_kontak', $profile->email_kontak ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <input type="text" name="nama_perusahaan"
                            placeholder="Nama Perusahaan"
                            value="{{ old('nama_perusahaan', $profile->nama_perusahaan ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <button type="submit"
                            class="w-full bg-[#1A1F4A] hover:bg-[#0f1435] text-white font-medium py-3 rounded-lg shadow-md transition duration-200">
                            Simpan
                        </button>
                    </form>
                </div>
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
            window.location.href = "{{ route('pembeli.profile.index')}}";
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

{{-- Jika ada error validasi --}}
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `
                <ul class="text-center">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'OK'
        });
    </script>
@endif
