@include('layouts.header')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $data['menu'] }}/</span> {{ $data['submenu'] }}
    </h4>
    @if (session('success'))
        <div class="alert {{ session('alert-type', 'alert-info') }} alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary pb-1 ">
                    <h6 class="text-white">Pilih Produk</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('temp.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id }}">
                        <div class="mb-3 mt-2">
                            <label class="form-label" for="">Pelanggan</label>
                            <input type="text" class="form-control text-center" name="pelanggan"
                                value="{{ $pelanggan->nama_pelanggan }}" readonly>
                        </div>
                        <div class="mb-3 mt-2">
                            <label class="form-label" for="">Produk</label>
                            <select name="id_produk" class="form-control text-center">
                                <option value="">
                                    Pilih Produk
                                </option>
                                @foreach ($produk as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->nama_produk }} - Stok {{ $row->stok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-2">
                            <label class="form-label" for="">Qty</label>
                            <input type="number" class="form-control text-center" value="0" name="jumlah">
                        </div>
                        <a type="submit" href="{{ route('transaksi.index') }}" class="btn btn-warning"><i
                                class="bx bx-arrow-back">
                                Kembali</i></a>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-cart">
                                Tambah</i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary pb-1">
                    <h6 class="text-white">E - Kasir nih</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class=" mt-2">
                                <img src="{{ asset('img/kasir.png') }}" width="230px" height="245px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" mt-2">
                                <img src="{{ asset('img/kasir.png') }}" width="230px" height="245px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header bg-primary pb-1 text-center">
                    <h6 class="text-white">Keranjang Belanja</h6>
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th width="10%">No</th>
                                    <th>Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Qty</th>
                                    <th>Subtotal Rp.</th>
                                    <th width="10%"><i class="bx bx-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($temp as $key => $row)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $row->produk->nama_produk }}</td>
                                        <td class="text-end">{{ number_format($row->produk->harga_jual) }}</td>
                                        <td class="text-center">{{ $row->jumlah }}</td>
                                        <td class="text-end">
                                            {{ number_format($row->produk->harga_jual * $row->jumlah) }}</td>
                                        <td>
                                            <form action="{{ route('temp.destroy', $row->id) }}" method="POST"
                                                onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger ms-1"><i
                                                        class="bx bx-trash me-1"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $total += $row->produk->harga_jual * $row->jumlah; @endphp
                                @endforeach
                                <form action="{{ route('transaksi.store') }}" method="POST">
                                    @csrf
                                    {{-- hidden transaksi --}}
                                    <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id }}">
                                    <tr>
                                        <td colspan="4" class="text-end">Total Harga :</td>
                                        <td class="text-end"><input type="text" name="total_harga"
                                                class="form-control text-end" value="{{ $total }}" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Bayar :</td>
                                        <td class="text-end"><input class="form-control text-end" type="text"
                                                id="bayar" name="bayar" oninput="hitungKembalian()"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Kembalian :</td>
                                        <td class="text-end"><input class="form-control text-end" type="text"
                                                id="kembalian" name="kembalian" readonly></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end">Klik ini untuk checkout :</td>
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-primary ms-2"><i
                                                    class="bx bx-check"> Simpan</i>
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                </form>
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
    function hitungKembalian() {
        var totalHarga = parseFloat('{{ $total }}');
        var bayar = parseFloat(document.getElementById('bayar').value);
        var kembalian = bayar - totalHarga;
        document.getElementById('kembalian').value = kembalian;
    }
</script>
