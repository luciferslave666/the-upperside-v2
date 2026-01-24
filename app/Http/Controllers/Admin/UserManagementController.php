<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{

    public function index(): View
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create(): View
    {
        // Tampilkan view form 'create'
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', Rule::in(['admin', 'karyawan'])], // Pastikan role-nya valid
        ]);

        // Buat user baru di database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // Validasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' divalidasi 'unique' tapi abaikan email user ini sendiri
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'karyawan'])],
            // 'password' boleh kosong (nullable)
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Siapkan data untuk di-update
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Cek apakah admin mengisi password baru
        if ($request->filled('password')) {
            // Jika diisi, update password-nya
            $updateData['password'] = Hash::make($request->password);
        }
        // Jika tidak diisi, password lama tidak akan berubah

        // Update data user
        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user): RedirectResponse
    {
        // Tambahkan perlindungan agar admin tidak bisa menghapus diri sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}