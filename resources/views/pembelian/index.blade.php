@include('layouts.header')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $data['menu'] }}/</span> {{ $data['submenu'] }}
    </h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        @if (session('success'))
                            <div class="alert {{ session('alert-type', 'alert-info') }} alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <h3>{{ $data['menu'] }}</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#pembelian"><i class="bx bx-plus"></i> Tambah Transaksi</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table table-bordered table-striped"
                            style="width: 100%; border-top: 2px solid rgb(233, 227, 227); overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">No</th>
                                    <th class="text-center" width="20%">Nama Supplier</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Kuantitas</th>
                                    <th class="text-center">Total Harga Rp.</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembelian as $key => $row)
                                    <tr align="center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-start">{{ $row->supplier->nama_supplier }}</td>
                                        <td class="text-start">{{ $row->produk->nama_produk }}</td>
                                        <td class="text-center">{{ $row->total_produk }}</td>
                                        <td class="text-end">{{ number_format($row->total_harga) }}</td>
                                        <td class="text-start">{{ $row->tanggal }}</td>
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
<!-- / Content -->
@include('layouts.footer')

<script>
    function confirmDelete() {
        return confirm('Apakah yakin akan menghapus supplier ini ?');
    }
</script>

<!-- Modal -->
<div class="modal modal-top fade" id="pembelian" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Pilih Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Daftar Supplier</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr align="center">
                                    <th width="10%">No</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($supplier as $key => $row)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->nama_supplier }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pembelian.show', ['id_supplier' => $row->id]) }}"
                                                class="btn btn-primary btn-xs">Pilih</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>
