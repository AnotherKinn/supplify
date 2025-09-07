<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white tracking-wide">
            Manajemen pengguna
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fadeIn">

        {{-- 🔍 Search & Filter --}}
        <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.users.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search --}}
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau email..."
                    class="col-span-2 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                           text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">

                {{-- Filter Role --}}
                <select name="role"
                    class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                           text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-700 
                           focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option value="">Semua Role</option>
                    <option value="penjual" {{ request('role') == 'penjual' ? 'selected' : '' }}>Penjual</option>
                    <option value="pembeli" {{ request('role') == 'pembeli' ? 'selected' : '' }}>Pembeli</option>
                </select>

                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold p-2 rounded-lg shadow-md transition text-sm">
                    Terapkan Filter
                </button>
            </form>
        </div>

        <div class="bg-[#FAE3AC] shadow-lg rounded-xl p-6">
            @if(session('success'))
                <div class="mb-4 text-[#2D3250] dark:text-[#FAE3AC] bg-[#FAE3AC]/40 dark:bg-[#2D3250]/50 p-3 rounded-lg shadow-sm border border-[#2D3250]/20">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Daftar Pengguna</h2>
                <a href="{{ route('admin.users.exportIndexPdf', request()->only('role', 'search')) }}"
                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition-colors duration-200">
                    📄 Export PDF
                </a>
            </div>

            {{-- ✅ Versi Desktop: Table --}}
            <div class="hidden md:block p-6 text-[#2D3250] dark:text-[#FAE3AC]">
                <div class="overflow-x-auto rounded-lg border border-[#2D3250]/20 dark:border-[#FAE3AC]/20">
                    <table class="min-w-full text-sm text-left border-collapse">
                        <thead class="bg-[#2D3250] text-[#FAE3AC] uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-[#1f2236]">
                            @forelse ($users as $user)
                                <tr class="hover:bg-[#FAE3AC]/30 dark:hover:bg-[#2D3250]/70 transition-colors">
                                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-lg text-xs font-medium 
                                                {{ $user->role === 'admin' ? 'bg-[#2D3250] text-[#FAE3AC] border border-[#FAE3AC]' : 'bg-[#FAE3AC] text-[#2D3250] border border-[#2D3250]' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="px-3 py-1 rounded-lg text-sm font-medium border border-[#2D3250] text-[#2D3250] hover:bg-[#2D3250] hover:text-[#FAE3AC] transition dark:border-[#FAE3AC] dark:text-[#FAE3AC] dark:hover:bg-[#FAE3AC] dark:hover:text-[#2D3250]">
                                            Detail
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete px-3 py-1 rounded-lg text-sm font-medium border border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-[#2D3250]/70 dark:text-[#FAE3AC]/70">
                                        Belum ada user selain admin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 📱 Versi Mobile: Card --}}
            <div class="block md:hidden space-y-4">
                @forelse ($users as $user)
                    <div class="bg-white dark:bg-[#1f2236] rounded-lg shadow p-4 text-sm">
                        <p class="font-semibold text-gray-800 dark:text-white text-base">{{ $user->name }}</p>
                        <p class="text-gray-600 dark:text-gray-300 text-xs">{{ $user->email }}</p>
                        <p class="mt-2">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                    {{ $user->role === 'admin' ? 'bg-[#2D3250] text-[#FAE3AC] border border-[#FAE3AC]' : 'bg-[#FAE3AC] text-[#2D3250] border border-[#2D3250]' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                        <div class="flex gap-2 mt-3">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="flex-1 px-3 py-1 rounded-lg text-xs font-medium border border-[#2D3250] text-[#2D3250] hover:bg-[#2D3250] hover:text-[#FAE3AC] transition dark:border-[#FAE3AC] dark:text-[#FAE3AC] dark:hover:bg-[#FAE3AC] dark:hover:text-[#2D3250] text-center">
                                Detail
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-1 form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete w-full px-3 py-1 rounded-lg text-xs font-medium border border-red-600 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 dark:text-gray-400 text-sm">Belum ada user selain admin.</p>
                @endforelse
            </div>

            {{-- 📄 Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-in-out; }
    </style>
</x-app-layout>

<script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>

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

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus user ini?',
                text: "Tindakan ini tidak bisa dibatalkan!",
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
