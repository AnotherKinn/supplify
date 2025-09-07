<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div
            class="flex flex-col md:flex-row bg-[#1F2544] rounded-2xl shadow-2xl overflow-hidden w-full max-w-5xl min-h-[600px]">

            <!-- Bagian Gambar (hilang di mobile) -->
            <div class="md:w-1/2 hidden md:block">
                <img src="{{ asset('image/login-image.jpg') }}" alt="Register Image"
                    class="object-cover h-full w-full" />
            </div>

            <!-- Bagian Form -->
            <div class="md:w-1/2 w-full p-6 sm:p-10 text-white flex flex-col justify-center">
                <h2 class="text-2xl md:text-3xl font-bold text-center mb-8">Register Akun</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                            placeholder="Nama"
                            class="w-full max-w-md mx-auto h-[50px] px-4 rounded-lg bg-[#2F365E] text-white border-0 focus:ring-2 focus:ring-yellow-400" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-center" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required
                            placeholder="Email"
                            class="w-full max-w-md mx-auto h-[50px] px-4 rounded-lg bg-[#2F365E] text-white border-0 focus:ring-2 focus:ring-yellow-400" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-center" />
                    </div>

                    <!-- Password -->
                    <div class="relative w-full max-w-md mx-auto">
                        <x-text-input id="password" type="password" name="password" required placeholder="Password"
                            class="w-full h-[50px] px-4 pr-12 rounded-lg bg-[#2F365E] text-white border-0 focus:ring-2 focus:ring-yellow-400" />
                        <button type="button" onclick="togglePassword('password', this)"
                            class="absolute top-1/2 -translate-y-1/2 right-4 text-gray-400 hover:text-yellow-400">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-center" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative w-full max-w-md mx-auto">
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Konfirmasi Password"
                            class="w-full h-[50px] px-4 pr-12 rounded-lg bg-[#2F365E] text-white border-0 focus:ring-2 focus:ring-yellow-400" />
                        <button type="button" onclick="togglePassword('password_confirmation', this)"
                            class="absolute top-1/2 -translate-y-1/2 right-4 text-gray-400 hover:text-yellow-400">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                        <x-input-error :messages="$errors->get('password_confirmation')"
                            class="mt-2 text-red-400 text-center" />
                    </div>

                    <!-- Role -->
                    <div>
                        <select id="role" name="role" required
                            class="w-full max-w-md mx-auto h-[50px] px-4 rounded-lg bg-[#2F365E] text-white border-0 focus:ring-2 focus:ring-yellow-400">
                            <option value="">Pilih Role</option>
                            <option value="pembeli" {{ old('role') == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
                            <option value="penjual" {{ old('role') == 'penjual' ? 'selected' : '' }}>Penjual</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-400 text-center" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full max-w-md mx-auto h-[50px] bg-[#FAE3AC] hover:bg-[#e2cd90] text-[#1F2544] font-bold rounded-lg transition duration-300">
                            Register
                        </button>
                    </div>

                    <!-- Login Link -->
                    <p class="text-sm text-center">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300">Login disini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 1500,
        confirmButtonColor: '#3085d6'
    }).then(() => {
        window.location.href = "{{ route('login') }}";
    });

</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: `
                <ul style="text-align: left; margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Coba Lagi'
    });

</script>
@endif


<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector("i");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye"); // mata terbuka
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash"); // mata tertutup
        }
    }

</script>
