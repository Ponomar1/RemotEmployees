@extends('layouts/layout')
@section('style')
<style>

.contentEdit {
    width: 50%;
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
    <div class="edit">
        <h3>Edit lot</h3>

        <form class="formEdit" method="POST" action="{{route('lots.update', $lot->id)}}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf
            <label for="name">Name</label>
            <div class="text">
                <input type="text" name="name" id="name" required min="1" max="100" value="{{$lot->name}}">
                @if($errors->has('name'))
                    <div class="validatioError">{{$errors->first('name')}}</div>
                @endif
            </div>

            <label for="categoryid">Category</label>
            <div class="text">
                <select name="categoryid" id="categoryid" required>
                    @foreach($categories as $item)
                        @if($lot->categoryid == $item->id)
                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('categoryid'))
                    <div class="validationError">{{$errors->first('categoryid')}}</div>
                @endif
            </div>

            <label for="description">Description</label>
            <div class="text">
                <textarea name="description" id="description" min="1" max="5000" rows="10" required>{{$lot->description}}</textarea>
                @if($errors->has('description'))
                    <div class="validationError">{{$errors->first('description')}}</div>
                @endif
            </div>
            </br>
            <button type="submit" class="editAdd">Edit</button>
        </form>
    </div>
</div>
@endSection