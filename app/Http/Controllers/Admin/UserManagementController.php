<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule; // <-- Import Rule
use Illuminate\Support\Facades\Auth; // <-- Import Auth

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar semua user (admin & karyawan).
     */
    public function index(): View
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create(): View
    {
        // Tampilkan view form 'create'
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', Rule::in(['admin', 'karyawan'])], // Pastikan role-nya valid
        ]);

        // 2. Buat user baru di database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // 3. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Tidak kita gunakan
    }

    /**
     * Menampilkan form untuk mengedit user.
     * (Menggunakan Route Model Binding)
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Memperbarui user di database.
     * (Menggunakan Route Model Binding)
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // 1. Validasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' divalidasi 'unique' tapi abaikan email user ini sendiri
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', Rule::in(['admin', 'karyawan'])],
            // 'password' boleh kosong (nullable)
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Siapkan data untuk di-update
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // 3. Cek apakah admin mengisi password baru
        if ($request->filled('password')) {
            // Jika diisi, update password-nya
            $updateData['password'] = Hash::make($request->password);
        }
        // Jika tidak diisi, password lama tidak akan berubah

        // 4. Update data user
        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Menghapus user dari database.
     * (Menggunakan Route Model Binding)
     */
    public function destroy(User $user): RedirectResponse
    {
        // PENTING: Tambahkan perlindungan agar admin tidak bisa menghapus diri sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}