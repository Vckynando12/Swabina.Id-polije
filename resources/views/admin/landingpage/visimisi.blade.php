@extends($layout)

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Visi, Misi, dan Budaya</h1>

    @foreach(['visi', 'misi', 'budaya'] as $type)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ ucfirst($type) }}</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal{{ $type }}">
                    Add {{ ucfirst($type) }}
                </button>
            </div>
            <div class="card-body">
                <div class="horizontal-scroll">
                    <div class="d-flex">
                        @foreach($$type as $index => $item)
                            <div class="card mr-4" style="min-width: 250px; max-width: 250px;">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ ucfirst($type) }} #{{ $index + 1 }}</h5>
                                    <span class="text-muted small">{{ ucfirst($item->text_align) }}</span>
                                </div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: {{ $item->text_align }}; white-space: pre-wrap;" title="{{ $item->content }}">{!! nl2br(e($item->content)) !!}</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-warning btn-custom mr-2" data-toggle="modal" data-target="#editModal{{ $item->id }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-custom" onclick="confirmDelete('{{ route('admin.landingpage.visimisi.destroy', $item->id) }}', '{{ ucfirst($type) }}')">Delete</button>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit {{ ucfirst($type) }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm{{ $item->id }}" action="{{ route('admin.landingpage.visimisi.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="content{{ $item->id }}">Content:</label>
                                                    <textarea class="form-control" id="content{{ $item->id }}" name="content" rows="4" required style="white-space: pre-wrap;">{{ $item->content }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text_align{{ $item->id }}">Text Alignment:</label> <br>
                                                    <div class="btn-group d-flex" role="group" aria-label="Text alignment">
                                                        <input type="radio" class="btn-check" name="text_align" id="alignLeft{{ $item->id }}" value="left" {{ $item->text_align == 'left' ? 'checked' : '' }} required>
                                                        <label class="btn btn-outline-primary" for="alignLeft{{ $item->id }}">
                                                            <i class="fa-solid fa-align-left"></i> Left
                                                        </label>
                                                
                                                        <input type="radio" class="btn-check" name="text_align" id="alignCenter{{ $item->id }}" value="center" {{ $item->text_align == 'center' ? 'checked' : '' }}>
                                                        <label class="btn btn-outline-primary" for="alignCenter{{ $item->id }}">
                                                            <i class="fa-solid fa-align-center"></i> Center
                                                        </label>
                                                
                                                        <input type="radio" class="btn-check" name="text_align" id="alignRight{{ $item->id }}" value="right" {{ $item->text_align == 'right' ? 'checked' : '' }}>
                                                        <label class="btn btn-outline-primary" for="alignRight{{ $item->id }}">
                                                            <i class="fa-solid fa-align-right"></i> Right
                                                        </label>
                                                
                                                        <input type="radio" class="btn-check" name="text_align" id="alignJustify{{ $item->id }}" value="justify" {{ $item->text_align == 'justify' ? 'checked' : '' }}>
                                                        <label class="btn btn-outline-primary" for="alignJustify{{ $item->id }}">
                                                            <i class="fa-solid fa-align-justify"></i> Justify
                                                        </label>
                                                    </div>
                                                </div><br>
                                                <button type="button" class="btn btn-primary" onclick="submitForm('editForm{{ $item->id }}')">Update</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal{{ $type }}" tabindex="-1" role="dialog" aria-labelledby="addModalLabel{{ $type }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel{{ $type }}">Add New {{ ucfirst($type) }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm{{ $type }}" action="{{ route('admin.landingpage.visimisi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <div class="form-group">
                                <label for="content{{ $type }}">Content:</label>
                                <textarea class="form-control" id="content{{ $type }}" name="content" rows="4" required style="white-space: pre-wrap;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="text_align{{ $type }}">Text Alignment:</label>
                                <div class="btn-group d-flex" role="group" aria-label="Text alignment">
                                    <input type="radio" class="btn-check" name="text_align" id="addAlignLeft{{ $type }}" value="left" required>
                                    <label class="btn btn-outline-primary" for="addAlignLeft{{ $type }}">
                                        <i class="fa-solid fa-align-left"></i> Left
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="addAlignCenter{{ $type }}" value="center">
                                    <label class="btn btn-outline-primary" for="addAlignCenter{{ $type }}">
                                        <i class="fa-solid fa-align-center"></i> Center
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="addAlignRight{{ $type }}" value="right">
                                    <label class="btn btn-outline-primary" for="addAlignRight{{ $type }}">
                                        <i class="fa-solid fa-align-right"></i> Right
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="addAlignJustify{{ $type }}" value="justify">
                                    <label class="btn btn-outline-primary" for="addAlignJustify{{ $type }}">
                                        <i class="fa-solid fa-align-justify"></i> Justify
                                    </label>
                                </div>
                            </div><br>
                            <button type="button" class="btn btn-primary" onclick="submitForm('addForm{{ $type }}')">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
.horizontal-scroll {
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: #6c757d #f8f9fa;
    padding-bottom: 15px;
}

.horizontal-scroll::-webkit-scrollbar {
    height: 8px;
}

.horizontal-scroll::-webkit-scrollbar-track {
    background: #f8f9fa;
}

.horizontal-scroll::-webkit-scrollbar-thumb {
    background-color: #6c757d;
    border-radius: 20px;
    border: 3px solid #f8f9fa;
}

.horizontal-scroll .d-flex {
    display: inline-flex !important;
}

.card-text {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    white-space: pre-wrap;
    height: 7.5em;
    font-size: 0.9rem;
}

.horizontal-scroll .card {
    margin-right: 20px;
}

.horizontal-scroll .card:last-child {
    margin-right: 0;
}

.card-header h5 {
    font-size: 1rem;
}

.card-header .small {
    font-size: 0.8rem;
}

.btn-custom {
    font-size: 0.85rem;
    padding: 0.375rem 0.75rem;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url, type) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this ${type}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'An unexpected error occurred.',
                        'error'
                    );
                });
            }
        });
    }

    function submitForm(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 3000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An unexpected error occurred.'
            });
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true
        });
    @endif
</script>
@endsection