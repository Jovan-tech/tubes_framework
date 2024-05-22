<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;

use Illuminate\Foundation\Http\FormRequest;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $penelitian = Penelitian::all();
        return view('penelitian.view',
                    [
                        'penelitian' => $penelitian
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
    $penelitianModel = new Penelitian();

    //non-static method
    $kode_penelitian = $penelitianModel->getKodePenelitian();

    return view('penelitian.create', ['kode_penelitian' => $kode_penelitian]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenelitianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenelitianRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'kode_penelitian' => 'required',
            'internal' => 'required',
            'eksternal' => 'required',
            'lainnya' => 'required',
        ]);

        // masukkan ke db
        Penelitian::create($request->all());
        
        return redirect()->route('penelitian.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function show(Penelitian $penelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penelitian $penelitian)
    {
        return view('penelitian.edit', compact('penelitian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenelitianRequest  $request
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenelitianRequest $request, Penelitian $penelitian)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_penelitian' => 'required',
            'internal' => 'required',
            'eksternal' => 'required',
            'lainnya' => 'required',
        ]);
    
        $penelitian->update($validated);
    
        return redirect()->route('penelitian.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Penelitian $penelitian)
    public function destroy($id)
    {
        //hapus dari database
        $penelitian = Penelitian::findOrFail($id);
        $penelitian->delete();

        return redirect()->route('penelitian.index')->with('success','Data Berhasil di Hapus');
    }
}
