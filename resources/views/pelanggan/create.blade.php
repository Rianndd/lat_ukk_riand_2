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
            <form action="{{ route('pelanggan.store') }}" method="POST">
              @csrf
              <div class="card-body">
                  <div class="form-group">
                      <label for="nama_pelanggan" class="mb-2">Nama Pelanggan</label>
                      <input type="text" class="form-control mb-2" name="nama_pelanggan" placeholder="Masukan Nama Pelanggan" required>
                  </div>
                  <div class="form-group">
                      <label for="alamat" class="mb-2">Alamat</label>
                      <textarea name="alamat" id="alamat" class="form-control mb-2" placeholder="Masukkan Alamat"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="mb-2">Telepon</label>
                    <input type="number" class="form-control mb-2" name="telepon" placeholder="Masukan No Telepon" required>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                  <a href="{{ route('pelanggan.index') }}" class="btn btn-warning">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
@include('layouts.footer')
