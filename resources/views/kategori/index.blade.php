@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="p-4 rounded border border-white bg-white shadow">
        <h1 class="mb-4 display-6 fw-bold text-black">Data Kategori</h1>

        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal" onclick="openModal()">
            + Tambah Kategori
        </button>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm align-middle bg-white">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm me-1"
                                    onclick="editKategori({{ $item->id }}, '{{ $item->name }}')">
                                Edit
                            </button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                        onclick="hapusData({{ $item->id }})">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Bootstrap -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="kategoriForm" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" id="kategori_id" name="kategori_id">

            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function openModal() {
    document.getElementById('kategoriModalLabel').textContent = 'Tambah Kategori';
    document.getElementById('kategoriForm').action = "{{ route('kategori.store') }}";
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('kategori_id').value = '';
    document.getElementById('name').value = '';
}

function editKategori(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('kategoriModal'));
    modal.show();

    document.getElementById('kategoriModalLabel').textContent = 'Edit Kategori';
    document.getElementById('kategoriForm').action = "/kategori/" + id;
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('kategori_id').value = id;
    document.getElementById('name').value = name;
}

function hapusData(id) {
    Swal.fire({
        title: 'Hapus data ini?',
        text: "Data akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

@if(session('success'))
Swal.fire({
    toast: true,
    icon: 'success',
    title: "{{ session('success') }}",
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
});
@endif
</script>
@endpush
