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
                                data-bs-target="#transaksi"><i class="bx bx-plus"></i> Tambah Transaksi</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped"
                        style="width: 100%; border-top: 2px solid rgb(233, 227, 227); overflow-x: auto;">
                        <thead>
                            <tr align="center">
                                <th width="10%">No</th>
                                <th>Pelanggan</th>
                                <th width="30%">Tanggal Transaksi</th>
                                <th width="15%"><i class="bx bx-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $row->pelanggan->nama_pelanggan }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('transaksi.edit', $row->id) }}" class="btn btn-primary btn-sm">
                                                <i class="bx bx-data"></i> Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@include('layouts.footer')

<script>
    function confirmDelete() {
        return confirm('Apakah yakin akan menghapus transaksi ini ?');
    }
</script>

<!-- Modal Transaksi -->
<div class="modal modal-top fade" id="transaksi" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Pilih Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Pilih Pelanggan</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">No</th>
                                    <th class="text-center" width="20%">Nama Pelanggan</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center" width="10%"><i class="bx bx-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggan as $key => $row)
                                    <tr align="center">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-start">{{ $row->nama_pelanggan }}</td>
                                        <td class="text-start">{{ $row->alamat }}</td>
                                        <td align="center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('transaksi.show', $row->id) }}"
                                                    class="btn btn-primary btn-xs">Pilih</a>
                                            </div>
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