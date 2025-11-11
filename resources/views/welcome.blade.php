<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ERP Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #0a0e1a;
            color: #e2e8f0;
            overflow-x: hidden;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }
        
        .menu-item {
            transition: all 0.2s ease;
        }
        
        .menu-item:hover {
            background: rgba(100, 116, 139, 0.15);
        }
        
        .menu-item.active {
            background: rgba(102, 126, 234, 0.15);
            border-left: 3px solid #667eea;
        }
        
        .stat-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(51, 65, 85, 0.3);
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar {
            background: #1a1f35;
            border-right: 1px solid rgba(51, 65, 85, 0.3);
        }

        .main-content {
            min-height: 100vh;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar fixed left-0 top-0 h-screen w-64 p-6 overflow-y-auto z-50">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center">
                    <i class="fas fa-cogs text-white text-lg"></i>
                </div>
                <div>
                    <div class="text-base font-bold text-white">ERP</div>
                    <div class="text-base font-bold text-white">Admin</div>
                </div>
            </div>
            
            <!-- Menu Utama -->
            <div class="mb-8">
                <div class="text-xs text-slate-500 px-3 mb-3 font-semibold tracking-wider">MENU UTAMA</div>
                <div class="space-y-1">
                    <div class="menu-item active flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer text-white" onclick="showSection('dashboard')">
                        <i class="fas fa-th-large w-5 text-sm"></i>
                        <span class="text-sm">Dashboard</span>
                    </div>
                    <div class="menu-item flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer text-slate-400" onclick="showSection('kelola-akun')">
                        <i class="fas fa-users w-5 text-sm"></i>
                        <span class="text-sm">Kelola Akun</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content flex-1 ml-64 p-8 bg-[#0a0e1a]">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section active">
                <!-- Page Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Dashboard ERP</h1>
                        <p class="text-slate-400">Berikut laporan dan performa hari ini</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 bg-slate-800/50 px-4 py-2.5 rounded-lg border border-slate-700/50">
                            <i class="far fa-calendar text-slate-400 text-sm"></i>
                            <span class="text-sm text-slate-300">1 Jun - 30 Jun</span>
                        </div>
                        
                        <div class="flex items-center gap-2 bg-slate-800/50 px-4 py-2.5 rounded-lg border border-slate-700/50 cursor-pointer">
                            <span class="text-sm text-slate-300">Bulanan</span>
                            <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                        </div>
                        
                        <button class="gradient-bg px-5 py-2.5 rounded-lg flex items-center gap-2 text-white font-medium hover:opacity-90 transition-opacity">
                            <i class="fas fa-robot"></i>
                            <span class="text-sm">Asisten AI</span>
                        </button>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-4 gap-5 mb-8">
                    <div class="stat-card p-6 rounded-xl card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-slate-400 text-sm font-medium">Total Pengguna</span>
                            <i class="fas fa-ellipsis-h text-slate-500 cursor-pointer"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-3">150</div>
                        <div class="flex items-center gap-1.5 text-green-400 text-xs">
                            <i class="fas fa-arrow-up"></i>
                            <span>+2% dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-slate-400 text-sm font-medium">Pesanan Aktif</span>
                            <i class="fas fa-ellipsis-h text-slate-500 cursor-pointer"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-3">25</div>
                        <div class="flex items-center gap-1.5 text-green-400 text-xs">
                            <i class="fas fa-arrow-up"></i>
                            <span>+15% dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-slate-400 text-sm font-medium">Pengguna Baru</span>
                            <i class="fas fa-ellipsis-h text-slate-500 cursor-pointer"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-3">5</div>
                        <div class="flex items-center gap-1.5 text-green-400 text-xs">
                            <i class="fas fa-arrow-up"></i>
                            <span>+10% dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-slate-400 text-sm font-medium">Pendapatan Bulan Ini</span>
                            <i class="fas fa-ellipsis-h text-slate-500 cursor-pointer"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-3">Rp 5M</div>
                        <div class="flex items-center gap-1.5 text-green-400 text-xs">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8% dari bulan lalu</span>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="grid grid-cols-2 gap-5 mb-8">
                    <!-- Daily Profit Table -->
                    <div class="stat-card p-6 rounded-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-white">Keuntungan Per Hari</h3>
                            <div class="flex items-center gap-2 bg-slate-800/50 px-3 py-2 rounded-lg border border-slate-700/50 cursor-pointer">
                                <span class="text-sm text-slate-300">Mingguan</span>
                                <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                            </div>
                        </div>
                        
                        <div class="overflow-hidden">
                            <table class="w-full" id="profitTable">
                                <thead>
                                    <tr class="border-b border-slate-800">
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Tanggal</th>
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Pesanan</th>
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Pendapatan</th>
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Pengeluaran</th>
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Keuntungan</th>
                                        <th class="text-left text-xs text-slate-500 font-medium pb-4 px-3">Perubahan</th>
                                    </tr>
                                </thead>
                                <tbody id="profitTableBody">
                                    <!-- Data akan diisi oleh JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-slate-400">
                                Menampilkan <span id="showingStart">1</span> - <span id="showingEnd">5</span> dari <span id="totalRows">30</span> data
                            </div>
                            <div class="flex items-center gap-2">
                                <button id="prevPage" class="px-3 py-1.5 bg-slate-800/50 hover:bg-slate-700/50 text-slate-300 rounded-lg border border-slate-700/50 transition-colors text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </button>
                                <div id="pageNumbers" class="flex gap-2">
                                    <!-- Page numbers akan diisi oleh JavaScript -->
                                </div>
                                <button id="nextPage" class="px-3 py-1.5 bg-slate-800/50 hover:bg-slate-700/50 text-slate-300 rounded-lg border border-slate-700/50 transition-colors text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between">
                            <div>
                                <div class="text-xs text-slate-500 mb-1">Total Keuntungan Bulanan</div>
                                <div class="text-2xl font-bold text-white">Rp 5.000.000</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-slate-500 mb-1">Rata-rata Per Hari</div>
                                <div class="text-xl font-bold text-green-400">Rp 166.667</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Attendance Chart -->
                    <div class="stat-card p-6 rounded-xl">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-lg font-semibold text-white">Aktivitas Pengguna</h3>
                            <div class="flex items-center gap-2 bg-slate-800/50 px-3 py-2 rounded-lg border border-slate-700/50">
                                <i class="far fa-calendar text-slate-400 text-sm"></i>
                                <span class="text-sm text-slate-300">4 Juni 2024</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center mb-8">
                            <div class="relative w-44 h-44">
                                <svg class="w-full h-full transform -rotate-90">
                                    <circle cx="88" cy="88" r="70" stroke="#1e293b" stroke-width="20" fill="none"/>
                                    <circle cx="88" cy="88" r="70" stroke="url(#gradient)" stroke-width="20" fill="none" 
                                            stroke-dasharray="440" stroke-dashoffset="44" stroke-linecap="round"/>
                                    <defs>
                                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#fbbf24;stop-opacity:1" />
                                            <stop offset="50%" style="stop-color:#a78bfa;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#667eea;stop-opacity:1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <div class="text-3xl font-bold text-white">150</div>
                                    <div class="text-xs text-slate-500 mt-1">Total Pengguna</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                    <span class="text-xs text-slate-400">Aktif</span>
                                </div>
                                <div class="text-2xl font-bold text-white">140</div>
                            </div>
                            
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <span class="text-xs text-slate-400">Tidak Aktif</span>
                                </div>
                                <div class="text-2xl font-bold text-white">10</div>
                            </div>
                        </div>
                        
                        <button class="w-full bg-slate-800/50 hover:bg-slate-700/50 text-white text-sm py-3 rounded-lg transition-colors border border-slate-700/50">
                            Lihat Detail Lengkap
                        </button>
                    </div>
                </div>
                
                <!-- Employee Table -->
                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Aktivitas Terbaru</h3>
                        <div class="flex items-center gap-2 bg-slate-800/50 px-3 py-2 rounded-lg border border-slate-700/50 cursor-pointer">
                            <span class="text-sm text-slate-300">Semua aktivitas</span>
                            <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-800">
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Waktu</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Pengguna</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Aktivitas</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">10:30 AM</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm font-semibold">
                                                JD
                                            </div>
                                            <span class="text-sm text-white font-medium">John Doe</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Login ke sistem</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Berhasil</span>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">09:15 AM</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-sm font-semibold">
                                                JS
                                            </div>
                                            <span class="text-sm text-white font-medium">Jane Smith</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Update profil</td>
                                    <td class="py-4 px-4">
                                                                                <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Berhasil</span>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">08:45 AM</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                                                AB
                                            </div>
                                            <span class="text-sm text-white font-medium">Alice Brown</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Buat pesanan baru</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Berhasil</span>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">07:30 AM</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-white text-sm font-semibold">
                                                MJ
                                            </div>
                                            <span class="text-sm text-white font-medium">Mike Johnson</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Logout dari sistem</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Pending</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Kelola Akun Section -->
            <div id="kelola-akun" class="section">
                <h2 class="text-3xl font-bold text-white mb-8">Kelola Akun</h2>
                
                <!-- Tambah Akun Form -->
                <div class="stat-card p-6 rounded-xl mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4">Tambah Akun Baru</h3>
                    <form id="add-account-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama</label>
                            <input type="text" class="w-full p-3 bg-slate-800/50 border border-slate-700/50 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Masukkan nama" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                            <input type="email" class="w-full p-3 bg-slate-800/50 border border-slate-700/50 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Masukkan email" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Role</label>
                            <select class="w-full p-3 bg-slate-800/50 border border-slate-700/50 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                                <option value="">Pilih role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                            <input type="password" class="w-full p-3 bg-slate-800/50 border border-slate-700/50 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Masukkan password" required>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="gradient-bg px-6 py-3 rounded-lg text-white font-medium hover:opacity-90 transition-opacity flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Akun</span>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Daftar Akun Table -->
                <div class="stat-card p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-white">Daftar Akun</h3>
                        <div class="flex items-center gap-2 bg-slate-800/50 px-3 py-2 rounded-lg border border-slate-700/50 cursor-pointer">
                            <span class="text-sm text-slate-300">Semua akun</span>
                            <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-800">
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">ID</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Nama</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Email</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Role</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Status</th>
                                    <th class="text-left text-xs text-slate-500 font-medium pb-4 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="account-list">
                                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">#001</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm font-semibold">
                                                AD
                                            </div>
                                            <span class="text-sm text-white font-medium">Admin Utama</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">admin@erp.com</td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Admin</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Aktif</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button class="text-blue-400 hover:text-blue-300 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-400 hover:text-red-300 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">#002</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-sm font-semibold">
                                                JD
                                            </div>
                                            <span class="text-sm text-white font-medium">John Doe</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">john@example.com</td>
                                    <td class="py-4 px-4 text-sm text-slate-300">User</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Aktif</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button class="text-blue-400 hover:text-blue-300 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-400 hover:text-red-300 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-4 text-sm text-slate-400">#003</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                                                JS
                                            </div>
                                            <span class="text-sm text-white font-medium">Jane Smith</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-300">jane@example.com</td>
                                    <td class="py-4 px-4 text-sm text-slate-300">Manager</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm text-slate-300">Tidak Aktif</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button class="text-blue-400 hover:text-blue-300 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-400 hover:text-red-300 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data keuntungan per hari (contoh data sederhana)
        const profitData = [
            { date: '1 Juni 2024', orders: '10', revenue: 'Rp 2.500.000', expense: 'Rp 1.800.000', profit: 'Rp 700.000', change: '+5%', changeType: 'up' },
            { date: '2 Juni 2024', orders: '12', revenue: 'Rp 3.000.000', expense: 'Rp 2.100.000', profit: 'Rp 900.000', change: '+28.6%', changeType: 'up' },
            { date: '3 Juni 2024', orders: '8', revenue: 'Rp 2.000.000', expense: 'Rp 1.500.000', profit: 'Rp 500.000', change: '-44.4%', changeType: 'down' },
            { date: '4 Juni 2024', orders: '15', revenue: 'Rp 3.750.000', expense: 'Rp 2.600.000', profit: 'Rp 1.150.000', change: '+130%', changeType: 'up' },
            { date: '5 Juni 2024', orders: '11', revenue: 'Rp 2.750.000', expense: 'Rp 2.000.000', profit: 'Rp 750.000', change: '-34.8%', changeType: 'down' },
            { date: '6 Juni 2024', orders: '14', revenue: 'Rp 3.500.000', expense: 'Rp 2.400.000', profit: 'Rp 1.100.000', change: '+46.7%', changeType: 'up' },
            { date: '7 Juni 2024', orders: '9', revenue: 'Rp 2.250.000', expense: 'Rp 1.700.000', profit: 'Rp 550.000', change: '-50%', changeType: 'down' },
            { date: '8 Juni 2024', orders: '13', revenue: 'Rp 3.250.000', expense: 'Rp 2.200.000', profit: 'Rp 1.050.000', change: '+90.9%', changeType: 'up' },
            { date: '9 Juni 2024', orders: '16', revenue: 'Rp 4.000.000', expense: 'Rp 2.800.000', profit: 'Rp 1.200.000', change: '+14.3%', changeType: 'up' },
            { date: '10 Juni 2024', orders: '7', revenue: 'Rp 1.750.000', expense: 'Rp 1.300.000', profit: 'Rp 450.000', change: '-62.5%', changeType: 'down' },
            { date: '11 Juni 2024', orders: '18', revenue: 'Rp 4.500.000', expense: 'Rp 3.100.000', profit: 'Rp 1.400.000', change: '+211.1%', changeType: 'up' },
            { date: '12 Juni 2024', orders: '12', revenue: 'Rp 3.000.000', expense: 'Rp 2.100.000', profit: 'Rp 900.000', change: '-35.7%', changeType: 'down' },
            { date: '13 Juni 2024', orders: '17', revenue: 'Rp 4.250.000', expense: 'Rp 2.900.000', profit: 'Rp 1.350.000', change: '+50%', changeType: 'up' },
            { date: '14 Juni 2024', orders: '10', revenue: 'Rp 2.500.000', expense: 'Rp 1.800.000', profit: 'Rp 700.000', change: '-48.1%', changeType: 'down' },
            { date: '15 Juni 2024', orders: '19', revenue: 'Rp 4.750.000', expense: 'Rp 3.200.000', profit: 'Rp 1.550.000', change: '+121.4%', changeType: 'up' },
            { date: '16 Juni 2024', orders: '14', revenue: 'Rp 3.500.000', expense: 'Rp 2.400.000', profit: 'Rp 1.100.000', change: '-29%', changeType: 'down' },
            { date: '17 Juni 2024', orders: '11', revenue: 'Rp 2.750.000', expense: 'Rp 2.000.000', profit: 'Rp 750.000', change: '-31.8%', changeType: 'down' },
            { date: '18 Juni 2024', orders: '15', revenue: 'Rp 3.750.000', expense: 'Rp 2.600.000', profit: 'Rp 1.150.000', change: '+53.3%', changeType: 'up' },
            { date: '19 Juni 2024', orders: '13', revenue: 'Rp 3.250.000', expense: 'Rp 2.200.000', profit: 'Rp 1.050.000', change: '-8.7%', changeType: 'down' },
            { date: '20 Juni 2024', orders: '16', revenue: 'Rp 4.000.000', expense: 'Rp 2.800.000', profit: 'Rp 1.200.000', change: '+14.3%', changeType: 'up' },
            { date: '21 Juni 2024', orders: '9', revenue: 'Rp 2.250.000', expense: 'Rp 1.700.000', profit: 'Rp 550.000', change: '-54.2%', changeType: 'down' },
            { date: '22 Juni 2024', orders: '20', revenue: 'Rp 5.000.000', expense: 'Rp 3.400.000', profit: 'Rp 1.600.000', change: '+190.9%', changeType: 'up' },
            { date: '23 Juni 2024', orders: '12', revenue: 'Rp 3.000.000', expense: 'Rp 2.100.000', profit: 'Rp 900.000', change: '-43.8%', changeType: 'down' },
            { date: '24 Juni 2024', orders: '17', revenue: 'Rp 4.250.000', expense: 'Rp 2.900.000', profit: 'Rp 1.350.000', change: '+50%', changeType: 'up' },
                        { date: '25 Juni 2024', orders: '14', revenue: 'Rp 3.500.000', expense: 'Rp 2.400.000', profit: 'Rp 1.100.000', change: '-18.5%', changeType: 'down' },
            { date: '26 Juni 2024', orders: '18', revenue: 'Rp 4.500.000', expense: 'Rp 3.100.000', profit: 'Rp 1.400.000', change: '+27.3%', changeType: 'up' },
            { date: '27 Juni 2024', orders: '11', revenue: 'Rp 2.750.000', expense: 'Rp 2.000.000', profit: 'Rp 750.000', change: '-46.4%', changeType: 'down' },
            { date: '28 Juni 2024', orders: '16', revenue: 'Rp 4.000.000', expense: 'Rp 2.800.000', profit: 'Rp 1.200.000', change: '+60%', changeType: 'up' },
            { date: '29 Juni 2024', orders: '13', revenue: 'Rp 3.250.000', expense: 'Rp 2.200.000', profit: 'Rp 1.050.000', change: '-12.5%', changeType: 'down' },
            { date: '30 Juni 2024', orders: '15', revenue: 'Rp 3.750.000', expense: 'Rp 2.600.000', profit: 'Rp 1.150.000', change: '+9.5%', changeType: 'up' }
        ];

        let currentPage = 1;
        const rowsPerPage = 5;
        const totalPages = Math.ceil(profitData.length / rowsPerPage);

        function renderTable() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const currentData = profitData.slice(start, end);
            
            const tbody = document.getElementById('profitTableBody');
            tbody.innerHTML = '';
            
            currentData.forEach((row, index) => {
                const isLast = index === currentData.length - 1;
                const changeColor = row.changeType === 'up' ? 'green' : 'red';
                
                tbody.innerHTML += `
                    <tr class="${!isLast ? 'border-b border-slate-800' : ''} hover:bg-slate-800/30 transition-colors">
                        <td class="py-4 px-3 text-sm text-white font-medium">${row.date}</td>
                        <td class="py-4 px-3 text-sm text-slate-300">${row.orders}</td>
                        <td class="py-4 px-3 text-sm text-slate-300">${row.revenue}</td>
                        <td class="py-4 px-3 text-sm text-slate-300">${row.expense}</td>
                        <td class="py-4 px-3 text-sm text-green-400 font-semibold">${row.profit}</td>
                        <td class="py-4 px-3">
                            <span class="text-xs text-${changeColor}-400 bg-${changeColor}-400/10 px-2 py-1 rounded">${row.change}</span>
                        </td>
                    </tr>
                `;
            });
            
            // Update showing info
            document.getElementById('showingStart').textContent = start + 1;
            document.getElementById('showingEnd').textContent = Math.min(end, profitData.length);
            document.getElementById('totalRows').textContent = profitData.length;
            
            // Update pagination buttons
            renderPagination();
        }

        function renderPagination() {
            const pageNumbers = document.getElementById('pageNumbers');
            pageNumbers.innerHTML = '';
            
            for (let i = 1; i <= totalPages; i++) {
                const isActive = i === currentPage;
                pageNumbers.innerHTML += `
                    <button onclick="goToPage(${i})" class="px-3 py-1.5 ${isActive ? 'gradient-bg text-white' : 'bg-slate-800/50 text-slate-300 hover:bg-slate-700/50'} rounded-lg border ${isActive ? 'border-transparent' : 'border-slate-700/50'} transition-colors text-sm font-medium">
                        ${i}
                    </button>
                `;
            }
            
            // Update prev/next buttons
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages;
        }

        function goToPage(page) {
            currentPage = page;
            renderTable();
        }

        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

        // Fungsi untuk menampilkan section tertentu
        function showSection(sectionId) {
            // Sembunyikan semua section
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));

            // Tampilkan section yang dipilih
            document.getElementById(sectionId).classList.add('active');

            // Update active menu item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));
            document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');
        }

        // Event listener untuk form tambah akun
        document.getElementById('add-account-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
            button.disabled = true;
            
            // Simulasi proses
            setTimeout(() => {
                alert('Akun berhasil ditambahkan! (Ini simulasi)');
                button.innerHTML = '<i class="fas fa-plus"></i> <span>Tambah Akun</span>';
                button.disabled = false;
                this.reset();
            }, 2000);
        });

        // Inisialisasi
        renderTable();
        showSection('dashboard');
    </script>
</body>
</html>
