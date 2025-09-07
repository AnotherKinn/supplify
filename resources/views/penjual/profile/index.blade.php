<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Biodata Perusahaan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 shadow-md rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100">

                    {{-- Alert --}}
                    @if(session('success'))
                        <div class="mb-4 flex items-center gap-2 p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg text-sm font-medium">
                            ✅ {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 flex items-center gap-2 p-4 text-red-800 bg-red-100 border border-red-300 rounded-lg text-sm font-medium">
                            ⚠ {{ session('error') }}
                        </div>
                    @endif

                    {{-- Header Profile --}}
                    <div class="flex items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-blue-600 text-white text-xl font-bold">
                            {{ strtoupper(substr($penjual->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">{{ $penjual->name }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $penjual->email }}</p>
                        </div>
                    </div>

                    {{-- Detail Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mt-6 text-sm">
                        <div>
                            <p class="font-semibold">Alamat</p>
                            <p>{{ $penjual->profile->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">No HP</p>
                            <p>{{ $penjual->profile->no_hp ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="font-semibold">Nama Perusahaan</p>
                            <p>{{ $penjual->profile->nama_perusahaan ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Action --}}
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('penjual.profile.edit') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl shadow-md hover:bg-blue-700 transition-all duration-300">
                            Edit Biodata
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>