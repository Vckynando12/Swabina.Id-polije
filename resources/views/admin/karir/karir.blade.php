@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Karir</h2>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#karirModal" id="addKarirBtn">
        Tambah Karir
    </button>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Judul</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karirs as $karir)
            <tr>
                <td>{{ $karir->judul }}</td>
                <td><a href="{{ asset('storage/documents/' . $karir->file) }}" target="_blank">Lihat File</a></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning editBtn" 
                        data-id="{{ $karir->id }}" 
                        data-judul="{{ $karir->judul }}" 
                        data-file="{{ $karir->file }}">
                        Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $karir->id }}">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Karir -->
<div class="modal fade" id="karirModal" tabindex="-1" role="dialog" aria-labelledby="karirModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="karirModalLabel">Tambah Karir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="karirForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File (PDF, Word, Excel)</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                    <div id="currentFile" style="display: none;">
                        <p>File saat ini: <span id="currentFileName"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    let isEditing = false;
    let editId = null;

    document.getElementById('addKarirBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('karirForm').reset();
        document.getElementById('karirModalLabel').textContent = 'Tambah Karir';
        document.getElementById('currentFile').style.display = 'none';
        document.getElementById('id').value = '';
        document.getElementById('file').required = true;
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            var judul = this.getAttribute('data-judul');
            var file = this.getAttribute('data-file');

            document.getElementById('karirModalLabel').textContent = 'Edit Karir';
            document.getElementById('id').value = editId;
            document.getElementById('judul').value = judul;
            document.getElementById('currentFileName').textContent = file;
            document.getElementById('currentFile').style.display = 'block';
            document.getElementById('file').required = false;

            $('#karirModal').modal('show');
        });
    });

    document.getElementById('karirForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let fileInput = this.querySelector('input[type="file"]');
        if (fileInput && fileInput.files[0]) {
            let fileSize = fileInput.files[0].size / 1024 / 1024; // konversi ke MB
            if (fileSize > 20) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
        }
        
        let formData = new FormData(this);
        
        let url = isEditing 
            ? '{{ route("admin.karir.karir.update", ":id") }}'.replace(':id', editId)
            : '{{ route("admin.karir.karir.store") }}';

        let method = isEditing ? 'POST' : 'POST';
        
        if (isEditing) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Success!', data.message, 'success').then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Unknown error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', error.message || 'An unexpected error occurred. Please try again.', 'error');
        });
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.karir.karir.destroy', ':id') }}`.replace(':id', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to delete item');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        });
    });
</script>

@endsection