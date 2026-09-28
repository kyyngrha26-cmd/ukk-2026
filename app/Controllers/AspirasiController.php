<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    // TAMPILKAN DAFTAR ASPIRASI
    public function index(Request $request)
    {
        $data = Aspirasi::with('kategori')
            ->orderBy('id_aspirasi', 'desc')
            ->paginate(10);

        return view('aspirasi.index', compact('data'));
    }

    // FORM TAMBAH
    public function create()
    {
        $kategori = Kategori::all();
        return view('aspirasi.create', compact('kategori'));
    }

    // SIMPAN DATA + UPLOAD FOTO
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|numeric',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aspirasi'), $namaFoto);
        }

        Aspirasi::create([
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $namaFoto,
            'status'      => 'Pending',
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $aspirasi = Aspirasi::where('id_aspirasi', $id)->first();
        $kategori = Kategori::all();

        return view('aspirasi.edit', compact('aspirasi', 'kategori'));
    }

    // UPDATE DATA + FOTO
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required|numeric',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aspirasi = Aspirasi::where('id_aspirasi', $id)->first();
        $namaFoto = $aspirasi->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($aspirasi->foto && file_exists(public_path('uploads/aspirasi/' . $aspirasi->foto))) {
                unlink(public_path('uploads/aspirasi/' . $aspirasi->foto));
            }

            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aspirasi'), $namaFoto);
        }

        $aspirasi->update([
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $namaFoto,
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diperbarui');
    }

    // HAPUS DATA & FOTO
    public function destroy(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('id_aspirasi', $id)->first();

        if ($aspirasi) {
            if ($aspirasi->foto && file_exists(public_path('uploads/aspirasi/' . $aspirasi->foto))) {
                unlink(public_path('uploads/aspirasi/' . $aspirasi->foto));
            }
            $aspirasi->delete();
        }

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }
}