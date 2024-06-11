<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('images/logos/kas.jpg') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('dashboardbootstrap') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Masterdata</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('kegiatan') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-receipt"></i>
                                </span>
                                <span class="hide-menu">Jenis Kegiatan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('mitra') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-clipboard"></i>
                                </span>
                                <span class="hide-menu">Mitra</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('pic') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">PIC</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('penelitian') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-typography"></i>
                                </span>
                                <span class="hide-menu">Nama Kegiatan</span>
                            </a>
                        </li>
                       

                        @if(auth()->user()->role == 'admin')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Admin</span>
                            </li>
                            <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Transaksi</span>
                        </li>
                        <li class="sidebar-item" id="menu">
                            <div class="sidebar-link">
                                <span>
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <span class="hide-menu">Kas</span>
                                <span class="hide-menu text-sm">
                                    <i class="bi bi-chevron-up" id="arrow"></i>
                                </span>
                            </div>
                        </li>
                        {{-- sub menu pengajuan --}}
                        <li class="sidebar-item {{ request()->is('penjualan*') ? '' : 'd-none' }} d-flex flex-column p-2">
                            <div>
                                <a class="sidebar-link" href="{{ url('pemasukan') }}">
                                    <span class="hide-menu pl-4">Pemasukan</span>
                                </a>
                            </div>
                            <div>
                                <a class="sidebar-link" href="{{ url('pengeluaran') }}">
                                    <span class="hide-menu pl-4">Pengeluaran</span>
                                </a>
                            </div>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('midtrans') }}" aria-expanded="false">
                                <span>
                                <i class="ti ti-credit-card"></i>
                                </span>
                                <span class="hide-menu">Midtrans</span>
                            </a>
                            </li>

                            <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('pembayaran/viewstatusPG') }}" aria-expanded="false">
                                <span>
                                <i class="ti ti-credit-card"></i>
                                </span>
                                <span class="hide-menu">View Status PG</span>
                            </a>
                            </li>

                            <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('midtrans/bayar') }}" aria-expanded="false">
                                <span>
                                <i class="ti ti-credit-card"></i>
                                </span>
                                <span class="hide-menu">Pembayaran PG</span>
                            </a>
                            </li>
                        {{-- end sub menu pengajuan --}}                        

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">LAPORAN</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('jurnal') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-files"></i>
                                </span>
                                <span class="hide-menu">Jurnal Umum</span>
                            </a>
                        </li>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">ANALISIS DATA</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-mood-happy"></i>
                                    </span>
                                    <span class="hide-menu">Icons</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-aperture"></i>
                                    </span>
                                    <span class="hide-menu">Sample Page</span>
                                </a>
                            </li>
                        @endif

                    </ul>

                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/"
                                    target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="{{ asset('images/backgrounds/rocket.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
