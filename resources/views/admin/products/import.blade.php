@extends('layouts.admin')

@section('title','Import Products')
@section('page-title','Bulk Import Products')

@section('content')
<div class="card col-md-6">
    <div class="card-body">
        <form action="{{ route('admin.products.import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Upload CSV / Excel</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button class="btn btn-success">Start Import</button>
        </form>
    </div>
</div>
@endsection
