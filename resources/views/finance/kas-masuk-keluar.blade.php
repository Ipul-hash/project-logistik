@extends('layouts.app')

@section('title', 'Kas Masuk & Keluar')
@section('page-title', 'Kas Masuk & Keluar')
@section('page-subtitle', 'Transaksi kas yang telah diverifikasi')

@section('content')
<div class="fade-in">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border rounded-lg p-4 shadow-sm">
      <p class="text-xs text-gray-500">Total Kas Masuk</p>
      <p class="text-xl font-bold text-green-600" id="totalIn">Rp 0,00</p>
    </div>
    <div class="bg-white border rounded-lg p-4 shadow-sm">
      <p class="text-xs text-gray-500">Total Kas Keluar</p>
      <p class="text-xl font-bold text-red-600" id="totalOut">Rp 0,00</p>
    </div>
    <div class="bg-white border rounded-lg p-4 shadow-sm">
      <p class="text-xs text-gray-500">Saldo Kas</p>
      <p class="text-xl font-bold text-blue-600" id="balance">Rp 0,00</p>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Transaksi Kas</h2>
      <button id="btnRefresh" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
        <i class="fas fa-sync-alt"></i> Refresh
      </button>
    </div>

    <div id="loading" class="hidden text-center py-6">
      <i class="fas fa-spinner fa-spin text-gray-500"></i> Memuat...
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 hidden" id="table">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ref</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Akun</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kas Masuk</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kas Keluar</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saldo</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="bg-white divide-y divide-gray-200"></tbody>
      </table>
      <div id="noData" class="hidden text-center py-8 text-gray-500">Belum ada transaksi kas.</div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const el = (id) => document.getElementById(id);
    let allData = [];

    const formatRupiah = (num) => {
      if (!num || num == '0.00') return '-';
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
    };

    const formatDate = (iso) => {
      return new Date(iso).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    };

    function render(data) {
      const tbody = el('tableBody');
      tbody.innerHTML = '';
      let totalIn = 0, totalOut = 0;

      if (!data || data.length === 0) {
        el('noData').classList.remove('hidden');
        el('table').classList.add('hidden');
        updateSummary(0, 0, 0);
        return;
      }

      el('noData').classList.add('hidden');
      el('table').classList.remove('hidden');

      data.forEach(item => {
        const row = document.createElement('tr');
        const isIncome = item.type === 'in';
        const amount = parseFloat(item.amount);

        if (isIncome) totalIn += amount;
        else totalOut += amount;

        const saldo = totalIn - totalOut;

        row.innerHTML = `
          <td class="px-4 py-3 text-sm text-gray-600">${formatDate(item.created_at)}</td>
          <td class="px-4 py-3 text-sm font-mono">${item.reference || '-'}</td>
          <td class="px-4 py-3 text-sm max-w-xs truncate">${item.description || '-'}</td>
          <td class="px-4 py-3 text-sm">${item.account?.name || '–'}</td>
          <td class="px-4 py-3 text-sm ${isIncome ? 'text-green-600' : ''}">
            ${isIncome ? formatRupiah(item.amount) : '-'}
          </td>
          <td class="px-4 py-3 text-sm ${!isIncome ? 'text-red-600' : ''}">
            ${!isIncome ? formatRupiah(item.amount) : '-'}
          </td>
          <td class="px-4 py-3 text-sm font-medium text-blue-600">${formatRupiah(saldo)}</td>
        `;
        tbody.appendChild(row);
      });

      updateSummary(totalIn, totalOut, totalIn - totalOut);
    }

    function updateSummary(income, expense, balance) {
      el('totalIn').textContent = formatRupiah(income);
      el('totalOut').textContent = formatRupiah(expense);
      el('balance').textContent = formatRupiah(balance);
    }

    async function load() {
      el('loading').classList.remove('hidden');
      try {
        const res = await fetch('/api/cash-flow?status=verified', { headers: { 'Accept': 'application/json' } });
        const json = await res.json();
        if (json.success) {
          allData = json.data;
          render(allData);
        }
      } catch (e) {
        alert('Gagal memuat data');
      } finally {
        el('loading').classList.add('hidden');
      }
    }

    el('btnRefresh').addEventListener('click', load);
    load();
  });
</script>
@endpush