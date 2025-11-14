@extends('layouts.app')

@section('title', 'Manajemen User & Role')
@section('page-title', 'Manajemen Role dan User')
@section('page-subtitle', 'Kelola user, role, dan permission sistem')

@section('content')
<div class="fade-in">
    <!-- User List -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">Daftar User & Role</h3>
            <button onclick="openAddUserModal()" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah User
            </button>
        </div>

        <!-- Table -->
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
                    @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="py-3">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                {{ ucfirst($user->roles->first()?->name ?? '-') }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="px-3 py-1 {{ $user->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs font-medium">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="flex gap-2">
                                <button onclick='editUser(@json($user))' class="text-blue-600 hover:text-blue-700 text-sm">Edit</button>
                                <button onclick="deleteUser({{ $user->id }})" class="text-red-600 hover:text-red-700 text-sm">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">Belum ada user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Form -->
<div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4">
        <form id="userForm">
            @csrf
            <input type="hidden" id="formMethod" value="POST">
            <input type="hidden" id="userId">

            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Tambah User</h3>
                <button type="button" onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input id="userName" type="text" required class="w-full border rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input id="userEmail" type="email" required class="w-full border rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Password <span id="passwordHint" class="text-gray-500 text-xs">(Kosongkan jika tidak ingin mengubah)</span></label>
                    <input id="userPassword" type="password" class="w-full border rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select id="userRole" class="w-full border rounded-lg px-4 py-2" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select id="userStatus" class="w-full border rounded-lg px-4 py-2" required>
                        <option value="active">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="p-6 border-t flex justify-end gap-3">
                <button type="button" onclick="closeUserModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openAddUserModal() {
    document.getElementById('modalTitle').textContent = 'Tambah User';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('userPassword').required = true;
    document.getElementById('passwordHint').style.display = 'none';
    document.getElementById('userModal').classList.remove('hidden');
}

function editUser(user) {
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('userId').value = user.id;
    document.getElementById('userName').value = user.name;
    document.getElementById('userEmail').value = user.email;
    document.getElementById('userPassword').value = '';
    document.getElementById('userPassword').required = false;
    document.getElementById('passwordHint').style.display = 'inline';
    document.getElementById('userStatus').value = user.status;
    document.getElementById('userRole').value = user.roles[0]?.name ?? '';
    document.getElementById('userModal').classList.remove('hidden');
}

function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
    document.getElementById('userForm').reset();
}

document.getElementById('userForm').addEventListener('submit', async e => {
    e.preventDefault();
    
    const id = document.getElementById('userId').value;
    const method = document.getElementById('formMethod').value;
    const url = method === 'POST' 
        ? '/admin/user-management' 
        : `/admin/user-management/${id}`;
    
    const password = document.getElementById('userPassword').value;
    const payload = {
        name: document.getElementById('userName').value,
        email: document.getElementById('userEmail').value,
        role: document.getElementById('userRole').value,
        status: document.getElementById('userStatus').value,
    };
    
    // Hanya kirim password jika diisi
    if (password) {
        payload.password = password;
    }

    try {
        const res = await fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        });
        
        const data = await res.json();
        
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
            if (data.errors) {
                console.error('Validation errors:', data.errors);
            }
        }
    } catch (error) {
        alert('Terjadi kesalahan pada server');
        console.error(error);
    }
});

async function deleteUser(id) {
    if (!confirm('Yakin ingin menghapus user ini?')) return;
    
    try {
        const res = await fetch(`/admin/user-management/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        });
        
        const data = await res.json();
        
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    } catch (error) {
        alert('Terjadi kesalahan pada server');
        console.error(error);
    }
}
</script>
@endpush