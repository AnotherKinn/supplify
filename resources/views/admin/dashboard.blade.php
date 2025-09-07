<x-app-layout>
    {{-- Main Content --}}
    <div class="flex min-h-screen bg-gray-200">
        <main class="flex-1 p-4 lg:p-8 mt-12 lg:mt-0">

            {{-- Grafik kiri + Statistik kanan --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Grafik Penjualan --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-sm lg:text-lg font-semibold mb-4">Grafik Penjualan Bulanan</h2>
                    <canvas id="salesChart" class="w-full h-full"></canvas>
                </div>

                {{-- Statistik --}}
                <div class="flex flex-col gap-6 h-full">
                    <div class="bg-white p-6 rounded-2xl shadow text-center flex-1 flex flex-col justify-center">
                        <h2 class="text-gray-500 text-sm">Total produk</h2>
                        <p class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $totalProduk }}</p>
                        <p class="text-xs text-gray-400">Since Last Month</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow text-center flex-1 flex flex-col justify-center">
                        <h2 class="text-gray-500 text-sm">Total pengguna</h2>
                        <p class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $totalPengguna }}</p>
                        <p class="text-xs text-gray-400">Since Last Month</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow text-center flex-1 flex flex-col justify-center">
                        <h2 class="text-gray-500 text-sm">Total transaksi</h2>
                        <p class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $totalTransaksi }}</p>
                        <p class="text-xs text-gray-400">Since Last Month</p>
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>

{{-- Script Toggle --}}
<script>
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('open-sidebar'); // tambahkan button ini di navbar mobile
    const closeBtn = document.getElementById('close-sidebar');

    openBtn ? .addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
    });

    closeBtn ? .addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
    });

</script>


{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Donut Chart
    const ctxProduct = document.getElementById('productChart');
    new Chart(ctxProduct, {
        type: 'doughnut',
        data: {
            labels: ['Vector', 'Template', 'Presentation'],
            datasets: [{
                data: [45, 35, 20],
                backgroundColor: ['#2563eb', '#000', '#d1d5db'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            cutout: '75%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Grafik Penjualan
    const ctxSales = document.getElementById('salesChart');
    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: @json($bulan),
            datasets: [{
                label: 'Total Penjualan',
                data: @json($penjualan),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#000'
                    }
                },
                y: {
                    ticks: {
                        color: '#000'
                    }
                }
            }
        }
    });

</script>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Chart
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($bulan),
            datasets: [{
                label: 'Total Penjualan',
                data: @json($penjualan),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    // Top Product Sale (Doughnut)
    const ctx2 = document.getElementById('productChart');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Vector', 'Template', 'Presentation'],
            datasets: [{
                data: [45, 35, 20],
                backgroundColor: ['#2563eb', '#60a5fa', '#93c5fd'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

</script>
