@extends('layouts.app')
@section('content')
<div class="container">

    <example-component url="{{route('apiProdutoStore')}}"></example-component>
    <table-produto url="{{route('apiProdutoIndex')}}"></table-produto>
</div>

@endsection