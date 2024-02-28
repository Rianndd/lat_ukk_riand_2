@include('layouts.header')
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $data['menu'] }}/</span> {{ $data['submenu'] }}</h4>

      <div class="row">
        <div class="col-xxl">
          <div class="card">
            <div class="card-header">
              <div class="row">
                @if (session('success'))
                  <div class="alert {{ session('alert-type', 'alert-info') }} alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="col-md-6">
                  <h3>{{ $data['menu'] }}</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Tambah Data</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div style="">
                <table class="table table-bordered table-striped" style="width: 100%; border-top: 2px solid rgb(233, 227, 227); overflow-x: auto;">
                  <thead>
                      <tr>
                          <th class="text-center" width="10%">No</th>
                          <th class="text-center" width="30%">Nama Supplier</th>
                          <th class="text-center">Alamat</th>
                          <th class="text-center" width="20%"><i class="bx bx-cog"></i></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($supplier as $key => $row)
                        <tr align="center">
                          <td>{{ $key + 1 }}</td>
                          <td class="text-start">{{ $row->nama_supplier }}</td>
                          <td class="text-start" >{{ $row->alamat }}</td>
                          <td align="center">
                            <div class="d-flex justify-content-center">
                              <a href="{{ route('supplier.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-edit me-1"></i></a>
                              <form action="{{ route('supplier.destroy', $row->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger ms-1"><i class="bx bx-trash me-1"></i></button>
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
  </div>
  <!-- / Content -->
@include('layouts.footer')

<script>
  function confirmDelete()
  {
    return confirm('Apakah yakin akan menghapus supplier ini ?');
  }
</script>