@extends('backend.layout.master')

@section('title', 'Admn || Item List')

@section('breadcum')
    <span class="text-muted fw-light">Admin /</span> Item List
@endsection

@section('content')
    @include('backend.components.product.index')
    @include('backend.components.product.delete')
@endsection
