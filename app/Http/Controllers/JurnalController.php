<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Http\Requests\StoreJurnalRequest;
use App\Http\Requests\UpdateJurnalRequest;


class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Fetch data from both tables
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();

    // Merge data
    $transactions = collect();

    foreach ($pemasukan as $p) {
        $transactions->push([
            'input_data' => $p->created_at,
            'tanggal' => $p->tanggal,
            'perincian' => $p->perincian,
            'pemasukan' => $p->jumlah,
            'pengeluaran' => 0, // No expenditure
            'saldo' => 0, // Placeholder, calculate later
        ]);
    }

    foreach ($pengeluaran as $p) {
        $transactions->push([
            'input_data' => $p->created_at,
            'tanggal' => $p->tanggal,
            'perincian' => $p->perincian,
            'pemasukan' => 0, // No income
            'pengeluaran' => $p->jumlah,
            'saldo' => 0, // Placeholder, calculate later
        ]);
    }

    // Sort transactions by date
    $transactions = $transactions->sortBy('tanggal');

    // Calculate saldo (balance)
    $saldo = 0;
    $transactions = $transactions->map(function ($item) use (&$saldo) {
        $saldo += $item['pemasukan'] - $item['pengeluaran'];
        $item['saldo'] = $saldo;
        return $item;
    });

    return view('layoutsbootstrap.laporan.jurnal', ['transactions' => $transactions]);
}
}