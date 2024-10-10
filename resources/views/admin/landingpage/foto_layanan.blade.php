@extends($layout)

@section('content')
<div class="container">
    <h1>Manage Foto Layanan</h1>
    <button class="btn btn-primary" id="addFotoLayananBtn" data-bs-toggle="modal" data-bs-target="#fotoLayananModal">Add Foto Layanan</button>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fotoLayanans as $fotoLayanan)
            <tr>
                <td>
                    @if($fotoLayanan->image1)
                    <img src="{{ Storage::url($fotoLayanan->image1) }}" width="100" height="50" />
                    @endif
                </td>
                <td>
                    @if($fotoLayanan->image2)
                    <img src="{{ Storage::url($fotoLayanan->image2) }}" width="100" height="50" />
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $fotoLayanan->id }}" data-image1="{{ $fotoLayanan->image1 }}" data-image2="{{ $fotoLayanan->image2 }}" data-bs-toggle="modal" data-bs-target="#fotoLayananModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-id="{{ $fotoLayanan->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="fotoLayananModal" tabindex="-1" aria-labelledby="fotoLayananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fotoLayananForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoLayananModalLabel">Add/Edit Foto Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image1">Image 1</label>
                        <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
                        <img id="previewImage1" src="#" alt="Image 1 Preview" style="width: 100%; margin-top: 10px; display: none;">
                    </div>
                    <div class="form-group">
                        <label for="image2">Image 2</label>
                        <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
                        <img id="previewImage2" src="#" alt="Image 2 Preview" style="width: 100%; margin-top: 10px; display: none;">
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
    document.addEventListener('DOMContentLoaded', function () {
        const addFotoLayananBtn = document.getElementById('addFotoLayananBtn');
        const fotoLayananForm = document.getElementById('fotoLayananForm');
        const editBtns = document.querySelectorAll('.editBtn');
        const deleteBtns = document.querySelectorAll('.deleteBtn');
        const image1Input = document.getElementById('image1');
        const image2Input = document.getElementById('image2');
        const previewImage1 = document.getElementById('previewImage1');
        const previewImage2 = document.getElementById('previewImage2');

        addFotoLayananBtn.addEventListener('click', function() {
            fotoLayananForm.reset();
            document.getElementById('fotoLayananModalLabel').textContent = 'Add Foto Layanan';
            previewImage1.style.display = 'none';
            previewImage2.style.display = 'none';
            document.getElementById('id').value = '';
        });

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('fotoLayananModalLabel').textContent = 'Edit Foto Layanan';
                document.getElementById('id').value = this.getAttribute('data-id');
                previewImage1.src = this.getAttribute('data-image1') ? "{{ Storage::url('') }}/" + this.getAttribute('data-image1') : '';
                previewImage1.style.display = this.getAttribute('data-image1') ? 'block' : 'none';
                previewImage2.src = this.getAttribute('data-image2') ? "{{ Storage::url('') }}/" + this.getAttribute('data-image2') : '';
                previewImage2.style.display = this.getAttribute('data-image2') ? 'block' : 'none';
                
                // Reset file inputs
                image1Input.value = '';
                image2Input.value = '';
            });
        });

        fotoLayananForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('id').value;
            const url = id ? `/fotolayanan/update/${id}` : '/fotolayanan/store';

            // Remove empty fields from FormData
            for (let pair of formData.entries()) {
                if (pair[1] === '') {
                    formData.delete(pair[0]);
                }
            }

            // If it's an update, add PUT method
            if (id) {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.text())
            .then(text => {
                console.log('Raw response:', text);
                try {
                    return JSON.parse(text);
                } catch (error) {
                    throw new Error('Server response is not valid JSON: ' + text);
                }
            })
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('fotoLayananModal'));
                    modal.hide();
                    
                    Swal.fire({
                        title: 'Success!',
                        text: 'Foto Layanan saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });

        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
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
                        fetch(`/fotolayanan/destroy/${id}`, {
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

        function previewImage(input, preview) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        image1Input.addEventListener('change', function() {
            previewImage(this, previewImage1);
        });

        image2Input.addEventListener('change', function() {
            previewImage(this, previewImage2);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const fotoLayananForm = document.getElementById('fotoLayananForm');

        fotoLayananForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let image1Input = this.querySelector('input[name="image1"]');
            let image2Input = this.querySelector('input[name="image2"]');
            
            let checkFileSize = function(file) {
                if (file) {
                    let fileSize = file.size / 1024 / 1024; // konversi ke MB
                    if (fileSize > 20) {
                        return false;
                    }
                }
                return true;
            };
            
            if (!checkFileSize(image1Input.files[0]) || !checkFileSize(image2Input.files[0])) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
            
            let formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
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

        // Tambahkan event listener untuk preview gambar
        const image1Input = document.getElementById('image1');
        const image2Input = document.getElementById('image2');
        const previewImage1 = document.getElementById('previewImage1');
        const previewImage2 = document.getElementById('previewImage2');

        function previewImage(input, preview) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        image1Input.addEventListener('change', function() {
            previewImage(this, previewImage1);
        });

        image2Input.addEventListener('change', function() {
            previewImage(this, previewImage2);
        });
    });
</script>
@endsection