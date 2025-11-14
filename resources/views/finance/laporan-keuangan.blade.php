@extends('layouts.app')

@section('title', 'Laporan Jurnal')
@section('page-title', 'Laporan Jurnal')
@section('page-subtitle', 'Jurnal umum dari transaksi yang telah diverifikasi')

@section('content')
<div class="fade-in">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white border rounded-lg p-4 shadow-sm">
      <p class="text-xs text-gray-500">Total Debit</p>
      <p class="text-xl font-bold text-blue-600" id="totalDebit">Rp 0,00</p>
    </div>
    <div class="bg-white border rounded-lg p-4 shadow-sm">
      <p class="text-xs text-gray-500">Total Kredit</p>
      <p class="text-xl font-bold text-purple-600" id="totalCredit">Rp 0,00</p>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Jurnal Umum</h2>
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
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Akun</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Debit</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kredit</th>
          </tr>
        </thead>
        <tbody id="tableBody" class="bg-white divide-y divide-gray-200"></tbody>
      </table>
      <div id="noData" class="hidden text-center py-8 text-gray-500">Belum ada jurnal.</div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const el = (id) => document.getElementById(id);

    const formatRupiah = (num) => {
      if (!num || num == '0.00') return '-';
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
    };

    const formatDate = (iso) => {
      return new Date(iso).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    };

    async function load() {
      el('loading').classList.remove('hidden');
      try {
        const res = await fetch('/api/laporan-keuangan', { headers: { 'Accept': 'application/json' } });
        const json = await res.json();
        if (json.success) {
          render(json.data);
        }
      } catch (e) {
        alert('Gagal memuat laporan');
      } finally {
        el('loading').classList.add('hidden');
      }
    }

    function render(data) {
      const tbody = el('tableBody');
      tbody.innerHTML = '';
      let totalDebit = 0, totalCredit = 0;

      if (!data || data.length === 0) {
        el('noData').classList.remove('hidden');
        el('table').classList.add('hidden');
        el('totalDebit').textContent = 'Rp 0,00';
        el('totalCredit').textContent = 'Rp 0,00';
        return;
      }

      el('noData').classList.add('hidden');
      el('table').classList.remove('hidden');

      data.forEach(item => {
        const row = document.createElement('tr');
        const debit = parseFloat(item.debit || 0);
        const credit = parseFloat(item.credit || 0);

        totalDebit += debit;
        totalCredit += credit;

        row.innerHTML = `
          <td class="px-4 py-3 text-sm text-gray-600">${formatDate(item.created_at)}</td>
          <td class="px-4 py-3 text-sm font-mono">${item.transaction_ref || '-'}</td>
          <td class="px-4 py-3 text-sm">${item.account?.name || '–'}</td>
          <td class="px-4 py-3 text-sm max-w-xs truncate">${item.description || '-'}</td>
          <td class="px-4 py-3 text-sm text-blue-600">${debit > 0 ? formatRupiah(debit) : '-'}</td>
          <td class="px-4 py-3 text-sm text-purple-600">${credit > 0 ? formatRupiah(credit) : '-'}</td>
        `;
        tbody.appendChild(row);
      });

      el('totalDebit').textContent = formatRupiah(totalDebit);
      el('totalCredit').textContent = formatRupiah(totalCredit);
    }

    load();
  });
</script>
@endpush