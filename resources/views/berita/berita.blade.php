@extends('layoutbootstrap')

@section('konten')
<!-- Main wrapper -->
<div class="body-wrapper">
    <!-- Sidebar -->

    <!-- Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" onclick="showSidebar()">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rekomendasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jabodetabek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Internasional</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hukum</a>
                        </li>                   
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Cari di berita" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                    <a href="#" class="btn btn-primary ms-2">{{ Auth::user()->name }}</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
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
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header End -->

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Berita Terbaru</h5>

                <!-- Awal Card Body Galeri Berita -->
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            @foreach ($hasil->articles as $index => $p)
                                @if($index === 0)
                                    <!-- Highlight News -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card box-shadow highlight-news">
                                            <a data-fancybox="gallery" href="{{ $p->urlToImage }}">
                                                <img class="card-img-top" alt="Card image cap" src="{{ $p->urlToImage }}">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $p->title }}</h5>
                                                <p class="card-text" style="text-align: justify;">{{ $p->description }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="{{ $p->url }}" role="button" target="_blank">View</a>
                                                    </div>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($p->publishedAt)->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Smaller News -->
                                    <div class="col-md-4">
                                        <div class="card mb-4 box-shadow news-card">
                                            <a data-fancybox="gallery" href="{{ $p->urlToImage }}">
                                                <img class="card-img-top" alt="Card image cap" src="{{ $p->urlToImage }}" width="300" height="200">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $p->title }}</h5>
                                                <p class="card-text" style="text-align: justify;">{{ $p->description }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="{{ $p->url }}" role="button" target="_blank">View</a>
                                                    </div>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($p->publishedAt)->format('M d, Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Akhir Card Body Galeri Berita -->
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: -250px;
        background-color: #111;
        padding-top: 20px;
        transition: 0.3s;
        z-index: 1000;
    }
    .sidebar-content {
        padding: 15px;
        color: white;
    }
    .sidebar-content ul {
        list-style: none;
        padding: 0;
    }
    .sidebar-content ul li {
        padding: 10px 0;
    }
    .sidebar-content ul li a {
        color: white;
        text-decoration: none;
    }
    .highlight-news .card-img-top {
        height: 400px;
        object-fit: cover;
    }
    .highlight-news .card-body {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }
    .news-card .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .news-card .card-body {
        padding: 15px;
        border-radius: 10px;
        background: #ffffff;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }
    .card-text {
        font-size: 1rem;
        color: #6c757d;
    }
</style>

<script>
    function showSidebar() {
        document.getElementById("sidebar").style.left = "0";
    }

    function hideSidebar() {
        document.getElementById("sidebar").style.left = "-250px";
    }

    document.addEventListener("DOMContentLoaded", function() {
        hideSidebar();
    });
</script>
@endsection
