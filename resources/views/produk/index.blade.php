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
                            <a href="{{ route('produk.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i>
                                Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped"
                        style="width: 100%; border-top: 2px solid rgb(233, 227, 227); overflow-x: auto;">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Kode Produk</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Harga Beli Rp</th>
                                <th class="text-center">Harga Jual Rp</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center"><i class="bx bx-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $row->kode_produk }}</td>
                                    <td class="text-start">{{ $row->nama_produk }}</td>
                                    <td class="text-start">{{ $row->kategori->nama_kategori }}</td>
                                    <td class="text-center">{{ $row->satuan->nama_satuan }}</td>
                                    <td class="text-end">{{ number_format($row->harga_beli) }}</td>
                                    <td class="text-end">{{ number_format($row->harga_jual) }}</td>
                                    <td class="text-center">{{ $row->stok }}</td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('produk.edit', $row->id) }}"
                                                class="btn btn-sm btn-primary"><i class="bx bx-edit me-1"></i></a>
                                            <form action="{{ route('produk.destroy', $row->id) }}" method="POST"
                                                onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger ms-1"><i
                                                        class="bx bx-trash me-1"></i></button>
                                            </form>
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
        return confirm('Apakah yakin akan menghapus produk ini ?');
    }
</script>
