<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Dashboard utama admin.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Halaman konfigurasi sistem.
     */
    public function konfigurasi()
    {
        return view('admin.konfigurasi');
    }

    /**
     * Halaman manajemen user & role.
     */
    public function akun(Request $request)
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();

        return view('admin.kelola-akun', compact('users', 'roles'));
    }

    /**
     * Tambah user baru.
     */
    public function storeUser(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'role' => 'required|string|exists:roles,name',
                'status' => 'required|in:aktif,nonaktif',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => $validated['status'],
            ]);

            $user->assignRole($validated['role']);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update data user.
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => "required|email|unique:users,email,$id",
                'password' => 'nullable|min:8',
                'role' => 'required|string|exists:roles,name',
                'status' => 'required|in:active,nonaktif',
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'status' => $validated['status'],
            ]);

            // Update password jika diisi
            if (!empty($validated['password'])) {
                $user->update(['password' => Hash::make($validated['password'])]);
            }

            // Sync roles
            $user->syncRoles([$validated['role']]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui',
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hapus user dari sistem.
     */
    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Cegah hapus diri sendiri
            if ($user->id === auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun sendiri',
                ], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}