@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="p-4 bg-white rounded shadow border border-light">
        <h1 class="mb-4 display-6 fw-bold text-dark">Daftar Produk</h1>

        <!-- Tombol Tambah Produk -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#produkModal" onclick="openModal()">
            + Tambah Produk
        </button>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th>Tanggal Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                    @if($item->foto)
                    <img src="{{ asset($item->foto) }}" width="60">

                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <span id="desc-short-{{ $item->id }}">
                                {{ Str::limit($item->description, 50) }}
                                @if(strlen($item->description) > 50)
                                    ... <a href="javascript:void(0);" onclick="toggleDesc({{ $item->id }})" >Lihat selengkapnya</a>
                                @endif
                            </span>
                            <span id="desc-full-{{ $item->id }}" style="display: none;">
                                {{ $item->description }}
                                <a href="javascript:void(0);" onclick="toggleDesc({{ $item->id }})">Sembunyikan</a>
                            </span>
                        </td>
                        <td>{{ $item->kategori->name }}</td>
                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
    @if(!empty($item->size) && is_array(json_decode($item->size, true)))
        @foreach(json_decode($item->size, true) as $sz)
            <span class="badge bg-info me-1">{{ $sz }}</span>
        @endforeach
    @else
        <span class="text-muted">-</span>
    @endif
</td>

                        <td>
                            <span class="badge {{ $item->is_publish ? 'bg-success' : 'bg-secondary' }}">
                                {{ $item->is_publish ? 'Dipublikasi' : 'Tidak Dipublikasi' }}
                            </span>
                        </td>
                        <td>{{ $item->published_at }}</td>
                        <td>
                        <button 
    class="btn btn-sm btn-warning me-1" 
    data-item='@json($item)' 
    onclick="editProduk(this)"
>
    Edit
</button>

                            <button onclick="hapusData({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="produkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="produkModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategoris_id" id="kategori_id" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>

                    <!-- Foto Produk -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                    </div>

                    <!-- Ukuran -->
                    <div class="mb-3">
    <label for="size" class="form-label">Ukuran</label>
    <select name="size[]" id="size" class="form-select" multiple required>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>
    <small class="text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu.</small>
</div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="is_publish" class="form-label">Status</label>
                        <select name="is_publish" id="is_publish" class="form-select">
                            <option value="" selected disabled>-- Pilih Status --</option>
                            <option value="1">Dipublikasi</option>
                            <option value="0">Tidak Dipublikasi</option>
                        </select>
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" class="form-control" name="published_at" id="published_at">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Produk -->
<div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProdukForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="edit_description"></textarea>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="edit_kategori_id" class="form-label">Kategori</label>
                        <select name="kategoris_id" id="edit_kategori_id" class="form-select">
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="price" id="edit_price">
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="edit_foto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" name="foto" id="edit_foto" accept="image/*">
                    </div>

                    <!-- Ukuran -->
                  <!-- Ukuran -->
<div class="mb-3">
    <label for="edit_size" class="form-label">Ukuran</label>
    <select name="size[]" id="edit_size" class="form-select" multiple required>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>
    <small class="text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu.</small>
</div>


                    <!-- Status -->
                    <div class="mb-3">
                        <label for="edit_is_publish" class="form-label">Status</label>
                        <select name="is_publish" id="edit_is_publish" class="form-select">
                            <option value="1">Dipublikasi</option>
                            <option value="0">Tidak Dipublikasi</option>
                        </select>
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div class="mb-3">
                        <label for="edit_published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" class="form-control" name="published_at" id="edit_published_at">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

<script>
    function openModal() {
        document.querySelector('#produkModal form').reset();
        document.getElementById('produkModalLabel').innerText = 'Tambah Produk';
    }

    function hapusData(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data produk akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    function toggleDesc(id) {
        const shortDesc = document.getElementById('desc-short-' + id);
        const fullDesc = document.getElementById('desc-full-' + id);

        if (shortDesc.style.display === 'none') {
            shortDesc.style.display = '';
            fullDesc.style.display = 'none';
        } else {
            shortDesc.style.display = 'none';
            fullDesc.style.display = '';
        }
    }
    function editProduk(button) {
    const data = JSON.parse(button.getAttribute('data-item'));
    $('#edit_id').val(data.id);
    $('#edit_name').val(data.name);
    $('#edit_description').val(data.description);
    $('#edit_kategori_id').val(data.kategoris_id);
    $('#edit_price').val(data.price);
    $('#edit_is_publish').val(String(data.is_publish));

     // Atur format untuk datetime-local
     if (data.published_at) {
        const date = new Date(data.published_at);
        const formatted = date.toISOString().slice(0, 16); // "YYYY-MM-DDTHH:MM"
        $('#edit_published_at').val(formatted);
    } else {
        $('#edit_published_at').val('');
    }
    
    // Pastikan size JSON valid
    if (data.size) {
        let sizes = JSON.parse(data.size);
        $('#edit_size').val(sizes).trigger('change');
    } else {
        $('#edit_size').val([]).trigger('change');
    }
    let url = '/produk/' + data.id;
    $('#editProdukForm').attr('action', url);
    $('#editProdukModal').modal('show');
}
</script>
@endsection
