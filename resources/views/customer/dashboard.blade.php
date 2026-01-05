@extends('layouts.customer')

@section('title','Customer Dashboard')
@section('page-title','My Dashboard')

@section('content')
    <div class="alert alert-success">
        Welcome, {{ auth('customer')->user()->name }}
    </div>
@endsection
