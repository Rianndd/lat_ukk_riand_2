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
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="nama_supplier" class="mb-2">Nama supplier</label>
                  <input type="text" class="form-control mb-2" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat" class="mb-2">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control mb-2">{{ $supplier->alamat }}</textarea>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                  <a href="{{ route('supplier.index') }}" class="btn btn-warning">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
@include('layouts.footer')
