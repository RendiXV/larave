<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan semua data dari model Siswa
        $total_harga = $harga_satuan * $jumlah_barang;
        $siswa = Siswa::all();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $siswa = new Siswa();
        $siswa->nama_pembeli = $request->nama_pembeli;
        $siswa->tanggal_pembelian = $request->tanggal_pembelian;
        $siswa->nama_barang = $request->nama_barang;
        $siswa->harga_satuan = $request->harga_satuan;
        $siswa->jumlah_barang = $request->jumlah_barang;
        $siswa->save();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $request->validate([
            'nama_pembeli' => 'required',
            'tanggal_pembelian' => 'required|max:255',
            'nama_barang' => 'required',
            'harga_satuan' => 'required',
            'jumlah_barang' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->nama_pembeli = $request->nama_pembeli;
        $siswa->tanggal_pembelian = $request->tanggal_pembelian;
        $siswa->nama_barang = $request->nama_barang;
        $siswa->harga_satuan = $request->harga_satuan;
        $siswa->jumlah_barang = $request->jumlah_barang;
        $siswa->save();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
