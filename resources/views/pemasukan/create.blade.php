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

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                            <i class="ti ti-bell-ringing"></i>
                            <div class="notification bg-primary rounded-circle"></div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <a href="#" class="btn btn-primary">{{ Auth::user()->name }}</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35"
                                    height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3">My Account</p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-list-check fs-6"></i>
                                        <p class="mb-0 fs-3">My Task</p>
                                    </a>
                                    <a href="{{ url('logout') }}"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <style>
            .transparan-bro {
                opacity: 0.4;
            }            
        </style>
        <div class="container-fluid">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h5 class="card-title fw-semibold">Data Pemasukan</h5>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <a href="{{ url('/pemasukan/tambah') }}"
                                            class="btn btn-success btn-icon-split">
                                            <span class="text">Tambah Pemasukan</span>
                                            <span class="icon text-white-200">
                                                <i class="ti ti-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <p class="card-title fw-semibold transparan-bro">Tanggal Awal</p>
                                        <p class="card-title fw-semibold transparan-bro">Tanggal Akhir</p>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="thead-dark">
                                                    <tr>                                                    
                                                    <th>Tanggal</th>
                                                    <th>Perincian</th>
                                                    <th>Jumlah</th>
                                                    <th>Aksi</th>                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pemasukan as $p)
                                                    <tr>
                                                        
                                                        <td>{{ $p -> tanggal}}</td>
                                                        <td>{{ $p -> perincian}}</td>
                                                        <td>Rp.{{ number_format ($p -> jumlah, 0, ',', '.') }}</td>
                                                        
                                                        <td>                                                    
                                                            <a href="{{ route('pemasukan.edit', $p->id) }}" class="btn btn-success btn-icon-split btn-sm">
                                                                <span class="icon text-white-50">
                                                                    <i class="ti ti-check"></i>
                                                                </span>
                                                                <span class="text">Ubah</span>
                                                            </a>

                                                            <a href="#" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}" class="btn btn-danger btn-icon-split btn-sm">
                                                                <span class="icon text-white-50">
                                                                    <i class="ti ti-minus"></i>
                                                                </span>
                                                                <span class="text">Hapus</span>
                                                            </a>                                                    
                                                        </td>                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>                                      
                                        </table>                    

                                </div>


@endsection