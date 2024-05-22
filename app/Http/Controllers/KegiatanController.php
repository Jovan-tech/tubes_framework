<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $kegiatan = Kegiatan::all();
        return view('kegiatan.view',
                    [
                        'kegiatan' => $kegiatan
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
    $kegiatanModel = new Kegiatan();

    //non-static method
    $kode_kegiatan = $kegiatanModel->getKodeKegiatan();

    return view('kegiatan.create', ['kode_kegiatan' => $kode_kegiatan]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKegiatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKegiatanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_kegiatan' => 'required',
            'nama_kegiatan' => 'required|unique:kegiatan|min:5|max:255',
            'alamat_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
        ]);

        // masukkan ke db
        Kegiatan::create($request->all());
        
        return redirect()->route('kegiatan.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKegiatanRequest  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_kegiatan' => 'required',
            'nama_kegiatan' => 'required|max:255',
            'alamat_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
        ]);
    
        $kegiatan->update($validated);
    
        return redirect()->route('kegiatan.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Kegiatan $kegiatan)
    public function destroy($id)
    {
        //hapus dari database
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success','Data Berhasil di Hapus');
    }
}