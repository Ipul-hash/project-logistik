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
                <p class="text-teal-200 text-xs capitalize">{{ Auth::user()->getRoleNames()->first() ?? 'User' }} Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-4 sidebar-scrollbar">
        @php
            $user = Auth::user();
        @endphp

        {{-- ADMIN --}}
        @if ($user->hasRole('admin'))
            <div>
                <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Admin</p>

                <x-nav-link route="admin.dashboard" icon="home" text="Dashboard Monitoring" />
                <x-nav-link route="admin.konfigurasi" icon="cog" text="Konfigurasi Sistem" />
                <x-nav-link route="admin.akun" icon="users" text="Manajemen Role & User" />
            </div>
        @endif

        {{-- FINANCE --}}
        @if ($user->hasRole('finance'))
            <div>
                <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Finance</p>

                <x-nav-link route="finance.kas" icon="banknotes" text="Kas Masuk & Keluar" />
                <x-nav-link route="finance.rekonsiliasi" icon="scale" text="Rekonsiliasi & Validasi" />
                <x-nav-link route="finance.laporan" icon="clipboard-document-list" text="Laporan Keuangan" />
            </div>
        @endif

        {{-- KASIR --}}
        @if ($user->hasRole('kasir'))
            <div>
                <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Kasir</p>

                <x-nav-link route="kasir.transaksi" icon="shopping-cart" text="Transaksi Penjualan" />
                <x-nav-link route="kasir.retur" icon="arrow-uturn-left" text="Retur & Pengembalian" />
                <x-nav-link route="kasir.laporan" icon="document-chart-bar" text="Laporan Penjualan" />
            </div>
        @endif

        {{-- GUDANG --}}
        @if ($user->hasRole('gudang'))
            <div>
                <p class="text-teal-300 text-xs font-semibold uppercase tracking-wider mb-2 px-3">Gudang</p>

                <x-nav-link route="gudang.manajemen" icon="archive-box" text="Manajemen Barang" />
                <x-nav-link route="gudang.barang" icon="arrow-right-left" text="Barang Masuk & Keluar" />
                <x-nav-link route="gudang.laporan" icon="chart-bar" text="Laporan Stok" />
            </div>
        @endif
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-teal-600">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-teal-300 rounded-full flex items-center justify-center">
                <span class="text-teal-800 font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white font-medium text-sm truncate">{{ $user->name }}</p>
                <p class="text-teal-300 text-xs capitalize">{{ $user->getRoleNames()->first() }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-teal-300 hover:text-white hover:bg-teal-600 p-2 rounded-lg transition-all duration-200" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>