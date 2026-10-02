<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Siswa;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $data = Siswa::leftJoin('users', 'siswa.id_user', '=', 'users.id')
            ->orderBy('siswa.id_siswa', 'desc')
            ->paginate(5);
        return view('pengguna.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis',
            'kelas' => 'required|string|max:10',
        ]);

        $user = User::create([
            'username' => $request->nis,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role'     => 'siswa',
        ]);

        Siswa::create([
            'nama'    => $request->nama,
            'nis'     => $request->nis,
            'kelas'   => $request->kelas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($pengguna)
    {
        $siswa = Siswa::where('id_siswa', $pengguna)->first();
        
        if (!$siswa) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('pengguna.edit', compact('siswa'));
    }

    public function update(Request $request, $pengguna)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis,' . $pengguna . ',id_siswa',
            'kelas' => 'required|string|max:10',
        ]);

        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        if (!$siswa) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        // Update data siswa
        $siswa->update([
            'nama'  => $request->nama,
            'nis'   => $request->nis,
            'kelas' => $request->kelas,
        ]);

        // Update username di tabel users
        if ($siswa->id_user) {
            User::where('id', $siswa->id_user)->update([
                'username' => $request->nis
            ]);
        }

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        // 1. Cari data siswa berdasarkan id_siswa menggunakan first()
        $siswa = Siswa::where('id_siswa', $id)->first();

        if (!$siswa) {
            return redirect()->route('pengguna.index')->with('error', 'Data pengguna tidak ditemukan.');
        }

        // 2. Simpan id_user terkait
        $idUser = $siswa->id_user;

        // 3. Hapus data siswa
        $siswa->delete();

        // 4. Hapus akun user terkait jika ada
        if ($idUser) {
            User::where('id', $idUser)->delete();
        }

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}