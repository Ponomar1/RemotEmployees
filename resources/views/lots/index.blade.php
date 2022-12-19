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
    <form action="{{ route('lots.create') }}">
        <button class="create">Create a new lot</button>
    </form>
    <table>
        <caption><b>All Lots</b></caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Categories</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Del</th>
        </tr>
        @foreach($lots as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td><a href="{{route('lots.show',$item->id)}}" >{{$item->name}}</a></td>
            <td>{{$item->category_name}}</td>
            <td>{{$item->description}}</td>
            <td><a href="{{URL::to('lots/'.$item->id.'/edit')}}">Edit</a></td>
            <td>
                <form action="{{ route('lots.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="del">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="filter">
        <form  action="{{ route('lots.index') }}">
            <input type="text" name="name"  placeholder="Search lot name">
            <button class="search">Search</button>
        </form>
        <form  action="{{ route('lots.index') }}">
            <input type="text" name="categoryName"  placeholder="Search category name">
            <button class="search">Search</button>
        </form>
    </div>
    
</div>
@endSection
