@include('layouts.header')
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $data['menu'] }}/</span> {{ $data['submenu'] }}</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">{{ $data['submenu'] }}</h5>
          </div>
            <form action="{{ route('produk.store') }}" method="POST">
              @csrf
              <div class="card-body">
                  <div class="form-group">
                      <label for="kode_produk" class="mb-2">Kode Produk</label>
                      <input type="text" class="form-control mb-2" name="kode_produk" placeholder="Masukan Kode Produk" required>
                  </div>
                  <div class="form-group">
                      <label for="nama_produk" class="mb-2">Nama Produk</label>
                      <input type="text" class="form-control mb-2" name="nama_produk" placeholder="Masukan Nama Produk" required>
                  </div>
                  <div class="form-group">
                      <label for="kategori" class="mb-2">Kategori</label>
                      <select name="kategori" id="kategori" class="form-control mb-2">
                        <option value=""><<--  Pilih Kategori  -->></option>
                        @foreach ($kategori as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="satuan" class="mb-2">Satuan</label>
                      <select name="satuan" id="satuan" class="form-control mb-2">
                        <option value=""><<--  Pilih Satuan  -->></option>
                        @foreach ($satuan as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_satuan }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="harga_beli" class="mb-2">Harga Beli</label>
                    <input type="number" class="form-control mb-2" name="harga_beli" placeholder="Masukan Harga Beli" required>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-6">
                      <label for="harga_jual" class="mb-2">Harga Jual</label>
                      <input type="number" class="col-6 form-control mb-2" name="harga_jual" placeholder="Masukan Harga Jual" required>
                    </div>
                    <div class="col-md-6">
                      <label for="stok" class="mb-2">Stok</label>
                      <input type="number" class="form-control mb-2" name="stok" placeholder="Masukan Stok" required>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                  <a href="{{ route('produk.index') }}" class="btn btn-warning">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
@include('layouts.footer')
