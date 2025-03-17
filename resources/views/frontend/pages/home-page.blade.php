@extends('frontend.layout.app')
@section('title', 'Home')
@section('content')

@include('frontend.components.home.hero')
@include('frontend.components.home.product-list')
<script>
        (async () => {
           await HeroInfo();
           await ProductList();
        })();
</script>

@endsection

