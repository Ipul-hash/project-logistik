<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ERP Logistik - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        // Helper functions
        function showAddUser() {
            showNotification('Form tambah user akan dibuka');
        }

        function showAddProduct() {
            showNotification('Form tambah barang akan dibuka');
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-20 right-6 bg-teal-600 text-white px-6 py-4 rounded-lg shadow-2xl z-50 fade-in flex items-center gap-3';
            notification.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>${message}</span>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Simulated real-time updates
        let transactionCount = 248;
        let pendingValidation = 12;
        let stockAlert = 23;

        function simulateRealTimeUpdate() {
            setInterval(() => {
                // Random chance to update transaction count
                if (Math.random() > 0.7) {
                    transactionCount++;
                    updateDashboardStats();
                }

                // Random chance to resolve pending validation
                if (Math.random() > 0.85 && pendingValidation > 0) {
                    pendingValidation--;
                    updateDashboardStats();
                    showNotification('Transaksi berhasil divalidasi!');
                }

                // Random chance to update stock alert
                if (Math.random() > 0.9 && stockAlert > 0) {
                    stockAlert--;
                    updateDashboardStats();
                }
            }, 10000); // Update every 10 seconds
        }

        function updateDashboardStats() {
            // Update stats if on dashboard
            const transactionEl = document.querySelector('[data-stat="transaction"]');
            const pendingEl = document.querySelector('[data-stat="pending"]');
            const stockEl = document.querySelector('[data-stat="stock"]');

            if (transactionEl) transactionEl.textContent = transactionCount;
            if (pendingEl) pendingEl.textContent = pendingValidation;
            if (stockEl) stockEl.textContent = stockAlert;
        }

        // Add smooth scroll behavior
        document.addEventListener('DOMContentLoaded', function() {
            const navButtons = document.querySelectorAll('.nav-btn');
            navButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Scroll to top smoothly
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[type="text"][placeholder*="Cari"]');
                if (searchInput) {
                    searchInput.focus();
                    showNotification('Search activated (Ctrl+K)');
                }
            }

            // Ctrl/Cmd + N for new transaction
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                switchTab('transaksi-penjualan');
                showNotification('New transaction form opened (Ctrl+N)');
            }

            // Ctrl/Cmd + D for dashboard
            if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
                e.preventDefault();
                switchTab('dashboard');
                showNotification('Dashboard view (Ctrl+D)');
            }
        });

        // Add export functionality
        function exportToPDF() {
            showNotification('Mengekspor laporan ke PDF...');
            setTimeout(() => {
                showNotification('✓ Laporan PDF berhasil diunduh!');
            }, 2000);
        }

        function exportToExcel() {
            showNotification('Mengekspor laporan ke Excel...');
            setTimeout(() => {
                showNotification('✓ Laporan Excel berhasil diunduh!');
            }, 2000);
        }

        // Add data refresh functionality
        function refreshData() {
            showNotification('Memperbarui data...');
            setTimeout(() => {
                showNotification('✓ Data berhasil diperbarui!');
                // Re-render current tab
                const activeTab = document.querySelector('.nav-btn.bg-teal-600');
                if (activeTab) {
                    const tabName = activeTab.getAttribute('data-tab');
                    switchTab(tabName);
                }
            }, 1500);
        }

        // Add auto-refresh every 30 seconds
        setInterval(() => {
            const activeTab = document.querySelector('.nav-btn.bg-teal-600');
            if (activeTab && activeTab.getAttribute('data-tab') === 'dashboard') {
                updateDashboardStats();
            }
        }, 30000);

        // Add print functionality
        function printReport() {
            showNotification('Menyiapkan dokumen untuk cetak...');
            setTimeout(() => {
                window.print();
            }, 500);
        }

        // Add confirmation dialogs
        function confirmDelete(itemName) {
            return confirm(`Apakah Anda yakin ingin menghapus ${itemName}?`);
        }

        function confirmSave() {
            const result = confirm('Simpan perubahan data?');
            if (result) {
                showNotification('✓ Data berhasil disimpan!');
                return true;
            }
            return false;
        }

        // Add form validation helper
        function validateForm(formData) {
            const errors = [];
            
            if (!formData.customer || formData.customer.trim() === '') {
                errors.push('Nama customer harus diisi');
            }
            
            if (!formData.items || formData.items.length === 0) {
                errors.push('Minimal harus ada 1 item barang');
            }
            
            if (errors.length > 0) {
                alert('Validasi Error:\n' + errors.join('\n'));
                return false;
            }
            
            return true;
        }

        // Add currency formatter
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Add date formatter
        function formatDate(date) {
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }).format(new Date(date));
        }

        // Add loading indicator
        function showLoading() {
            const loading = document.createElement('div');
            loading.id = 'loadingIndicator';
            loading.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loading.innerHTML = `
                <div class="bg-white rounded-lg p-8 flex flex-col items-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-teal-600 mb-4"></div>
                    <p class="text-gray-700 font-medium">Memuat data...</p>
                </div>
            `;
            document.body.appendChild(loading);
        }

        function hideLoading() {
            const loading = document.getElementById('loadingIndicator');
            if (loading) {
                loading.remove();
            }
        }

        // Add modal functionality
        function showModal(title, content) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 fade-in';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                    <div class="p-6 border-b flex justify-between items-center sticky top-0 bg-white">
                        <h3 class="text-xl font-bold text-gray-800">${title}</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        ${content}
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Close on outside click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        // Add chart placeholder animation
        function animateChartPlaceholder() {
            const chartPlaceholders = document.querySelectorAll('[data-chart-placeholder]');
            chartPlaceholders.forEach(placeholder => {
                placeholder.style.animation = 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite';
            });
        }

        // Add table sorting
        function sortTable(tableId, columnIndex, ascending = true) {
            const table = document.getElementById(tableId);
            if (!table) return;
            
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent.trim();
                const bValue = b.cells[columnIndex].textContent.trim();
                
                if (ascending) {
                    return aValue.localeCompare(bValue);
                } else {
                    return bValue.localeCompare(aValue);
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
            showNotification('Tabel berhasil diurutkan');
        }

        // Add search functionality
        function searchTable(searchTerm, tableId) {
            const table = document.getElementById(tableId);
            if (!table) return;
            
            const tbody = table.querySelector('tbody');
            const rows = tbody.querySelectorAll('tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm.toLowerCase())) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            if (visibleCount === 0) {
                showNotification(`Tidak ada hasil untuk "${searchTerm}"`);
            }
        }

        // Add pagination helper
        function paginate(items, page = 1, perPage = 10) {
            const start = (page - 1) * perPage;
            const end = start + perPage;
            return {
                items: items.slice(start, end),
                totalPages: Math.ceil(items.length / perPage),
                currentPage: page
            };
        }

        // Add local storage helper for user preferences
        function savePreference(key, value) {
            try {
                // Using in-memory storage since localStorage is not available
                window.userPreferences = window.userPreferences || {};
                window.userPreferences[key] = value;
            } catch (e) {
                console.log('Could not save preference');
            }
        }

        function getPreference(key, defaultValue) {
            try {
                window.userPreferences = window.userPreferences || {};
                return window.userPreferences[key] || defaultValue;
            } catch (e) {
                return defaultValue;
            }
        }

        // Initialize everything
        window.onload = function() {
            init();
            simulateRealTimeUpdate();
            
            // Show welcome message
            setTimeout(() => {
                showNotification('Selamat datang di ERP Logistik!');
            }, 500);
            
            // Add keyboard shortcuts hint
            setTimeout(() => {
                console.log('%c⌨️ Keyboard Shortcuts:', 'font-size: 16px; font-weight: bold; color: #0d9488;');
                console.log('Ctrl+K: Search');
                console.log('Ctrl+N: New Transaction');
                console.log('Ctrl+D: Dashboard');
            }, 1000);
        };
    </script>
</body>
</html>@keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        .progress-ring {
            transform: rotate(-90deg);
        }
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-teal-700 to-teal-900 shadow-2xl flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-teal-600">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-teal-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">ERP Logistik</h1>
                        <p class="text-teal-200 text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-2 sidebar-scrollbar">
                <!-- Admin Module -->
                <div class="mb-4">
                    <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Admin</p>
                    <button onclick="switchTab('dashboard')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="dashboard">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <span class="text-sm font-medium">Dashboard Monitoring</span>
                    </button>
                    <button onclick="switchTab('config')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="config">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Konfigurasi Sistem</span>
                    </button>
                    <button onclick="switchTab('user-management')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="user-management">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        <span class="text-sm font-medium">Manajemen Role & User</span>
                    </button>
                </div>

                <!-- Kasir Module -->
                <div class="mb-4">
                    <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Kasir</p>
                    <button onclick="switchTab('transaksi-penjualan')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="transaksi-penjualan">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Transaksi Penjualan</span>
                    </button>
                    <button onclick="switchTab('retur')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="retur">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Retur & Pengembalian</span>
                    </button>
                    <button onclick="switchTab('laporan-penjualan')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="laporan-penjualan">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Laporan Penjualan</span>
                    </button>
                </div>

                <!-- Finance Module -->
                <div class="mb-4">
                    <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Finance</p>
                    <button onclick="switchTab('kas-keluar')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="kas-keluar">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Kas Masuk & Keluar</span>
                    </button>
                    <button onclick="switchTab('rekonsiliasi')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="rekonsiliasi">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Rekonsiliasi & Validasi</span>
                    </button>
                    <button onclick="switchTab('laporan-keuangan')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="laporan-keuangan">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        <span class="text-sm font-medium">Laporan Keuangan</span>
                    </button>
                </div>

                <!-- Gudang Module -->
                <div class="mb-4">
                    <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Gudang</p>
                    <button onclick="switchTab('manajemen-barang')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="manajemen-barang">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Manajemen Barang</span>
                    </button>
                    <button onclick="switchTab('barang-masuk-keluar')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="barang-masuk-keluar">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                        <span class="text-sm font-medium">Barang Masuk & Keluar</span>
                    </button>
                    <button onclick="switchTab('laporan-stok')" class="nav-btn w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-teal-600 transition" data-tab="laporan-stok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                        </svg>
                        <span class="text-sm font-medium">Laporan Stok</span>
                    </button>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-teal-600">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-teal-300 rounded-full flex items-center justify-center">
                        <span class="text-teal-800 font-bold">A</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-medium text-sm">Admin User</p>
                        <p class="text-teal-300 text-xs">Administrator</p>
                    </div>
                    <button class="text-teal-300 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gray-50">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800" id="pageTitle">Dashboard Monitoring</h1>
                        <p class="text-gray-500 text-sm mt-1">Statistik transaksi per hari/bulan</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari data..." class="px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent w-64">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <button class="relative p-2 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800" id="currentDate"></p>
                            <p class="text-xs text-gray-500" id="currentTime"></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div id="content" class="p-8">
                <!-- Dashboard Content will be loaded here -->
            </div>
        </main>
    </div>

    <script>
        // Initialize
        function init() {
            updateDateTime();
            setInterval(updateDateTime, 1000);
            switchTab('dashboard');
        }

        function updateDateTime() {
            const now = new Date();
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
            
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', dateOptions);
            document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', timeOptions);
        }

        function switchTab(tab) {
            // Update active nav button
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-teal-600', 'shadow-lg');
            });
            const activeBtn = document.querySelector(`[data-tab="${tab}"]`);
            if (activeBtn) {
                activeBtn.classList.add('bg-teal-600', 'shadow-lg');
            }

            const content = document.getElementById('content');
            const pageTitle = document.getElementById('pageTitle');

            switch(tab) {
                case 'dashboard':
                    pageTitle.textContent = 'Dashboard Monitoring';
                    content.innerHTML = renderDashboard();
                    break;
                case 'config':
                    pageTitle.textContent = 'Konfigurasi Sistem ERP';
                    content.innerHTML = renderConfig();
                    break;
                case 'user-management':
                    pageTitle.textContent = 'Manajemen Role dan User';
                    content.innerHTML = renderUserManagement();
                    break;
                case 'transaksi-penjualan':
                    pageTitle.textContent = 'Transaksi Penjualan';
                    content.innerHTML = renderTransaksiPenjualan();
                    break;
                case 'retur':
                    pageTitle.textContent = 'Retur Barang & Pengembalian';
                    content.innerHTML = renderRetur();
                    break;
                case 'laporan-penjualan':
                    pageTitle.textContent = 'Laporan Penjualan';
                    content.innerHTML = renderLaporanPenjualan();
                    break;
                case 'kas-keluar':
                    pageTitle.textContent = 'Kas Masuk & Keluar';
                    content.innerHTML = renderKasMasukKeluar();
                    break;
                case 'rekonsiliasi':
                    pageTitle.textContent = 'Rekonsiliasi & Validasi';
                    content.innerHTML = renderRekonsiliasi();
                    break;
                case 'laporan-keuangan':
                    pageTitle.textContent = 'Laporan Keuangan';
                    content.innerHTML = renderLaporanKeuangan();
                    break;
                case 'manajemen-barang':
                    pageTitle.textContent = 'Manajemen Barang';
                    content.innerHTML = renderManajemenBarang();
                    break;
                case 'barang-masuk-keluar':
                    pageTitle.textContent = 'Barang Masuk dan Keluar';
                    content.innerHTML = renderBarangMasukKeluar();
                    break;
                case 'laporan-stok':
                    pageTitle.textContent = 'Laporan Stok';
                    content.innerHTML = renderLaporanStok();
                    break;
            }
        }

        // Dashboard Content
        function renderDashboard() {
            return `
                <div class="fade-in">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500 text-sm font-medium">Total Transaksi Hari Ini</p>
                                    <p class="text-3xl font-bold text-gray-800 mt-2">248</p>
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
                                    <p class="text-3xl font-bold text-gray-800 mt-2">Rp 45.2M</p>
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
                                    <p class="text-3xl font-bold text-gray-800 mt-2">23</p>
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
                                    <p class="text-3xl font-bold text-gray-800 mt-2">12</p>
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
                                ${[
                                    { name: 'Produk A', sales: 1234, percentage: 85 },
                                    { name: 'Produk B', sales: 1098, percentage: 72 },
                                    { name: 'Produk C', sales: 892, percentage: 60 },
                                    { name: 'Produk D', sales: 756, percentage: 48 },
                                    { name: 'Produk E', sales: 623, percentage: 38 }
                                ].map(item => `
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">${item.name}</span>
                                            <span class="text-sm text-gray-500">${item.sales} unit</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-teal-600 h-2 rounded-full" style="width: ${item.percentage}%"></div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Transaksi Terbaru</h3>
                            <button class="text-teal-600 hover:text-teal-700 text-sm font-medium">Lihat Semua</button>
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
                                    ${[
                                        { id: 'TRX-001', date: '12 Nov 2025', customer: 'PT Maju Jaya', total: 'Rp 2.5M', status: 'Selesai', statusColor: 'green' },
                                        { id: 'TRX-002', date: '12 Nov 2025', customer: 'CV Berkah', total: 'Rp 1.8M', status: 'Pending', statusColor: 'yellow' },
                                        { id: 'TRX-003', date: '11 Nov 2025', customer: 'UD Sejahtera', total: 'Rp 3.2M', status: 'Selesai', statusColor: 'green' },
                                        { id: 'TRX-004', date: '11 Nov 2025', customer: 'Toko Makmur', total: 'Rp 950K', status: 'Proses', statusColor: 'blue' },
                                        { id: 'TRX-005', date: '10 Nov 2025', customer: 'PT Gemilang', total: 'Rp 4.1M', status: 'Selesai', statusColor: 'green' }
                                    ].map(trx => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 font-semibold text-gray-800">${trx.id}</td>
                                            <td class="py-4 text-gray-600">${trx.date}</td>
                                            <td class="py-4 text-gray-600">${trx.customer}</td>
                                            <td class="py-4 font-semibold text-gray-800">${trx.total}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 bg-${trx.statusColor}-100 text-${trx.statusColor}-800 rounded-full text-xs font-medium">
                                                    ${trx.status}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <button class="text-teal-600 hover:text-teal-700 font-medium text-sm">Detail</button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderConfig() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Pengaturan Sistem ERP</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="border rounded-lg p-6 hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800 mb-3">Setup Pajak</h4>
                                <p class="text-sm text-gray-600 mb-4">Konfigurasi pajak PPN, PPh, dan pajak lainnya</p>
                                <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">Atur Pajak</button>
                            </div>
                            <div class="border rounded-lg p-6 hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800 mb-3">Kode Akun</h4>
                                <p class="text-sm text-gray-600 mb-4">Setup chart of accounts dan kode perkiraan</p>
                                <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">Kelola Akun</button>
                            </div>
                            <div class="border rounded-lg p-6 hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800 mb-3">Metode Pembayaran</h4>
                                <p class="text-sm text-gray-600 mb-4">Tambah dan kelola metode pembayaran</p>
                                <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">Setup Payment</button>
                            </div>
                            <div class="border rounded-lg p-6 hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800 mb-3">Backup Data</h4>
                                <p class="text-sm text-gray-600 mb-4">Backup dan restore database sistem</p>
                                <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">Backup Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderUserManagement() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Daftar User & Role</h3>
                            <button onclick="showAddUser()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                                + Tambah User
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">Nama</th>
                                        <th class="pb-3 font-medium">Email</th>
                                        <th class="pb-3 font-medium">Role</th>
                                        <th class="pb-3 font-medium">Status</th>
                                        <th class="pb-3 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${[
                                        { name: 'Admin Utama', email: 'admin@erp.com', role: 'Administrator', status: 'Aktif' },
                                        { name: 'Kasir 1', email: 'kasir1@erp.com', role: 'Kasir', status: 'Aktif' },
                                        { name: 'Finance Manager', email: 'finance@erp.com', role: 'Finance', status: 'Aktif' },
                                        { name: 'Gudang Staff', email: 'gudang@erp.com', role: 'Gudang', status: 'Aktif' }
                                    ].map(user => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center mr-3">
                                                        <span class="text-teal-700 font-semibold">${user.name[0]}</span>
                                                    </div>
                                                    <span class="font-medium text-gray-800">${user.name}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 text-gray-600">${user.email}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                                    ${user.role}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                                    ${user.status}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <button class="text-blue-600 hover:text-blue-700 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-700">Hapus</button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderTransaksiPenjualan() {
            return `
                <div class="fade-in">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Form Input -->
                        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Input Transaksi Baru</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Customer</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Masukkan nama customer">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Kontak</label>
                                        <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="08xx">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Perusahaan</label>
                                        <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Nama perusahaan">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Barang & Qty</label>
                                    <div class="flex gap-2">
                                        <select class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                                            <option>Pilih barang...</option>
                                            <option>Produk A - Rp 100,000</option>
                                            <option>Produk B - Rp 150,000</option>
                                            <option>Produk C - Rp 200,000</option>
                                        </select>
                                        <input type="number" class="w-24 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Qty">
                                        <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Tambah</button>
                                    </div>
                                </div>
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <p class="text-sm font-medium text-gray-600 mb-2">Item yang dipilih:</p>
                                    <div class="text-sm text-gray-500">Belum ada item</div>
                                </div>
                                <div class="flex justify-end gap-3 pt-4">
                                    <button class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                                    <button class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Simpan Transaksi</button>
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-semibold">Rp 0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pajak (11%)</span>
                                    <span class="font-semibold">Rp 0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Diskon</span>
                                    <span class="font-semibold">Rp 0</span>
                                </div>
                                <div class="border-t pt-3 flex justify-between">
                                    <span class="font-bold text-lg">Total</span>
                                    <span class="font-bold text-lg text-teal-600">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderRetur() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Proses Retur dengan Alasan</h3>
                            <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">+ Retur Baru</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">No. Retur</th>
                                        <th class="pb-3 font-medium">No. Transaksi</th>
                                        <th class="pb-3 font-medium">Tanggal</th>
                                        <th class="pb-3 font-medium">Produk</th>
                                        <th class="pb-3 font-medium">Alasan</th>
                                        <th class="pb-3 font-medium">Status</th>
                                        <th class="pb-3 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${[
                                        { no: 'RET-001', trx: 'TRX-045', date: '12 Nov 2025', product: 'Produk A', reason: 'Barang rusak', status: 'Diproses' },
                                        { no: 'RET-002', trx: 'TRX-032', date: '11 Nov 2025', product: 'Produk B', reason: 'Salah kirim', status: 'Selesai' }
                                    ].map(item => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 font-semibold">${item.no}</td>
                                            <td class="py-4 text-gray-600">${item.trx}</td>
                                            <td class="py-4 text-gray-600">${item.date}</td>
                                            <td class="py-4 text-gray-600">${item.product}</td>
                                            <td class="py-4 text-gray-600">${item.reason}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 ${item.status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'} rounded-full text-xs font-medium">
                                                    ${item.status}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <button class="text-blue-600 hover:text-blue-700">Detail</button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderLaporanPenjualan() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Filter Laporan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                                <input type="date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                                <input type="date" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                                    <option>Semua</option>
                                    <option>Selesai</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button class="w-full px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Tampilkan</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Ekspor Penjualan</h3>
                            <div class="flex gap-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                                    </svg>
                                    Export PDF
                                </button>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                                    </svg>
                                    Export Excel
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-500">Hasil laporan akan ditampilkan di sini berdasarkan filter yang dipilih.</p>
                    </div>
                </div>
            `;
        }

        function renderKasMasukKeluar() {
            return `
                <div class="fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                            <p class="text-sm opacity-90">Total Kas Masuk</p>
                            <p class="text-3xl font-bold mt-2">Rp 125.4M</p>
                            <p class="text-sm mt-2 opacity-75">Bulan ini</p>
                        </div>
                        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
                            <p class="text-sm opacity-90">Total Kas Keluar</p>
                            <p class="text-3xl font-bold mt-2">Rp 78.2M</p>
                            <p class="text-sm mt-2 opacity-75">Bulan ini</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                            <p class="text-sm opacity-90">Saldo Kas</p>
                            <p class="text-3xl font-bold mt-2">Rp 47.2M</p>
                            <p class="text-sm mt-2 opacity-75">Saldo akhir</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Kategori Transaksi</h3>
                            <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">+ Input Transaksi</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">Tanggal</th>
                                        <th class="pb-3 font-medium">Kategori</th>
                                        <th class="pb-3 font-medium">Keterangan</th>
                                        <th class="pb-3 font-medium">Kas Masuk</th>
                                        <th class="pb-3 font-medium">Kas Keluar</th>
                                        <th class="pb-3 font-medium">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${[
                                        { date: '12 Nov 2025', category: 'Penjualan', desc: 'Penjualan barang', in: 'Rp 5.2M', out: '-', balance: 'Rp 47.2M' },
                                        { date: '12 Nov 2025', category: 'Operasional', desc: 'Biaya listrik & air', in: '-', out: 'Rp 800K', balance: 'Rp 42.0M' },
                                        { date: '11 Nov 2025', category: 'Penjualan', desc: 'Penjualan barang', in: 'Rp 3.8M', out: '-', balance: 'Rp 42.8M' },
                                        { date: '11 Nov 2025', category: 'Pembelian', desc: 'Stok barang', in: '-', out: 'Rp 2.5M', balance: 'Rp 39.0M' }
                                    ].map(item => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 text-gray-600">${item.date}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                                    ${item.category}
                                                </span>
                                            </td>
                                            <td class="py-4 text-gray-600">${item.desc}</td>
                                            <td class="py-4 text-green-600 font-semibold">${item.in}</td>
                                            <td class="py-4 text-red-600 font-semibold">${item.out}</td>
                                            <td class="py-4 text-gray-800 font-semibold">${item.balance}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderRekonsiliasi() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Verifikasi Data dan Kasir</h3>
                        <p class="text-gray-600 mb-4">Tandai transaksi yang sudah diverifikasi / pending</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Total Transaksi</span>
                                    <span class="text-2xl font-bold text-gray-800">156</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Terverifikasi</span>
                                    <span class="text-2xl font-bold text-green-600">142</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 91%"></div>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Pending</span>
                                    <span class="text-2xl font-bold text-orange-600">14</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-orange-600 h-2 rounded-full" style="width: 9%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Daftar Transaksi Pending</h3>
                        <div class="space-y-3">
                            ${[
                                { id: 'TRX-089', customer: 'PT Sejahtera', amount: 'Rp 2.1M', date: '12 Nov 2025', reason: 'Menunggu konfirmasi pembayaran' },
                                { id: 'TRX-087', customer: 'CV Makmur', amount: 'Rp 1.5M', date: '11 Nov 2025', reason: 'Dokumen tidak lengkap' },
                                { id: 'TRX-082', customer: 'UD Gemilang', amount: 'Rp 3.2M', date: '10 Nov 2025', reason: 'Selisih kas' }
                            ].map(item => `
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="font-semibold text-gray-800">${item.id} - ${item.customer}</p>
                                            <p class="text-sm text-gray-600 mt-1">${item.reason}</p>
                                        </div>
                                        <span class="text-lg font-bold text-gray-800">${item.amount}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-3 pt-3 border-t">
                                        <span class="text-sm text-gray-500">${item.date}</span>
                                        <div class="flex gap-2">
                                            <button class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">Verifikasi</button>
                                            <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300">Detail</button>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
        }

        function renderLaporanKeuangan() {
            return `
                <div class="fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                            <p class="text-sm text-gray-600 mb-2">Laporan Harian</p>
                            <p class="text-2xl font-bold text-gray-800">Rp 45.2M</p>
                            <button class="mt-4 text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Detail →</button>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                            <p class="text-sm text-gray-600 mb-2">Laporan Mingguan</p>
                            <p class="text-2xl font-bold text-gray-800">Rp 289.5M</p>
                            <button class="mt-4 text-sm text-green-600 hover:text-green-700 font-medium">Lihat Detail →</button>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                            <p class="text-sm text-gray-600 mb-2">Laporan Bulanan</p>
                            <p class="text-2xl font-bold text-gray-800">Rp 1.2B</p>
                            <button class="mt-4 text-sm text-purple-600 hover:text-purple-700 font-medium">Lihat Detail →</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Neraca & Arus Kas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="border rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-3">Neraca</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Aset Lancar</span>
                                        <span class="font-semibold">Rp 125.4M</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Aset Tetap</span>
                                        <span class="font-semibold">Rp 450.2M</span>
                                    </div>
                                    <div class="flex justify-between text-sm pt-2 border-t">
                                        <span class="text-gray-700 font-medium">Total Aset</span>
                                        <span class="font-bold text-teal-600">Rp 575.6M</span>
                                    </div>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <h4 class="font-semibold text-gray-800 mb-3">Kas Otomatis</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Kas Masuk</span>
                                        <span class="font-semibold text-green-600">Rp 125.4M</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Kas Keluar</span>
                                        <span class="font-semibold text-red-600">Rp 78.2M</span>
                                    </div>
                                    <div class="flex justify-between text-sm pt-2 border-t">
                                        <span class="text-gray-700 font-medium">Saldo</span>
                                        <span class="font-bold text-blue-600">Rp 47.2M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Export Laporan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <button class="flex items-center justify-center gap-3 p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-teal-500 hover:bg-teal-50 transition">
                                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium text-gray-700">Download Laporan PDF</span>
                            </button>
                            <button class="flex items-center justify-center gap-3 p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-teal-500 hover:bg-teal-50 transition">
                                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium text-gray-700">Download Laporan Excel</span>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderManajemenBarang() {
            return `
                <div class="fade-in">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Daftar Barang</h3>
                            <button onclick="showAddProduct()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                                + Tambah Barang
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <input type="text" placeholder="Cari kode barang..." class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                            <input type="text" placeholder="Nama barang..." class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                            <input type="text" placeholder="Harga..." class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                            <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                                <option>Kategori</option>
                                <option>Elektronik</option>
                                <option>Furniture</option>
                                <option>Alat Tulis</option>
                            </select>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">Kode</th>
                                        <th class="pb-3 font-medium">Nama Barang</th>
                                        <th class="pb-3 font-medium">Kategori</th>
                                        <th class="pb-3 font-medium">Harga</th>
                                        <th class="pb-3 font-medium">Satuan</th>
                                        <th class="pb-3 font-medium">Stok</th>
                                        <th class="pb-3 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${[
                                        { code: 'BRG-001', name: 'Laptop HP', category: 'Elektronik', price: 'Rp 8.5M', unit: 'Unit', stock: 25 },
                                        { code: 'BRG-002', name: 'Meja Kantor', category: 'Furniture', price: 'Rp 1.2M', unit: 'Unit', stock: 12 },
                                        { code: 'BRG-003', name: 'Printer Canon', category: 'Elektronik', price: 'Rp 2.5M', unit: 'Unit', stock: 8 },
                                        { code: 'BRG-004', name: 'Kertas A4', category: 'Alat Tulis', price: 'Rp 45K', unit: 'Rim', stock: 150 }
                                    ].map(item => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 font-semibold text-gray-800">${item.code}</td>
                                            <td class="py-4 text-gray-600">${item.name}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                                    ${item.category}
                                                </span>
                                            </td>
                                            <td class="py-4 font-semibold text-gray-800">${item.price}</td>
                                            <td class="py-4 text-gray-600">${item.unit}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 ${item.stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'} rounded-full text-xs font-medium">
                                                    ${item.stock}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                <button class="text-blue-600 hover:text-blue-700 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-700">Hapus</button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderBarangMasukKeluar() {
            return `
                <div class="fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                Input Barang Masuk
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Pembelian / Retur Pelanggan</p>
                            <button class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                                + Tambah Barang Masuk
                            </button>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                Input Barang Keluar
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Penjualan / Transfer Antar Gudang</p>
                            <button class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                + Tambah Barang Keluar
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Riwayat Mutasi Stok</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500 text-sm border-b">
                                        <th class="pb-3 font-medium">Tanggal</th>
                                        <th class="pb-3 font-medium">Tipe</th>
                                        <th class="pb-3 font-medium">Barang</th>
                                        <th class="pb-3 font-medium">Jumlah</th>
                                        <th class="pb-3 font-medium">Supplier/Tujuan</th>
                                        <th class="pb-3 font-medium">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${[
                                        { date: '12 Nov 2025', type: 'Masuk', item: 'Laptop HP', qty: '+15', supplier: 'PT Elektronik Jaya', note: 'Pembelian stock' },
                                        { date: '12 Nov 2025', type: 'Keluar', item: 'Meja Kantor', qty: '-3', supplier: 'PT Sejahtera', note: 'Penjualan' },
                                        { date: '11 Nov 2025', type: 'Masuk', item: 'Printer Canon', qty: '+8', supplier: 'CV Teknologi', note: 'Restock' },
                                        { date: '11 Nov 2025', type: 'Keluar', item: 'Kertas A4', qty: '-25', supplier: 'Gudang B', note: 'Transfer gudang' }
                                    ].map(item => `
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 text-gray-600">${item.date}</td>
                                            <td class="py-4">
                                                <span class="px-3 py-1 ${item.type === 'Masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'} rounded-full text-xs font-medium">
                                                    ${item.type}
                                                </span>
                                            </td>
                                            <td class="py-4 font-semibold text-gray-800">${item.item}</td>
                                            <td class="py-4 font-bold ${item.type === 'Masuk' ? 'text-green-600' : 'text-red-600'}">${item.qty}</td>
                                            <td class="py-4 text-gray-600">${item.supplier}</td>
                                            <td class="py-4 text-gray-600">${item.note}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderLaporanStok() {
            return `
                <div class="fade-in">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-teal-500">
                            <p class="text-sm text-gray-600 mb-2">Riwayat Mutasi Stok</p>
                            <p class="text-3xl font-bold text-gray-800">1,234</p>
                            <p class="text-sm text-gray-500 mt-2">Total transaksi bulan ini</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
                            <p class="text-sm text-gray-600 mb-2">Stok Minimum Alert</p>
                            <p class="text-3xl font-bold text-orange-600">23</p>
                            <p class="text-sm text-gray-500 mt-2">Barang perlu restock</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                            <p class="text-sm text-gray-600 mb-2">Total Nilai Stok</p>
                            <p class="text-3xl font-bold text-gray-800">Rp 125M</p>
                            <p class="text-sm text-gray-500 mt-2">Total nilai stok</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Barang dengan Stok Minimum</h3>
                        <div class="space-y-3">
                            ${[
                                { name: 'Printer Canon', code: 'BRG-003', current: 8, min: 15, category: 'Elektronik' },
                                { name: 'Meja Kantor', code: 'BRG-002', current: 12, min: 20, category: 'Furniture' },
                                { name: 'Mouse Wireless', code: 'BRG-045', current: 5, min: 25, category: 'Elektronik' }
                            ].map(item => `
                                <div class="flex items-center justify-between p-4 border rounded-lg hover:shadow-md transition">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">${item.name} <span class="text-sm text-gray-500">(${item.code})</span></p>
                                        <p class="text-sm text-gray-600 mt-1">Kategori: ${item.category}</p>
                                    </div>
                                    <div class="text-right mr-6">
                                        <p class="text-2xl font-bold text-red-600">${item.current}</p>
                                        <p class="text-xs text-gray-500">Min: ${item.min}</p>
                                    </div>
                                    <button class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium">
                                        Restock
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Export Laporan Stok</h3>
                            <button onclick="exportToPDF()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                                Download PDF
                            </button>
                        </div>
                        <p class="text-gray-600">Laporan stok real-time per hari/bulan dengan update otomatis</p>
                    </div>
                </div>
            `;
        }

        // Helper functions
        function showAddUser() {
            showNotification('Form tambah user akan dibuka');
        }

        function showAddProduct() {
            showNotification('Form tambah barang akan dibuka');
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-20 right-6 bg-teal-600 text-white px-6 py-4 rounded-lg shadow-2xl z-50 fade-in flex items-center gap-3';
            notification.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>${message}</span>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Simulated real-time updates
        let transactionCount = 248;
        let pendingValidation = 12;
        let stockAlert = 23;

        function simulateRealTimeUpdate() {
            setInterval(() => {
                // Random chance to update transaction count
                if (Math.random() > 0.7) {
                    transactionCount++;
                    updateDashboardStats();
                }

                // Random chance to resolve pending validation
                if (Math.random() > 0.85 && pendingValidation > 0) {
                    pendingValidation--;
                    updateDashboardStats();
                    showNotification('Transaksi berhasil divalidasi!');
                }

                // Random chance to update stock alert
                if (Math.random() > 0.9 && stockAlert > 0) {
                    stockAlert--;
                    updateDashboardStats();
                }
            }, 10000); // Update every 10 seconds
        }

        function updateDashboardStats() {
            // Update stats if on dashboard - would need data attributes in HTML
            const activeTab = document.querySelector('.nav-btn.bg-teal-600');
            if (activeTab && activeTab.getAttribute('data-tab') === 'dashboard') {
                // Refresh dashboard view
                switchTab('dashboard');
            }
        }

        // Add export functionality
        function exportToPDF() {
            showNotification('Mengekspor laporan ke PDF...');
            setTimeout(() => {
                showNotification('✓ Laporan PDF berhasil diunduh!');
            }, 2000);
        }

        function exportToExcel() {
            showNotification('Mengekspor laporan ke Excel...');
            setTimeout(() => {
                showNotification('✓ Laporan Excel berhasil diunduh!');
            }, 2000);
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[type="text"][placeholder*="Cari"]');
                if (searchInput) {
                    searchInput.focus();
                    showNotification('Search activated (Ctrl+K)');
                }
            }

            // Ctrl/Cmd + N for new transaction
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                switchTab('transaksi-penjualan');
                showNotification('New transaction form opened (Ctrl+N)');
            }

            // Ctrl/Cmd + D for dashboard
            if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
                e.preventDefault();
                switchTab('dashboard');
                showNotification('Dashboard view (Ctrl+D)');
            }
        });

        // Add currency formatter
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Add date formatter
        function formatDate(date) {
            return new Intl.DateTimeFormat('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }).format(new Date(date));
        }

        // Add smooth scroll behavior
        document.addEventListener('DOMContentLoaded', function() {
            const navButtons = document.querySelectorAll('.nav-btn');
            navButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        });

        // Initialize everything
        window.onload = function() {
            init();
            simulateRealTimeUpdate();
            
            // Show welcome message
            setTimeout(() => {
                showNotification('🎉 Selamat datang di ERP Logistik!');
            }, 500);
            
            // Add keyboard shortcuts hint in console
            setTimeout(() => {
                console.log('%c⌨️ Keyboard Shortcuts:', 'font-size: 16px; font-weight: bold; color: #0d9488;');
                console.log('Ctrl+K: Search');
                console.log('Ctrl+N: New Transaction');
                console.log('Ctrl+D: Dashboard');
            }, 1000);
        };
    </script>
</body>
</html>