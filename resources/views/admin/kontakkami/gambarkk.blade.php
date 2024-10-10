@extends($layout)

@section('content')
<div class="container">
    <h1>Manage Gambar KK</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Gambar KK Image</h5>
                </div>
                <div class="card-body">
                    @if($gambarKK && $gambarKK->image)
                        <img src="{{ asset('storage/' . $gambarKK->image) }}" class="img-fluid mb-2" alt="Gambar KK Image">
                        <div>
                            <button class="btn btn-warning editBtn" data-id="{{ $gambarKK->id }}" data-image="{{ asset('storage/' . $gambarKK->image) }}" data-bs-toggle="modal" data-bs-target="#gambarKKModal">Edit</button>
                            <button class="btn btn-danger deleteBtn" data-id="{{ $gambarKK->id }}">Delete</button>
                        </div>
                    @else
                        <p>No image uploaded</p>
                        <button class="btn btn-primary addBtn" data-bs-toggle="modal" data-bs-target="#gambarKKModal">Add Image</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="gambarKKModal" tabindex="-1" aria-labelledby="gambarKKModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="gambarKKForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="gambarKKModalLabel">Add/Edit Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="{{ $gambarKK ? $gambarKK->id : '' }}">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img id="previewImage" src="#" alt="Image Preview" style="width: 100%; margin-top: 10px; display: none;">
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
    document.querySelectorAll('.addBtn, .editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id') || '';
            var image = this.getAttribute('data-image') || '';

            document.getElementById('gambarKKForm').reset();
            document.getElementById('gambarKKModalLabel').textContent = id ? 'Edit Image' : 'Add Image';
            document.getElementById('id').value = id;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = image ? 'block' : 'none';
        });
    });

    document.getElementById('gambarKKForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var id = document.getElementById('id').value;
        var form = document.getElementById('gambarKKForm');
        var formData = new FormData(form);
        var url = id ? `{{ route('admin.kontakkami.gambarkk.update', '') }}/${id}` : `{{ route('admin.kontakkami.gambarkk.store') }}`;

        formData.append('_method', id ? 'PUT' : 'POST');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.message || 'Network response was not ok'); });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('gambarKKModal'));
                modal.hide();
                
                Swal.fire({
                    title: 'Success!',
                    text: 'Image saved successfully.',
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
                text: error.message || 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
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
                    fetch(`{{ route('admin.kontakkami.gambarkk.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
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
                            throw new Error(data.message || 'Failed to delete');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            error.message || 'An unexpected error occurred.',
                            'error'
                        );
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