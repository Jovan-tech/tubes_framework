<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Http\Requests\StorePermintaanRequest;
use App\Http\Requests\UpdatePermintaanRequest;

use Illuminate\Foundation\Http\FormRequest;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $permintaan = Permintaan::all();
        return view('permintaan.view',
                    [
                        'permintaan' => $permintaan
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
    $permintaanModel = new Permintaan();

    //non-static method
    $kode_permintaan = $permintaanModel->getKodePermintaan();

    return view('permintaan.create', ['kode_permintaan' => $kode_permintaan]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermintaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermintaanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_permintaan' => 'required',
            'nama_permintaan' => 'required|unique:permintaan|min:5|max:255',
            'nama_pengajuan' => 'required',
            'tgl_bayar' => 'required',
            'tipe_pengajuan' => 'required',
            'note' => 'required',
            'jumlah_pengajuan' => 'required',
        ]);

        // masukkan ke db
        Permintaan::create($request->all());
        
        return redirect()->route('permintaan.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function show(Permintaan $permintaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permintaan $permintaan)
    {
        return view('permintaan.edit', compact('permintaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermintaanRequest  $request
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermintaanRequest $request, Permintaan $permintaan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_permintaan' => 'required',
            'nama_permintaan' => 'required|min:5|max:255',
            'nama_pengajuan' => 'required',
            'tgl_bayar' => 'required',
            'tipe_pengajuan' => 'required',
            'note' => 'required',
            'jumlah_pengajuan' => 'required',
        ]);
    
        $permintaan->update($validated);
    
        return redirect()->route('permintaan.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Permintaan $permintaan)
    public function destroy($id)
    {
        //hapus dari database
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->delete();

        return redirect()->route('permintaan.index')-F>with('success','Data Berhasil di Hapus');
    }
}
