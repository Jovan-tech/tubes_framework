@extends('layoutbootstrap')

@section('konten')

@if (isset($status_hapus))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Hapus Data Berhasil',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    </script>
@endif

<div class="body-wrapper">

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold">Data Transaksi</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Input Data</th>
                                    <th>Tanggal</th>
                                    <th>Perincian</th>
                                    <th>Pemasukan (Rp)</th>
                                    <th>Pengeluaran (Rp)</th>
                                    <th>Saldo (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $jovan => $yapius)
                                <tr>
                                    <td>{{ $jovan + 1 }}</td>
                                    <td>{{ $yapius['input_data'] }}</td>
                                    <td>{{ $yapius['tanggal'] }}</td>
                                    <td>{{ $yapius['perincian'] }}</td>
                                    <td>{{ number_format($yapius['pemasukan'], 0, ',', '.') }}</td>
                                    <td>{{ number_format($yapius['pengeluaran'], 0, ',', '.') }}</td>
                                    <td>{{ number_format($yapius['saldo'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
