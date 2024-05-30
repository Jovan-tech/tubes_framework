<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
// untuk validator
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Ambil parameter 'dana' dari URL
        $danaParam = $request->query('dana');

        if ($danaParam === 'penelitian') {
            $dana = Penelitian::getPenelitian();
        } elseif ($danaParam === 'pengabdian') {
            $dana = Pengabdian::getPengabdian();
        }

        $id_customer = Auth::id(); // Dapatkan id customer dari sesi user

        return view('penjualan.view', [
            'dana' => $dana,
            'jml' => Penjualan::getJmlBarang($id_customer),
            'jml_invoice' => Penjualan::getJmlInvoice($id_customer),
            'kegiatan' => Kegiatan::getKegiatan(),
            "danaParam" => $danaParam
        ]);
    }

    // dapatkan data barang berdasarkan id barang
    public function getDataBarang($id, $dana)
    {
        $sql = "SELECT * FROM $dana WHERE id = ?";
        $barang = DB::select($sql, [$id]);
        if ($barang) {
            return response()->json([
                'status' => 200,
                'barang' => $barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan data barang berdasarkan id barang
    public function getDataBarangAll()
    {
        $barang = Penjualan::getBarang();
        if ($barang) {
            return response()->json([
                'status' => 200,
                'barang' => $barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan jumlah barang untuk keranjang
    public function getJumlahBarang()
    {
        $id_customer = Auth::id();
        $jml_barang = Penjualan::getJmlBarang($id_customer);
        if ($jml_barang) {
            return response()->json([
                'status' => 200,
                'jumlah' => $jml_barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan jumlah barang untuk keranjang
    public function getInvoice()
    {
        $id_customer = Auth::id();
        $jml_barang = Penjualan::getJmlInvoice($id_customer);
        if ($jml_barang) {
            return response()->json([
                'status' => 200,
                'jmlinvoice' => $jml_barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenjualanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'harga' => 'required',
            ]
        );

        if ($validator->fails()) {
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        } else {
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah

            if ($request->input('tipeproses') == 'tambah') {

                $id_customer = Auth::id();
                $nama_kegiatan = $request->input('idkegiatanhidden');  // id_pengajuan              
                // $id_barang = $request->input('idbaranghidden'); // harga
                $harga = $request->input('harga'); // harga

                // $brg = Penjualan::getBarangId($id_barang);
                // foreach ($brg as $b) :
                //     $harga_barang = $b->harga;
                // endforeach;

                Penjualan::inputPenjualan($id_customer, $nama_kegiatan, $harga);

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    // view keranjang
    public function keranjang(Request $request)
    {
        $danaParam = $request->query('dana');
        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer, $danaParam);
        return view(
            'penjualan/viewkeranjang',
            [
                'keranjang' => $keranjang,
                'danaParam' => $danaParam
            ]
        );
    }

    // view status
    public function viewstatus()
    {
        $id_customer = Auth::id();
        // dapatkan id ke berapa dari status pemesanan
        $id_status_pemesanan = Penjualan::getIdStatus($id_customer);
        $status_pemesanan = Penjualan::getStatusAll($id_customer);
        return view(
            'penjualan.viewstatus',
            [
                'status_pemesanan' => $status_pemesanan,
                'id_status_pemesanan' => $id_status_pemesanan
            ]
        );
    }

    // view keranjang
    public function keranjangjson()
    {
        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer);
        if ($keranjang) {
            return response()->json([
                'status' => 200,
                'keranjang' => $keranjang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    // view keranjang
    public function checkout(Request $request)
    {
        $jenisDana = $request->input("dana");
        $id_customer = Auth::id();
        Penjualan::checkout($id_customer); //proses cekout
        $barang = Penjualan::getBarang();

        return redirect('pembayaran/viewkeranjang?dana=' . $jenisDana);

    }

    // invoice
    public function invoice()
    {
        $id_customer = Auth::id();
        $invoice = Penjualan::getListInvoice($id_customer);
        if ($invoice) {
            return response()->json([
                'status' => 200,
                'invoice' => $invoice,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    // delete penjualan detail
    public function destroypenjualandetail($id_penjualan_detail)
    {
        // kembalikan stok ke semula
        Penjualan::kembalikanstok($id_penjualan_detail);

        //hapus dari database
        Penjualan::hapuspenjualandetail($id_penjualan_detail);

        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer);

        return view(
            'penjualan/viewkeranjang',
            [
                'keranjang' => $keranjang,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}
