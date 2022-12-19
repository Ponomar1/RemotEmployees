@extends('layouts/layout')
@section('style')
<style>
.contentitems {
    display: flex;
    justify-content: center;
}
caption{
 font-size:1.6em;
}
.create,
.search {
    margin: 10px;
    color: #fff;
    background-color: rgb(6, 41, 78);
}

.create,
.del,
.search{
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
}

table {
    border-collapse: collapse;
    font-size:1.2em;
}

th,
td {
    border: 1px solid rgb(30, 159, 214);
}

td {
    padding: 0 5px 0 5px;
    text-align: center;
}

td a {
    border: none;
    text-decoration: none;
    color: black;
}

.del {
    border: none;
    background-color: rgb(255, 2, 2);
    color: #fff;
}
.filter{
    margin-left:10px;
}
.filter input{
    padding:5px;
    outline:none;
    font-size:1.2em;
}
</style>
@endSection

@section('content')
<div class="contentitems">
<form action="{{route('categories.create')}}">
    <button class="create">Create a category</button>
</form>
<table>
    <caption><b>All categories.</b></caption>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Del</th>
    </tr>
    @foreach($categories as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td><a href="{{route('categories.show', $item->id)}}">{{$item->name}}</a></td>
        <td><a href="{{URL::to('categories/'.$item->id.'/edit')}}">Edit</a></td>
        <td>
            <form action="{{ route('categories.destroy', $item->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="del">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<form class="filter" action="{{ route('categories.index') }}">
    <input type="text" name="name"  placeholder="Search name">
    <button class="search">Search</button>
</form>
</div>

@endSection