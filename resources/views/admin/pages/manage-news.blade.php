@extends('admin.layouts.master')

@section('admin_content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manage News</h4>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add News
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-0 mt-2">Total News: <span class="badge bg-primary">{{ $news->count() }}</span></h6>
                </div>
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search news...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($news->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No news articles yet</h5>
                    <p class="text-muted">Start by adding your first news article!</p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add News
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="newsTable">
                        <thead class="table-light">
                            <tr>
                                <th width="50px">#</th>
                                <th width="80px">Image</th>
                                <th>Title</th>
                                <th width="120px">Category</th>
                                <th width="150px">Published By</th>
                                <th width="120px">Date</th>
                                <th width="150px" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($news as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}"
                                             alt="News Image"
                                             class="img-thumbnail"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center text-white"
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ Str::limit($item->title, 50) }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->content, 80) }}</small>
                                </td>
                                <td>
                                    @if($item->category)
                                        <span class="badge bg-info">{{ $item->category }}</span>
                                    @else
                                        <span class="badge bg-secondary">Uncategorized</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-user-circle"></i> {{ $item->user->name ?? 'Unknown' }}
                                </td>
                                <td>
                                    <small>{{ $item->created_at->format('M d, Y') }}</small>
                                    <br>
                                    <small class="text-muted">{{ $item->created_at->format('h:i A') }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                           class="btn btn-sm btn-primary"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Modal for each item -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this news?</p>
                                            <p class="text-muted"><strong>{{ $item->title }}</strong></p>
                                            <p class="text-danger"><small>This action cannot be undone!</small></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Simple search functionality
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    const filter = this.value.toUpperCase();
    const table = document.getElementById('newsTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j]) {
                const txtValue = cells[j].textContent || cells[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        rows[i].style.display = found ? '' : 'none';
    }
});
</script>

@endsection
