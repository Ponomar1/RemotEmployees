@extends('layouts/layout')
@section('style')
    <style>
        h2{
            margin-top: 10px;
            text-align: center;
        }
        .category{
            width:55%;
            margin: 0px auto;
        }
    </style>
@endSection

@section('content')
    <h2 class="lot_name">{{$category->name}}</h2>
    <div class="category">
        <h2>Category name: {{$category->name}}</h2>
    </div>
@endSection