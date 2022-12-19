@extends('layouts/layout')
@section('style')
<style>

.contentEdit {
    width: 40%;
    margin: 20px auto;
    text-align: center;
    display: flex;
}
h3{
    font-size: 1.6em;
}

.edit,
.prodImage {
    text-align:center;
    margin-top: 20px;
}

.prodImage {
    margin: 20px;
}

.prodImage img {
    width: 300px;
}
.formEdit {
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.formEdit input,
.formEdit select,
.formEdit textarea {
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
.formEdit input,
.formEdit select,
.formEdit textarea,
.validationerror {
    margin: 10px;
    border-radius: 5px;
    outline: none;
    padding-left: 5px;
}
p{
    font-size: 0.7em;
}

.validationError {
    text-align: left;

}

.editAdd {
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
<div class="contentEdit">
    <div class="prodImage">
        <img src="{{Storage::url($category->imagepath)}}" alt="">
    </div>
    <div class="edit">
        <h3>Edit category</h3>

        <form class="formEdit" method="POST" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <label for="name">Name</label>
            <div class="text">
                <input type="text" name="name" id="name" required min="1" max="100" value="{{$category->name}}">
                @if($errors->has('name'))
                    <div class="validation_error">{{$errors->first('name')}}</div>
                @endif
            </div>
            </br>
            <button type="submit" class="editAdd">Edit</button>
        </form>
    </div>
 </div>
@endSection