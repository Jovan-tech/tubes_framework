<?php

namespace App\Http\Controllers;

use App\Models\PenelitianB;
use App\Http\Requests\StorePenelitianBRequest;
use App\Http\Requests\UpdatePenelitianBRequest;

use Illuminate\Foundation\Http\FormRequest;

class PenelitianBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $penelitianb = PenelitianB::all();
        return view('penelitianb.view',
                    [
                        'penelitianb' => $penelitianb
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
    $penelitianbModel = new PenelitianB();

    //non-static method
    $kode_penelitianb = $penelitianbModel->getKodePenelitianB();

    return view('penelitianb.create', ['kode_penelitianb' => $kode_penelitianb]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenelitianBRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenelitianBRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_penelitianb' => 'required',
            'bahan_penelitian' => 'required',
            'transkrip_pengujian' => 'required',
            'inventaris' => 'required',
        ]);

        // masukkan ke db
        PenelitianB::create($request->all());
        
        return redirect()->route('penelitianb.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenelitianB  $penelitianb
     * @return \Illuminate\Http\Response
     */
    public function show(PenelitianB $penelitianb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenelitianB  $penelitianb
     * @return \Illuminate\Http\Response
     */
    public function edit(PenelitianB $penelitianb)
    {
        return view('penelitianb.edit', compact('penelitianb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenelitianBRequest  $request
     * @param  \App\Models\PenelitianB  $penelitianb
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenelitianBRequest $request, PenelitianB $penelitianb)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_penelitianb',
            'bahan_penelitian' => 'required',
            'transkrip_pengujian' => 'required',
            'inventaris' => 'required',
        ]);
    
        $penelitianb->update($validated);
    
        return redirect()->route('penelitianb.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenelitianB  $penelitianb
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PenelitianB $penelitianb)
    public function destroy($id)
    {
        //hapus dari database
        $penelitianb = PenelitianB::findOrFail($id);
        $penelitianb->delete();

        return redirect()->route('penelitianb.index')->with('success','Data Berhasil di Hapus');
    }
}
