@extends('admin.layouts.master')

@section('admin_content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manage News</h4>
        <a href="#" class="btn btn-primary">+ Add News</a>
    </div>

    <div class="card p-3 shadow-sm">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published By</th>
                    <th>Date</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                    <td>{{ $item->user->name ?? 'Admin' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
