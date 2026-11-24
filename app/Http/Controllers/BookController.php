<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua buku, urut dari terbaru, 10 data per halaman
        $books = Book::latest()->paginate(10);

        // Nama halaman tanpa .vue dan tanpa path lengkap
        return inertia('Books/Index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Books/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data dari form (dengan pesan error berbahasa Indonesia)
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books',
            'judul'     => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit'  => 'nullable|max:255',
            'tahun'     => 'nullable|digits:4',
            'stok'      => 'required|integer|min:0',
        ], [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique'   => 'Kode buku sudah dipakai.',
            'judul.required'     => 'Judul wajib diisi.',
            'pengarang.required' => 'Pengarang wajib diisi.',
            'tahun.digits'       => 'Tahun harus berupa 4 digit angka.',
            'stok.required'      => 'Stok wajib diisi.',
            'stok.integer'       => 'Stok harus berupa angka bulat.',
            'stok.min'           => 'Stok tidak boleh bernilai negatif.',
        ]);

        // 2. Simpan sebagai baris baru di tabel books
        Book::create($validated);

        // 3. Kembali ke daftar buku dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}