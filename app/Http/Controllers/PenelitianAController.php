<?php

namespace App\Http\Controllers;

use App\Models\PenelitianA;
use App\Http\Requests\StorePenelitianARequest;
use App\Http\Requests\UpdatePenelitianARequest;

use Illuminate\Foundation\Http\FormRequest;

class PenelitianAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $penelitiana = PenelitianA::all();
        return view('penelitiana.view',
                    [
                        'penelitiana' => $penelitiana
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
    $penelitianaModel = new PenelitianA();

    //non-static method
    $kode_penelitiana = $penelitianaModel->getKodePenelitianA();

    return view('penelitiana.create', ['kode_penelitiana' => $kode_penelitiana]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenelitianARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenelitianARequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_penelitiana' => 'required',
            'bahan_penelitian' => 'required',
            'transkrip_pengujian' => 'required',
            'inventaris' => 'required',
        ]);

        // masukkan ke db
        PenelitianA::create($request->all());
        
        return redirect()->route('penelitiana.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenelitianA  $penelitiana
     * @return \Illuminate\Http\Response
     */
    public function show(PenelitianA $penelitiana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenelitianA  $penelitiana
     * @return \Illuminate\Http\Response
     */
    public function edit(PenelitianA $penelitiana)
    {
        return view('penelitiana.edit', compact('penelitiana'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenelitianARequest  $request
     * @param  \App\Models\PenelitianA  $penelitiana
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenelitianARequest $request, PenelitianA $penelitiana)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_penelitiana' => 'required',
            'bahan_penelitian' => 'required',
            'transkrip_pengujian' => 'required',
            'inventaris' => 'required',
        ]);
    
        $penelitiana->update($validated);
    
        return redirect()->route('penelitiana.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenelitianA  $penelitiana
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PenelitianA $penelitiana)
    public function destroy($id)
    {
        //hapus dari database
        $penelitiana = PenelitianA::findOrFail($id);
        $penelitiana->delete();

        return redirect()->route('penelitiana.index')->with('success','Data Berhasil di Hapus');
    }
}
