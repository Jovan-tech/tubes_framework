@extends('layoutbootstrap')

@section('konten')

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
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
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
                    <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data PenelitianB</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="{{ route('penelitianb.update', $penelitianb->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <fieldset disabled>
                    <div class="mb-3"><label for="kodepenelitianblabel">Kode PenelitianB</label>
                        <input class="form-control form-control-solid" id="kode_penelitianb_tampil" name="kode_penelitianb_tampil" type="text" placeholder="Contoh: KB-001" value="{{$penelitianb -> kode_penelitianb}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="kode_penelitianb" name="kode_penelitianb" value="{{$penelitianb -> kode_penelitianb}}">

                    <div class="mb-3"><label for="bahan_penelitianlabel">Bahan Penelitian (30%)</label>
                    <input class="form-control form-control-solid" id="bahan_penelitian" name="bahan_penelitian" type="number" placeholder="Rp. 500.000" value="{{old('bahan_penelitian')}}">
                    </div>
                    
        
                    <div class="mb-0"><label for="transkrip_pengujianlabel">Transkrip Pengujian</label>
                        <textarea class="form-control form-control-solid" id="transkrip_pengujian" name="transkrip_pengujian" rows="3" placeholder="Rp. 1.000.000">{{old('transkrip_pengujian')}}</textarea>
                    </div>
                    <br>
                    <div class="mb-0"><label for="inventarislabel">Inventaris</label>
                        <textarea class="form-control form-control-solid" id="inventaris" name="inventaris" rows="3" placeholder="Rp. 1.000.000">{{old('inventaris')}}</textarea>
                    </div>
                    <br>
                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/penelitianb') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
        
@endsection