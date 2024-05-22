<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use App\Http\Requests\StorePengabdianRequest;
use App\Http\Requests\UpdatePengabdianRequest;

use Illuminate\Foundation\Http\FormRequest;

class PengabdianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $pengabdian = Pengabdian::all();
        return view('pengabdian.view',
                    [
                        'pengabdian' => $pengabdian
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
    $pengabdianModel = new Pengabdian();

    //non-static method
    $kode_pengabdian = $pengabdianModel->getKodePengabdian();

    return view('pengabdian.create', ['kode_pengabdian' => $kode_pengabdian]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengabdianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengabdianRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_pengabdian' => 'required',
            'internal' => 'required',
            'eksternal' => 'required',
        ]);

        // masukkan ke db
        Pengabdian::create($request->all());
        
        return redirect()->route('pengabdian.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengabdian  $pengabdian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengabdian $pengabdian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengabdian  $pengabdian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengabdian $pengabdian)
    {
        return view('pengabdian.edit', compact('pengabdian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengabdianRequest  $request
     * @param  \App\Models\Pengabdian  $pengabdian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengabdianRequest $request, Pengabdian $pengabdian)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_pengabdian' => 'required',
            'internal' => 'required',
            'eksternal' => 'required',
        ]);
    
        $pengabdian->update($validated);
    
        return redirect()->route('pengabdian.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengabdian  $pengabdian
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pengabdian $pengabdian)
    public function destroy($id)
    {
        //hapus dari database
        $pengabdian = Pengabdian::findOrFail($id);
        $pengabdian->delete();

        return redirect()->route('pengabdian.index')->with('success','Data Berhasil di Hapus');
    }
}
