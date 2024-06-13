<!-- resources/views/pemasukan/tambah.blade.php -->
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

<!-- Main wrapper -->
<div class="body-wrapper">
    <!-- Header Start -->
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

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                            <h5 class="card-title fw-semibold">Tambah Pemasukan</h5>  
                            <br>
                            <br>                                    
                            <form action="{{ route('pemasukan.store') }}" method="post">
                            @csrf
                            <div class="mb-0">
                                <label for="jumlah">Jumlah Pengajuan</label>
                                <textarea class="form-control form-control-solid" id="jumlah" name="jumlah" rows="1">{{ old('jumlah') }}</textarea>
                            </div>
                            <br>

                            <div class="mb-0">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control form-control-solid" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            </div>
                            <br>

                            <div class="mb-0">
                                <label for="perincian">Perincian</label>
                                <textarea class="form-control form-control-solid" id="perincian" name="perincian" rows="3">{{ old('perincian') }}</textarea>
                            </div>
                            <br>

                            <!-- Add radio buttons for jenis_kegiatan -->
                            <div class="mb-0">
                                <label>Jenis Kegiatan</label><br>
                                <input type="radio" id="internal" name="jenis_kegiatan" value="internal">
                                <label for="internal">Internal</label><br>
                                <input type="radio" id="eksternal" name="jenis_kegiatan" value="eksternal">
                                <label for="eksternal">Eksternal</label>
                            </div>
                            <br>                        

                            <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Next">
                            <a class="col-sm-1 btn btn-dark btn-sm" href="{{ url('/pemasukan') }}" role="button">Cancel</a>
                            </form>                               
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kegiatanData = @json($kegiatan);

        document.querySelectorAll('input[name="jenis_kegiatan"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const selectedJenis = this.value;
                const kegiatanInfo = kegiatanData.find(k => k.jenis_kegiatan === selectedJenis);

                if (kegiatanInfo) {
                    document.getElementById('nama').value = kegiatanInfo.nama;
                    document.getElementById('alamat').value = kegiatanInfo.alamat;
                    document.getElementById('kegiatanInfo').style.display = 'block';
                } else {
                    document.getElementById('kegiatanInfo').style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
