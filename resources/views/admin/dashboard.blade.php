@extends('layouts.admin')

@section('title','Admin Dashboard')
@section('page-title','Admin Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Welcome, {{ auth('admin')->user()->name }}</h5>
        </div>
    </div>
@endsection
