@extends('layouts.app')

@section('title', 'Dashboard ERP Logistik')
@section('page-title', 'Dashboard Monitoring')
@section('page-subtitle', 'Statistik transaksi per hari/bulan')

@section('content')
<div class="fade-in">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Transaksi Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2" data-stat="transaction">{{ $stats['total_transaksi'] ?? 248 }}</p>
                    <p class="text-green-600 text-sm mt-1">↑ 12% dari kemarin</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($stats['pendapatan'] ?? 45200000, 0, ',', '.') }}</p>
                    <p class="text-green-600 text-sm mt-1">↑ 8% dari kemarin</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Stok Minimum Alert</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2" data-stat="stock">{{ $stats['stok_alert'] ?? 23 }}</p>
                    <p class="text-orange-600 text-sm mt-1">Perlu restock segera</p>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Transaksi Pending</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2" data-stat="pending">{{ $stats['pending'] ?? 12 }}</p>
                    <p class="text-red-600 text-sm mt-1">Perlu validasi</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Penjualan Bulanan</h3>
            <div class="h-64 flex items-center justify-center bg-gradient-to-br from-teal-50 to-blue-50 rounded-lg">
                <p class="text-gray-500">Chart Area - Integrasi Chart.js</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Top 5 Produk Terlaris</h3>
            <div class="space-y-3">
                @foreach([
                    ['name' => 'Produk A', 'sales' => 1234, 'percentage' => 85],
                    ['name' => 'Produk B', 'sales' => 1098, 'percentage' => 72],
                    ['name' => 'Produk C', 'sales' => 892, 'percentage' => 60],
                    ['name' => 'Produk D', 'sales' => 756, 'percentage' => 48],
                    ['name' => 'Produk E', 'sales' => 623, 'percentage' => 38]
                ] as $item)
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">{{ $item['name'] }}</span>
                        <span class="text-sm text-gray-500">{{ $item['sales'] }} unit</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-teal-600 h-2 rounded-full" style="width: {{ $item['percentage'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Transaksi Terbaru</h3>
            <a href="#" class="text-teal-600 hover:text-teal-700 text-sm font-medium">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-500 text-sm border-b">
                        <th class="pb-3 font-medium">No. Transaksi</th>
                        <th class="pb-3 font-medium">Tanggal</th>
                        <th class="pb-3 font-medium">Customer</th>
                        <th class="pb-3 font-medium">Total</th>
                        <th class="pb-3 font-medium">Status</th>
                        <th class="pb-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions ?? [] as $trx)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-4 font-semibold text-gray-800">{{ $trx->no_transaksi }}</td>
                        <td class="py-4 text-gray-600">{{ $trx->tanggal->format('d M Y') }}</td>
                        <td class="py-4 text-gray-600">{{ $trx->customer }}</td>
                        <td class="py-4 font-semibold text-gray-800">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-{{ $trx->status_color }}-100 text-{{ $trx->status_color }}-800 rounded-full text-xs font-medium">
                                {{ $trx->status }}
                            </span>
                        </td>
                        <td class="py-4">
                            <a href="#" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">Belum ada transaksi hari ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Real-time updates (optional)
    setInterval(() => {
        // Fetch updated stats via AJAX if needed
        console.log('Stats updated');
    }, 30000);
</script>
@endpush