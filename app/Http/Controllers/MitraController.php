<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Http\Requests\StoreMitraRequest;
use App\Http\Requests\UpdateMitraRequest;

use Illuminate\Foundation\Http\FormRequest;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $mitra = Mitra::all();
        return view('mitra.view',
                    [
                        'mitra' => $mitra
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
    $mitraModel = new Mitra();

    //non-static method
    $kode_mitra = $mitraModel->getKodeMitra();

    return view('mitra.create', ['kode_mitra' => $kode_mitra]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMitraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMitraRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_mitra' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'jenis_bisnis' => 'required',
        ]);

        // masukkan ke db
        Mitra::create($request->all());
        
        return redirect()->route('mitra.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function show(Mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function edit(Mitra $mitra)
    {
        return view('mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMitraRequest  $request
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMitraRequest $request, Mitra $mitra)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_mitra' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'jenis_bisnis' => 'required',
        ]);
    
        $mitra->update($validated);
    
        return redirect()->route('mitra.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Mitra $mitra)
    public function destroy($id)
    {
        //hapus dari database
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return redirect()->route('mitra.index')->with('success','Data Berhasil di Hapus');
    }
}
