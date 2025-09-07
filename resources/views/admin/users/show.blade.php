<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#2D3250] dark:text-gray-200 leading-tight">
            Detail User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FAE3AC] shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <table class="w-full border-collapse text-black">
                        <tbody>
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 w-1/4 font-medium">Nama</th>
                                <td class="py-3 px-4">{{ $user->name }}</td>
                            </tr>
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 font-medium">Email</th>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                            </tr>
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 font-medium">Role</th>
                                <td class="py-3 px-4">{{ ucfirst($user->role) }}</td>
                            </tr>

                            {{-- Data dari tabel profiles --}}
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 font-medium">Alamat</th>
                                <td class="py-3 px-4">{{ $user->profile->alamat ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 font-medium">No. HP</th>
                                <td class="py-3 px-4">{{ $user->profile->no_hp ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-[#2D3250]/20">
                                <th class="text-left py-3 px-4 font-medium">Email Kontak</th>
                                <td class="py-3 px-4">{{ $user->profile->email_kontak ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-left py-3 px-4 font-medium">Nama Perusahaan</th>
                                <td class="py-3 px-4">{{ $user->profile->nama_perusahaan ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="pt-6">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#2D3250] text-white text-sm font-medium rounded-lg shadow hover:bg-[#1E2238] transition-colors duration-200">
                            ← Kembali ke daftar user
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
