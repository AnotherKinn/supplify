<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Biodata Saya
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-2xl p-8">
                <!-- Header Profil -->
                <div class="flex items-center gap-6 border-b border-gray-200 dark:border-gray-700 pb-6 mb-6">
                    <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Detail Biodata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Alamat</p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $user->profile->alamat ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">No HP</p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $user->profile->no_hp ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Nama UMKM</p>
                        <p class="text-gray-900 dark:text-gray-100">{{ $user->profile->nama_perusahaan ?? '-' }}</p>
                    </div>
                </div>

                <!-- Tombol Edit -->
                <div class="mt-6">
                    <a href="{{ route('pembeli.profile.edit') }}"
                        class="px-5 py-2 bg-blue-500 text-white rounded-xl shadow hover:bg-blue-600 transition">
                         Edit Biodata
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
