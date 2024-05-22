<?php

namespace App\Http\Controllers;

use App\Models\PIC;
use App\Http\Requests\StorePICRequest;
use App\Http\Requests\UpdatePICRequest;

use Illuminate\Foundation\Http\FormRequest;

class PICController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $pic = PIC::all();
        return view('pic.view',
                    [
                        'pic' => $pic
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
    $picModel = new PIC();

    //non-static method
    $id_pic = $picModel->getKodePIC();

    return view('pic.create', ['id_pic' => $id_pic]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePICRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePICRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'id_pic' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'no' => 'required',
        ]);

        // masukkan ke db
        PIC::create($request->all());
        
        return redirect()->route('pic.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PIC  $pic
     * @return \Illuminate\Http\Response
     */
    public function show(PIC $pic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PIC  $pic
     * @return \Illuminate\Http\Response
     */
    public function edit(PIC $pic)
    {
        return view('pic.edit', compact('pic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePICRequest  $request
     * @param  \App\Models\PIC  $pic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePICRequest $request, PIC $pic)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'id_pic' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'no' => 'required',
        ]);
    
        $pic->update($validated);
    
        return redirect()->route('pic.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PIC  $pic
     * @return \Illuminate\Http\Response
     */
    // public function destroy(PIC $pic)
    public function destroy($id)
    {
        //hapus dari database
        $pic = PIC::findOrFail($id);
        $pic->delete();

        return redirect()->route('pic.index')->with('success','Data Berhasil di Hapus');
    }
}
