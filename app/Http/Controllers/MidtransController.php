<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pembayaran;

class CobaMidtransController extends Controller
{
    // bayar
    public function bayar()
    {
        // Get items ready for payment
        $pengeluaranData = DB::table('pengeluaran')->get();

        $myArray = [];
        foreach ($pengeluaranData as $data) {
            // Prepare item details
            $itemDetail = [
                'id' => $data->id,
                'price' => $data->jumlah,
                'quantity' => 1, // Assuming quantity is always 1 for each item
                'name' => $data->perincian,
            ];

            // Add item details to array
            $myArray[] = $itemDetail;
        }

        // Calculate total gross amount
        $totaltagihan = 500000;

        // Ensure the total amount is at least 0.01
        $totaltagihan = max(0.01, $totaltagihan);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(), //idpesanan ini nanti bisa diambil dari no_pesanan
                'gross_amount' => $totaltagihan, //gross amount diisi total tagihan
            ],
            'item_details' => $myArray,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => '',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('midtrans.viewcheckout', [
            'pengeluaranData' => $pengeluaranData,
            'snap_token' => $snapToken,
        ]);
    }

    // proses bayar
    public function proses_bayar(Request $request)
    {
        $json = json_decode($request->x_json);

        $id_penjualan = $request->input('id_penjualan');
        $order_id = $json->order_id;
        $gross_amount = $json->gross_amount;
        $transaction_status = $json->transaction_status;
        $transaction_id = $json->transaction_id;
        $payment_type = $json->payment_type;
        $status_code = $json->status_code;
        
        DB::table('pg_penjualan')->insert([
            'id_penjualan' => $id_penjualan,
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_id' => $transaction_id,
            'payment_type' => $payment_type,
            'status_code' => $status_code,
        ]);

        return redirect('pembayaran/viewstatusPG');
    }
}
