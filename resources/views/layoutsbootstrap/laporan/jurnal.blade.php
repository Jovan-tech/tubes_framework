@extends('layoutbootstrap')

@section('konten')

<div class="body-wrapper">

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold">Data Transaksi</h5>
                    </div>

                    <form method="GET" action="{{ route('jurnal.index') }}">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="tanggal_mulai">Tanggal mulai</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="tanggal_selesai">Tanggal selesai</label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mt-4">Cari</button>
                                <a href="{{ route('jurnal.index') }}" class="btn btn-secondary mt-4">Reset</a>
                            </div>
                        </div>
                    </form>
                    <?php $nomor = 0; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th colspan="2" style="text-align: center;">Akun</th>                                
                                    <th>Debit (Rp)</th>
                                    <th>Credit (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $jovan => $yapius)
                                    @if (str_contains(strtolower($yapius['perincian']), 'masuk'))
                                        <tr>
                                            <td rowspan="2">{{ ++$nomor }}</td>
                                            <td rowspan="2">{{ $yapius['tanggal'] }}</td>
                                            <td rowspan="2">Kas</td>
                                            <td> </td>
                                            <td>{{ number_format($yapius['pemasukan'], 0, ',', '.') }}</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan</td>
                                            <td>0</td>
                                            <td>{{ number_format($yapius['pemasukan'], 0, ',', '.') }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td rowspan="2">{{ ++$nomor }}</td>
                                            <td rowspan="2">{{ $yapius['tanggal'] }}</td>
                                            <td rowspan="2">Pendapatan</td>
                                            <td> </td>                                            
                                            <td>{{ number_format($yapius['pengeluaran'], 0, ',', '.') }}</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Kas</td>
                                            <td>0</td>
                                            <td>{{ number_format($yapius['pengeluaran'], 0, ',', '.') }}</td>
                                            
                                        </tr>
                                    @endif
                                @endforeach
                                {{-- Total Row --}}
                                <tr>
                                    <td colspan="5" rowspan="5" style="text-align :right;">
                                    <strong>Total:</strong></td>
                                    <td><strong>{{ number_format($yapius['saldo'], 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<style>
    /* Apply alternate row colors */
    tbody tr.even {
        background-color: #f9f9f9; /* Even row color */
    }

    tbody tr.odd {
        background-color: #ffffff; /* Odd row color */
    }
</style>
@endpush
