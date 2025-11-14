@extends('layouts.app')

@section('title', 'Konfigurasi Sistem ERP')
@section('page-title', 'Konfigurasi Sistem ERP')
@section('page-subtitle', 'Pengaturan sistem, pajak, akun, dan backup')

@section('content')
<div class="fade-in">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Pengaturan Sistem ERP</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Setup Pajak -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Setup Pajak</h4>
                        <p class="text-sm text-gray-600 mb-4">Konfigurasi pajak PPN, PPh, dan pajak lainnya</p>
                        <button onclick="openTaxModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                            Atur Pajak
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kode Akun -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Kode Akun</h4>
                        <p class="text-sm text-gray-600 mb-4">Setup chart of accounts dan kode perkiraan</p>
                        <button onclick="openAccountModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                            Kelola Akun
                        </button>
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Metode Pembayaran</h4>
                        <p class="text-sm text-gray-600 mb-4">Tambah dan kelola metode pembayaran</p>
                        <button onclick="openPaymentModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                            Setup Payment
                        </button>
                    </div>
                </div>
            </div>

            <!-- Backup Data -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Backup Data</h4>
                        <p class="text-sm text-gray-600 mb-4">Backup dan restore database sistem</p>
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                                Backup Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Email Settings -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Email Settings</h4>
                        <p class="text-sm text-gray-600 mb-4">Konfigurasi SMTP dan email notifikasi</p>
                        <button onclick="openEmailModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                            Setup Email
                        </button>
                    </div>
                </div>
            </div>

            <!-- Warehouse Settings -->
            <div class="border rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 mb-2">Warehouse Settings</h4>
                        <p class="text-sm text-gray-600 mb-4">Kelola lokasi gudang dan cabang</p>
                        <button onclick="openWarehouseModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm transition">
                            Kelola Gudang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Sistem</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border-l-4 border-teal-500 pl-4">
                <p class="text-sm text-gray-600">Versi Aplikasi</p>
                <p class="text-lg font-bold text-gray-800 mt-1">v{{ config('app.version', '1.0.0') }}</p>
            </div>
            <div class="border-l-4 border-blue-500 pl-4">
                <p class="text-sm text-gray-600">Laravel Version</p>
                <p class="text-lg font-bold text-gray-800 mt-1">{{ app()->version() }}</p>
            </div>
            <div class="border-l-4 border-purple-500 pl-4">
                <p class="text-sm text-gray-600">PHP Version</p>
                <p class="text-lg font-bold text-gray-800 mt-1">{{ phpversion() }}</p>
            </div>
        </div>
    </div>

    <!-- Last Backup Info -->
    <div class="mt-6 bg-gradient-to-r from-teal-50 to-blue-50 rounded-xl shadow-sm p-6 border border-teal-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-teal-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Backup Terakhir</p>
                    <p class="text-lg font-bold text-gray-800">{{ $lastBackup ?? 'Belum pernah backup' }}</p>
                </div>
            </div>
            <div>
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    ✓ System Healthy
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pajak -->
<div id="taxModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b flex justify-between items-center sticky top-0 bg-white">
            <h3 class="text-xl font-bold text-gray-800">Setup Pajak</h3>
            <button onclick="closeTaxModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PPN (%)</label>
                        <input type="number" name="ppn" value="11" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PPh 21 (%)</label>
                        <input type="number" name="pph21" value="5" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PPh 23 (%)</label>
                        <input type="number" name="pph23" value="2" step="0.01" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeTaxModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Metode Pembayaran -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b flex justify-between items-center sticky top-0 bg-white">
            <h3 class="text-xl font-bold text-gray-800">Metode Pembayaran</h3>
            <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div class="mb-6">
                <h4 class="font-semibold mb-4">Metode Pembayaran Aktif</h4>
                <div class="space-y-2">
                    @foreach(['Cash', 'Transfer Bank', 'Kartu Kredit', 'E-Wallet'] as $method)
                    <div class="flex items-center justify-between p-3 border rounded-lg">
                        <span class="font-medium">{{ $method }}</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button onclick="closePaymentModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openTaxModal() {
        document.getElementById('taxModal').classList.remove('hidden');
    }
    
    function closeTaxModal() {
        document.getElementById('taxModal').classList.add('hidden');
    }
    
    function openPaymentModal() {
        document.getElementById('paymentModal').classList.remove('hidden');
    }
    
    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }
    
    function openAccountModal() {
        showNotification('Modal chart of accounts akan dibuka', 'info');
    }
    
    function openEmailModal() {
        showNotification('Modal email settings akan dibuka', 'info');
    }
    
    function openWarehouseModal() {
        showNotification('Modal warehouse settings akan dibuka', 'info');
    }
</script>
@endpush