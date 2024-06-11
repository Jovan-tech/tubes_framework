<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJurnalRequest;
use App\Http\Requests\UpdateJurnalRequest;


class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    
    $tanggalmulai = $request->query('tanggal_mulai');
    $tanggalselesai = $request->query('tanggal_selesai');

    
    $pemasukan = Pemasukan::when($tanggalmulai, function ($query) use ($tanggalmulai) {
        return $query->where('tanggal', '>=', $tanggalmulai);
    })->when($tanggalselesai, function ($query) use ($tanggalselesai) {
        return $query->where('tanggal', '<=', $tanggalselesai);
    })->get();

    $pengeluaran = Pengeluaran::when($tanggalmulai, function ($query) use ($tanggalmulai) {
        return $query->where('tanggal', '>=', $tanggalmulai);
    })->when($tanggalselesai, function ($query) use ($tanggalselesai) {
        return $query->where('tanggal', '<=', $tanggalselesai);
    })->get();

    $kegiatan = Kegiatan::all();
    
    $data = collect();

    foreach ($pemasukan as $p) {
        $data->push([
            'input_data' => $p->created_at,
            'tanggal' => $p->tanggal,
            'perincian' => $p->perincian,
            'pemasukan' => $p->jumlah,
            'pengeluaran' => 0,
            'saldo' => 0,
        ]);
    }

    foreach ($pengeluaran as $p) {
        $data->push([
            'input_data' => $p->created_at,
            'tanggal' => $p->tanggal,
            'perincian' => $p->perincian,
            'pemasukan' => 0,
            'pengeluaran' => $p->jumlah,
            'saldo' => 0,
        ]);
    }

    
    $data = $data->sortBy('tanggal');

    
    $saldo = 0;
    $data = $data->map(function ($item) use (&$saldo) {
        $saldo += $item['pemasukan'] - $item['pengeluaran'];
        $item['saldo'] = $saldo;
        return $item;
    });

    return view('layoutsbootstrap.laporan.jurnal', ['data' => $data]);
}
}