@extends('layouts/layout')
@section('style')
<style>
.content_item {
    width: 60%;
    margin: 20px auto;
    text-align: center;
} 
h3{
    font-size: 1.6em;
}
.formCreate{
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.formCreate input,
.formCreate select,
.formCreate textarea {
    margin: 10px;
    width: 300px;
    font-size: 1.2em;
}
input[type=file]{
    width:500px
}


label {
    text-align: right;
    font-size: 1.5em;
}
.text{
    text-align: left;
}
label,
.formCreate input,
.formCreate select,
.formCreate textarea,
.validationerror {
    margin: 10px;
    border-radius: 5px;
    outline: none;
    padding-left: 5px;
}

.validationError {
    text-align: left;
}

.createAdd {
    margin: 10px;
    color: #fff;
    background-color: rgb(6, 41, 78);
     color: #fff;
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
    width: 100px;
}
</style>
@endSection

@section('content')
<div class="content_item">
<h3>Add category</h3>

<form class="formCreate" method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
    @csrf
    <label for="name">Name</label>
    <div class="text">
    <input type="text" name="name" id="name" required min="1" max="255" value="{{old('name')}}">
    @if($errors->has('name'))
        <div class="validation_error">{{$errors->first('name')}}</div>
    @endif

    </br>
    <button type="submit" class="createAdd">Add</button>
</form>
</div>
@endSection