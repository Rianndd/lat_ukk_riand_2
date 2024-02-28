@include('layouts.header')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $data['menu'] }}/</span> {{ $data['submenu'] }}
    </h4>
    <div class="row mb-3">
        <div class="col-xxl">
            <div class="card">
                <div class="card-header bg-primary pb-1">
                    <p class="text-white">Data Supplier yang dipilih</p>
                </div>
                <div class="card-body pb-1">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mt-2"><span class="fw-bold">Nama Supplier :</span>
                                {{ $supplier->nama_supplier }}</p>
                            <p><span class="fw-bold">Alamat :</span> {{ $supplier->alamat }}</p>
                        </div>
                        <div class="col-md-6">
                            <h1 class="bx bxs-truck" style="font-size: 4em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl">
            <div class="card">
                <div class="card-header bg-primary text-white pb-1">
                    <p>Pembelian Produk</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <h5 class="mt-4">Pilih Produk</h5>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group mt-3">
                                <input type="text" class="form-control" placeholder="Pilih Produk"
                                    aria-describedby="button-addon2" disabled>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#pembelian"><i class="bx bx-right-arrow"></i></button>
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

<script>
    function confirmDelete() {
        return confirm('Apakah yakin akan menghapus supplier ini ?');
    }
</script>

<!-- Modal -->
<div class="modal fade" id="pembelian" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Pilih Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Pilih Produk</h5>
                                <small class="text-muted float-end">Silahkan Pilih Produk</small>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pembelian.store', ['id_supplier' => $supplier->id]) }}"
                                    method="POST" id="pembelianForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id_supplier" value="{{ $supplier->id }}">
                                            <label class="col-form-label" for="produk">Produk</label>
                                            <div class="">
                                                <select name="id_produk" id="produk" class="form-control"
                                                    onchange="updateSubtotal()">
                                                    @foreach ($produk as $row)
                                                        <option value="{{ $row->id }}"
                                                            data-harga="{{ $row->harga_beli }}"
                                                            data-stok="{{ $row->stok }}">
                                                            {{ $row->nama_produk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="total_produk">Kuantitas</label>
                                            <div class="">
                                                <input type="number" name="total_produk" class="form-control"
                                                    id="total_produk" placeholder="" onchange="updateSubtotal()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="subtotal">Subtotal</label>
                                            <div>
                                                <h5 id="subtotal">Subtotal : <span id="subtotalValue">Rp. 0</span></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="submit-btn">Beli Produk</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                                    <i class="bx bx-plus"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    function updateSubtotal() {
        var selectedProduct = document.getElementById('produk');
        var hargaBeli = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-harga');
        var stok = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-stok');
        var kuantitas = document.getElementById('total_produk').value;
        var subtotal = hargaBeli * kuantitas;

        document.getElementById('subtotalValue').innerText = subtotal;

        // Optional: Update stok in UI
        document.getElementById('stokValue').innerText = stok - kuantitas;
    }
</script>
