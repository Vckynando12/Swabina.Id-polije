@extends($layout)
@section('content')
<div class="container">
    <h2>Manage Texts</h2>
    
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add New Text</button>
    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Text</th>
            <th>Alignment</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($texts as $text)
        <tr>
            <td>{{ $text->id }}</td>
            <td style="text-align: {{ $text->text_align }}; white-space: pre-wrap;">{!! nl2br(e($text->text)) !!}</td>
            <td>{{ ucfirst($text->text_align) }}</td>
            <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $text->id }}">Edit</button>
                <button class="btn btn-danger" onclick="confirmDelete('{{ route('admin.digitalsolution.textds.destroy', $text->id) }}')">Delete</button>
            </td>
        </tr>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $text->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $text->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $text->id }}">Edit Text</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.digitalsolution.textds.update', $text->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="text{{ $text->id }}">Text:</label>
                                <textarea class="form-control" id="text{{ $text->id }}" name="text" rows="4" required style="white-space: pre-wrap;">{{ $text->text }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="text_align{{ $text->id }}">Text Alignment:</label>
                                <div class="btn-group d-flex" role="group" aria-label="Text alignment">
                                    <input type="radio" class="btn-check" name="text_align" id="alignLeft{{ $text->id }}" value="left" {{ $text->text_align == 'left' ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-primary" for="alignLeft{{ $text->id }}">
                                        <i class="fa-solid fa-align-left"></i> Left
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="alignCenter{{ $text->id }}" value="center" {{ $text->text_align == 'center' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="alignCenter{{ $text->id }}">
                                        <i class="fa-solid fa-align-center"></i> Center
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="alignRight{{ $text->id }}" value="right" {{ $text->text_align == 'right' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="alignRight{{ $text->id }}">
                                        <i class="fa-solid fa-align-right"></i> Right
                                    </label>
                            
                                    <input type="radio" class="btn-check" name="text_align" id="alignJustify{{ $text->id }}" value="justify" {{ $text->text_align == 'justify' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="alignJustify{{ $text->id }}">
                                        <i class="fa-solid fa-align-justify"></i> Justify
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </table>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Text</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.digitalsolution.textds.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea class="form-control" id="text" name="text" rows="4" required style="white-space: pre-wrap;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="text_align">Text Alignment:</label>
                            <div class="btn-group d-flex" role="group" aria-label="Text alignment">
                                <input type="radio" class="btn-check" name="text_align" id="addAlignLeft" value="left" required>
                                <label class="btn btn-outline-primary" for="addAlignLeft">
                                    <i class="fa-solid fa-align-left"></i> Left
                                </label>
                        
                                <input type="radio" class="btn-check" name="text_align" id="addAlignCenter" value="center">
                                <label class="btn btn-outline-primary" for="addAlignCenter">
                                    <i class="fa-solid fa-align-center"></i> Center
                                </label>
                        
                                <input type="radio" class="btn-check" name="text_align" id="addAlignRight" value="right">
                                <label class="btn btn-outline-primary" for="addAlignRight">
                                    <i class="fa-solid fa-align-right"></i> Right
                                </label>
                        
                                <input type="radio" class="btn-check" name="text_align" id="addAlignJustify" value="justify">
                                <label class="btn btn-outline-primary" for="addAlignJustify">
                                    <i class="fa-solid fa-align-justify"></i> Justify
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>
@endsection