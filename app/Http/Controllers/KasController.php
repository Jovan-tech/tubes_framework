<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Http\Requests\StoreKasRequest;
use App\Http\Requests\UpdateKasRequest;

use Illuminate\Foundation\Http\FormRequest;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $kas = Kas::all();
        return view('kas.view',
                    [
                        'kas' => $kas
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
    $kasModel = new Kas();

    //non-static method
    $kode_kas = $kasModel->getKodeKas();

    return view('kas.create', ['kode_kas' => $kode_kas]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKasRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_kas' => 'required',
            'nama_kas' => 'required|unique:kas|min:5|max:255',
            'nominal_kas' => 'required',
        ]);

        // masukkan ke db
        Kas::create($request->all());
        
        return redirect()->route('kas.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function show(Kas $kas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kas $kas)
    {
    return view('kas.edit', compact('kas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKasRequest  $request
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKasRequest $request, Kas $kas)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_kas' => 'required',
            'nama_kas' => 'required|max:255',
            'nominal_kas' => 'required',
        ]);
    
        $kas->update($validated);
    
        return redirect()->route('kas.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kas  $kas
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Kas $kas)
    public function destroy($id)
    {
        //hapus dari database
        $kas = Kas::findOrFail($id);
        $kas->delete();

        return redirect()->route('kas.index')->with('success','Data Berhasil di Hapus');
    }
}
