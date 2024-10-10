@extends($layout)

@section('content')
<div class="container">
    <h1>Data Berita</h1>
    <button class="btn btn-primary" id="addBeritaBtn" data-bs-toggle="modal" data-bs-target="#beritaModal">Tambah Berita</button>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($berita as $item)
            <tr>
                <td><img src="{{ asset('storage/' . $item->image) }}" width="100" height="50" /></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-image="{{ asset('storage/' . $item->image) }}" data-bs-toggle="modal" data-bs-target="#beritaModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-id="{{ $item->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="beritaForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaModalLabel">Add/Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img id="previewImage" src="#" alt="Image Preview" style="width: 100%; margin-top: 10px; display: none;">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    let isEditing = false;
    let editId = null;

    document.getElementById('addBeritaBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('beritaForm').reset();
        document.getElementById('beritaModalLabel').textContent = 'Add Berita';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            var title = this.getAttribute('data-title');
            var description = this.getAttribute('data-description');
            var image = this.getAttribute('data-image');

            document.getElementById('beritaModalLabel').textContent = 'Edit Berita';
            document.getElementById('id').value = editId;
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';
        });
    });

    document.getElementById('beritaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let imageInput = this.querySelector('input[type="file"]');
        if (imageInput && imageInput.files[0]) {
            let fileSize = imageInput.files[0].size / 1024 / 1024; // konversi ke MB
            if (fileSize > 20) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
        }
        
        let formData = new FormData(this);
        
        let url = isEditing 
            ? '{{ route("admin.berita.berita.update", ":id") }}'.replace(':id', editId)
            : '{{ route("admin.berita.berita.store") }}';

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
                    fetch(`{{ route('admin.berita.berita.destroy', ':id') }}`.replace(':id', id), {
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

    document.getElementById('image').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewImage').style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection