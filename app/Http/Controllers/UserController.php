<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Daftar pilihan jabatan yang diperbolehkan.
     */
    private function jabatanOptions(): array
    {
        return [
            'Lurah',
            'Sekretaris Kelurahan',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan Sosial',
            'Kasi Ekonomi Pembangunan',
        ];
    }

    /**
     * Menampilkan daftar seluruh user.
     */
    public function index()
    {
        $users = User::orderBy('jabatan')
            ->orderBy('name')
            ->get();

        return view(
            'Admin.Konten.Pengaturan_user.index',
            compact('users')
        );
    }

    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        $jabatanOptions = $this->jabatanOptions();

        return view(
            'Admin.Konten.Pengaturan_user.tambah',
            compact('jabatanOptions')
        );
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'jabatan' => [
                'required',
                'string',
                Rule::in($this->jabatanOptions()),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',

            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        User::create([
            'name' => $validated['name'],
            'jabatan' => $validated['jabatan'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('pengaturan_user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail user.
     */
    public function show(User $user)
    {
        // return view(
        //     'Admin.Konten.Pengaturan_user.show',
        //     compact('user')
        // );
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit(User $user)
    {
        $jabatanOptions = $this->jabatanOptions();
        $isEdit = true;

        return view(
            'Admin.Konten.Pengaturan_user.tambah',
            compact(
                'user',
                'jabatanOptions',
                'isEdit'
            )
        );
    }

    /**
     * Memperbarui data user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'jabatan' => [
                'required',
                'string',
                Rule::in($this->jabatanOptions()),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',

            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah digunakan.',

            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user->name = $validated['name'];
        $user->jabatan = $validated['jabatan'];
        $user->email = $validated['email'];

        /*
         * Password hanya diubah jika diisi.
         * Jika dikosongkan, password lama tetap digunakan.
         */
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()
            ->route('pengaturan_user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('pengaturan_user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
