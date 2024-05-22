<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.view',
                    [
                        'pengeluaran' => $pengeluaran
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $pengeluaranModel = new Pengeluaran();

    //non-static method
    $kode_akun = $pengeluaranModel->getKodePengeluaran();

    return view('pengeluaran.create', ['kode_akun' => $kode_akun]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengeluaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengeluaranRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_akun' => 'required',
            'nama_akun' => 'required',
            'header_akun' => 'required',
        ]);

        // masukkan ke db
        Pengeluaran::create($request->all());
        
        return redirect()->route('pengeluaran.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengeluaranRequest  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_akun' => 'required',
            'nama_akun' => 'required',
            'header_akun' => 'required',
        ]);
    
        $pengeluaran->update($validated);
    
        return redirect()->route('pengeluaran.index')->with('success','Data Berhasil di Ubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pengeluaran $pengeluaran)
    public function destroy($id)
    {
        //hapus dari database
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')->with('success','Data Berhasil di Hapus');
    }
}
