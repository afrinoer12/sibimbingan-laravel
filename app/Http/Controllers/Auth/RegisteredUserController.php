<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:mahasiswa,dosen'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'nim' => [
                'required_if:role,mahasiswa',
                'nullable',
                'string',
                'max:50',
                'unique:mahasiswas,nim',
            ],
            'prodi' => [
                'required_if:role,mahasiswa',
                'nullable',
                'string',
                'max:100',
            ],

            'nidn' => [
                'required_if:role,dosen',
                'nullable',
                'string',
                'max:50',
                'unique:dosens,nidn',
            ],
            'bidang_keahlian' => [
                'nullable',
                'string',
                'max:150',
            ],
        ], [
            'role.required' => 'Silakan pilih daftar sebagai mahasiswa atau dosen.',
            'role.in' => 'Role yang dipilih tidak valid.',

            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain atau login.',

            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',

            'nim.required_if' => 'NIM wajib diisi untuk akun mahasiswa.',
            'nim.unique' => 'NIM sudah terdaftar. Gunakan NIM lain atau login dengan akun yang sudah ada.',
            'nim.max' => 'NIM maksimal 50 karakter.',

            'prodi.required_if' => 'Program studi wajib diisi untuk akun mahasiswa.',
            'prodi.max' => 'Program studi maksimal 100 karakter.',

            'nidn.required_if' => 'NIDN wajib diisi untuk akun dosen.',
            'nidn.unique' => 'NIDN sudah terdaftar. Gunakan NIDN lain atau login dengan akun yang sudah ada.',
            'nidn.max' => 'NIDN maksimal 50 karakter.',

            'bidang_keahlian.max' => 'Bidang keahlian maksimal 150 karakter.',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            if ($request->role === 'mahasiswa') {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nama' => $request->name,
                    'nim' => $request->nim,
                    'prodi' => $request->prodi,
                ]);
            }

            if ($request->role === 'dosen') {
                Dosen::create([
                    'user_id' => $user->id,
                    'nama' => $request->name,
                    'nidn' => $request->nidn,
                    'bidang_keahlian' => $request->bidang_keahlian,
                ]);
            }

            DB::commit();

            event(new Registered($user));

            Auth::login($user);

            if ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }

            if ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }

            return redirect()->route('dashboard');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Registrasi akun gagal', [
                'message' => $e->getMessage(),
                'role' => $request->role,
                'email' => $request->email,
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'register' => 'Registrasi gagal. Silakan periksa kembali data yang diisi.',
                ]);
        }
    }
}
