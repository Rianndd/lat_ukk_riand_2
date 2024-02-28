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
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i>
                                Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped"
                        style="width: 100%; border-top: 2px solid rgb(233, 227, 227); overflow-x: auto;">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center" width="20%"><i class="bx bx-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $row->nama_kategori }}</td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('kategori.edit', $row->id) }}"
                                                class="btn btn-sm btn-primary"><i class="bx bx-edit me-1"></i></a>
                                            <form action="{{ route('kategori.destroy', $row->id) }}" method="POST"
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
        return confirm('Apakah yakin akan menghapus kategori ini ?');
    }
</script>
{{-- <style>
  #myTable thead th {
    border-top: 1px solid #ddd; /* Warna dan ketebalan garis atas yang diinginkan */
  }
</style> --}}
