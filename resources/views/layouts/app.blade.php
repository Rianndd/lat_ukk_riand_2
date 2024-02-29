@include('layouts.header')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title">Selamat Datang <span class="text-primary">{{ $data['contoh_user'] }} !
                                    🎉</span></h5>
                            <h5 class="mb-4">
                                Kamu login di E - Kasir sebagai <span class="fw-bold">Level.</span>
                            </h5>

                            <a href="/" class="btn btn-sm btn-outline-primary">Dashboard</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-header">
                                    Total Produk
                                </div>
                                <div class="card-body">
                                    <div><i class="bx bx-store mb-2"></i></div>
                                    <h5 class="card-title text-white">{{ $jumlah_produk }} produk</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-header">
                                    Total Supplier
                                </div>
                                <div class="card-body">
                                    <div><i class="bx bx-store mb-2"></i></div>
                                    <h5 class="card-title text-white">{{ $jumlah_supplier }} Supplier</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-header">
                                    Total Pelanggan
                                </div>
                                <div class="card-body">
                                    <div><i class="bx bx-store mb-2"></i></div>
                                    <h5 class="card-title text-white">{{ $jumlah_pelanggan }} Pelanggan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-header">
                                    Total Transaksi
                                </div>
                                <div class="card-body">
                                    <div><i class="bx bx-store mb-2"></i></div>
                                    <h5 class="card-title text-white">{{ $jumlah_transaksi }} Transaksi</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@include('layouts.footer')
