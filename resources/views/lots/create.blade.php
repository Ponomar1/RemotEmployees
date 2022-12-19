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
.formCreate,
.formedit {
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
<div class="content_item" >
    <h3>Add lot</h3>
    <form class="formCreate" method="POST" action="{{route('lots.store')}}" enctype="multipart/form-data">
        @csrf
        <label for="name" >Name</label>
        <div class="text">
            <input type="text" name="name" id="name" required min="1" max="255" value="{{old('name')}}">
            @if($errors->has('name'))
                <div class="validationError">{{$errors->first('name')}}</div>
            @endif
        </div>

        <label for="categoryid">Category</label>
        <div class="text">
            <select name="categoryid" id="categoryid" required>
                @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @if($errors->has('categoryid'))
                <div class="validationError">{{$errors->first('categoryid')}}</div>
            @endif
        </div>

        <label for="description">Description</label>
        <div class="text">
            <textarea name="description" id="description" min="1" max="5000" rows="10" required>{{old('description')}}</textarea>
            @if($errors->has('description'))
                <div class="validationError">{{$errors->first('description')}}</div>
            @endif
        </div>
        </br>
        <button type="submit" class="createAdd">Add</button>
    </form>
</div>
@endSection