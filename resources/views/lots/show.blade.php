@extends('layouts/layout')
@section('style')
    <style>
        h2{
            margin-top: 10px;
            text-align: center;
        }
        .lot{
            width:55%;
            margin: 0px auto;
        }
        .lot h2{
            text-align:left;
        }
    </style>
@endSection

@section('content')
    <h2 class="lot_name">{{$lot->name}}</h2>
    <div class="lot">
        <h2>Lot name: {{$lot->name}}</h2>
        <h2>Category: {{$category->name}}</h2>
        <h2>Description: {{$lot->description}}</h2>        
    </div>
@endSection