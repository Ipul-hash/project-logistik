@extends('layouts.app')

@section('title', 'Rekonsiliasi & Validasi')
@section('page-title', 'Rekonsiliasi & Validasi')
@section('page-subtitle', 'Verifikasi transaksi keuangan sebelum masuk ke buku kas')

@section('content')
<div class="fade-in">
  <!-- Summary Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border-l-4 border-yellow-500 rounded-lg p-4 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500">Menunggu Verifikasi</p>
          <p class="text-xl font-bold text-yellow-600" id="countPending">0</p>
        </div>
        <i class="fas fa-clock text-yellow-500 text-lg"></i>
      </div>
    </div>
    <div class="bg-white border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500">Diverifikasi</p>
          <p class="text-xl font-bold text-green-600" id="countVerified">0</p>
        </div>
        <i class="fas fa-check-circle text-green-500 text-lg"></i>
      </div>
    </div>
    <div class="bg-white border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs text-gray-500">Ditolak</p>
          <p class="text-xl font-bold text-red-600" id="countRejected">0</p>
        </div>
        <i class="fas fa-times-circle text-red-500 text-lg"></i>
      </div>
    </div>
  </div>

  <!-- Main Table -->
  <div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Transaksi</h2>
      <button id="btnRefresh" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
        <i class="fas fa-sync-alt"></i> Refresh
      </button>
    </div>

    <div id="loading" class="hidden text-center py-6">
      <i class="fas fa-spinner fa-spin text-gray-500 text-xl"></i> Memuat data rekonsiliasi...
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 hidden" id="table">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akun</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Oleh</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="bg-white divide-y divide-gray-200"></tbody>
      </table>
      <div id="noData" class="hidden text-center py-8 text-gray-500">Tidak ada transaksi untuk diverifikasi.</div>
    </div>
  </div>
</div>

<!-- Verifikasi Modal -->
<div id="verifyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-800">Verifikasi Transaksi</h3>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select id="modalStatus" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
          <option value="verified">✅ Verifikasi (Setujui)</option>
          <option value="rejected">❌ Tolak</option>
        </select>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
        <textarea id="modalNote" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Alasan penolakan atau catatan verifikasi..."></textarea>
      </div>

      <div class="flex justify-end gap-3">
        <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
        <button onclick="submitVerification()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="hidden fixed bottom-6 right-6 z-50 px-4 py-3 bg-green-600 text-white rounded-lg shadow-lg flex items-center gap-2">
  <i class="fas fa-check-circle"></i>
  <span id="toastMessage">Berhasil!</span>
</div>

@endsection

@push('scripts')
<script>
  let currentTransactionId = null;

  // Utility
  const el = (id) => document.getElementById(id);
  const showLoading = () => el('loading').classList.remove('hidden');
  const hideLoading = () => el('loading').classList.add('hidden');

  // Format
  const formatRupiah = (num) => {
    if (!num || num == '0.00') return '-';
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
  };
  const formatDate = (iso) => new Date(iso).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });

  // Toast
  function showToast(message, type = 'success') {
    const toast = el('toast');
    el('toastMessage').textContent = message;
    toast.className = toast.className.replace(/bg-\w+-600/g, '');
    
    if (type === 'error') {
      toast.classList.add('bg-red-600');
    } else {
      toast.classList.add('bg-green-600');
    }
    
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
  }

  // Render table & summary
  function render(data) {
    const tbody = el('tableBody');
    tbody.innerHTML = '';

    // Hitung status
    const stats = { pending: 0, verified: 0, rejected: 0 };
    data.forEach(item => {
      if (item.status === 'verified') stats.verified++;
      else if (item.status === 'rejected') stats.rejected++;
      else stats.pending++;
    });

    el('countPending').textContent = stats.pending;
    el('countVerified').textContent = stats.verified;
    el('countRejected').textContent = stats.rejected;

    if (!data || data.length === 0) {
      el('noData').classList.remove('hidden');
      el('table').classList.add('hidden');
      return;
    }

    el('noData').classList.add('hidden');
    el('table').classList.remove('hidden');

    data.forEach(item => {
      const row = document.createElement('tr');
      const isIncome = item.type === 'in';
      const amount = isIncome ? `+ ${formatRupiah(item.amount)}` : `- ${formatRupiah(item.amount)}`;
      const amountColor = isIncome ? 'text-green-600' : 'text-red-600';

      // Badge status
      let statusBadge = '';
      if (item.status === 'verified') {
        statusBadge = '<span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Diverifikasi</span>';
      } else if (item.status === 'rejected') {
        statusBadge = '<span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Ditolak</span>';
      } else {
        statusBadge = '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>';
      }

      row.innerHTML = `
        <td class="px-4 py-3 text-sm text-gray-600">${formatDate(item.created_at)}</td>
        <td class="px-4 py-3 text-sm font-mono">${item.reference || '-'}</td>
        <td class="px-4 py-3 text-sm max-w-xs truncate">${item.description || '-'}</td>
        <td class="px-4 py-3 text-sm">${item.account?.name || '–'}</td>
        <td class="px-4 py-3 text-sm ${amountColor}">${amount}</td>
        <td class="px-4 py-3 text-sm">${item.creator?.name || 'Sistem'}</td>
        <td class="px-4 py-3">
          ${item.status === 'pending' ? `
            <button onclick="openVerifyModal(${item.id})" class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
              <i class="fas fa-check"></i> Verifikasi
            </button>
          ` : statusBadge}
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  // Load data
  async function load() {
    showLoading();
    try {
      const res = await fetch('/api/cash-flow', { headers: { 'Accept': 'application/json' } });
      const json = await res.json();
      if (json.success) {
        render(json.data);
      } else {
        throw new Error(json.message || 'Gagal memuat');
      }
    } catch (e) {
      showToast('Gagal memuat data: ' + e.message, 'error');
    } finally {
      hideLoading();
    }
  }

  // Modal
  function openVerifyModal(id) {
    currentTransactionId = id;
    el('modalStatus').value = 'verified';
    el('modalNote').value = '';
    el('verifyModal').classList.remove('hidden');
  }

  function closeModal() {
    el('verifyModal').classList.add('hidden');
  }

  // Submit verification
  async function submitVerification() {
    const status = el('modalStatus').value;
    const note = el('modalNote').value.trim();

    try {
      const res = await fetch(`/api/cash-flow/${currentTransactionId}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ 
          status: status,
          description: note || null
        })
      });

      const json = await res.json();
      if (json.success) {
        showToast(status === 'verified' ? 'Transaksi berhasil diverifikasi!' : 'Transaksi ditolak.');
        load();
        closeModal();
      } else {
        throw new Error(json.message || 'Gagal menyimpan');
      }
    } catch (e) {
      showToast('Error: ' + e.message, 'error');
    }
  }

  // Init
  el('btnRefresh').addEventListener('click', load);
  document.addEventListener('click', (e) => {
    if (e.target.closest('#verifyModal') === null && !e.target.closest('button')?.onclick?.toString()?.includes('openVerifyModal')) {
      // Biarkan modal tertutup hanya via tombol close
    }
  });

  load();
</script>
@endpush