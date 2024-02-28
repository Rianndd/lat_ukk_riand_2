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
            <form action="{{ route('users.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="nama" class="mb-2">Nama User</label>
                  <input type="text" class="form-control mb-2" name="nama" value="{{ $user->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="username" class="mb-2">Username</label>
                    <input type="text" class="form-control mb-2" name="username" value="{{ $user->username }}" required>
                </div>
                <div class="form-group">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" class="form-control mb-2" name="password" placeholder="Masukkan Password">
                </div>
                <div class="form-group">
                    <label for="level" class="mb-2">level</label>
                    <select name="level" id="level" class="form-control mb-2">
                        <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->level == 2 ? 'selected' : '' }}>Kasir</option>
                    </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                  <a href="{{ route('users.index') }}" class="btn btn-warning">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
@include('layouts.footer')
