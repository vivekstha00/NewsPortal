@extends('admin.layouts.master')

@section('admin_content')
<div class="container mt-4">
    <h4 class="mb-4">Admin Dashboard</h4>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card p-3 shadow-sm">
                <h6>Total News</h6>
                <h3>120</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3 shadow-sm">
                <h6>Categories</h6>
                <h3>12</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3 shadow-sm">
                <h6>Reporters</h6>
                <h3>6</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card p-3 shadow-sm">
                <h6>Users</h6>
                <h3>450</h3>
            </div>
        </div>

    </div>
</div>
@endsection
