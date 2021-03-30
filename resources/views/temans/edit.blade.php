@extends('layouts.global')

@section("title") Edit temans @endsection

@section('content')
<div class="col-md-8">

  @if(session('status'))
  <div class="alert alert-success">
    {{session('status')}}
  </div>
  @endif

  <form
    enctype="multipart/form-data"
    class="bg-white shadow-sm p-3"
    action="{{route('temans.update', [$temans->id])}}"
    method="POST">

    @csrf
    <input type="hidden" value="PUT" name="_method">

    <div class="form-group">
      <label for="name">Name</label>
      <input
      value="{{old('name') ? old('name') : $temans->name}}"
      class="form-control {{$errors->first('name') ? "is-invalid": ""}}"
      placeholder="Friends Name"
      type="text"
      name="name"
      id="name"/>
      <div class="invalid-feedback">
        {{$errors->first('name')}}
      </div>
      <br>
    </div>

    <div class="form-group">
      <label for="picture">temans picture</label>
      <br>
      Current picture: <br>
      @if($temans->picture)
        <img
          src="{{asset('storage/'.$temans->picture)}}"
          width="120px" />
        <br>
      @else
        No picture
      @endif
      <br>
      <div class="custom-file">
        <input id="picture" name="picture" type="file" class="custom-file-input">
        <label class="custom-file-label" for="picture">Choose file</label>
      </div>
      <small class="text-muted">Kosongkan jika tidak ingin mengubah picture</small>
    </div>

    <!-- <div class="form-group">
      <label for="category">Category</label>
      <select name="category" class="form-control" value="test">
        <option {{$temans->category == "Futsal" ? "selected" : ""}} value="Futsal">Futsal</option>
        <option {{$temans->category == "Volly" ? "selected" : ""}} value="Volly" disabled>Volly (Coming Soon)</option>
        <option v{{$temans->category == "Badminton" ? "selected" : ""}} alue="Badminton" disabled>Badminton (Coming Soon)</option>
      </select>
    </div> -->

    <div class="form-group">
      <label for="address">Address</label>
      <textarea
        name="address"
        id="address"
        class="form-control {{$errors->first('address') ? "is-invalid" : ""}}">{{old('address') ? old('address') : $temans->address}}
      </textarea>
      <div class="invalid-feedback">
        {{$errors->first('address')}}
      </div>
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <input
      value="{{old('location') ? old('location') : $temans->location}}"
      class="form-control {{$errors->first('location') ? "is-invalid": ""}}"
      placeholder="temans Location"
      type="text"
      name="location"/>
      <div class="invalid-feedback">
        {{$errors->first('location')}}
      </div>
    </div>

    <div class="form-group">
      <label>Open</label>
      <input value="{{old('open') ? old('open') : $temans->open}}" name="open" type="text" class="form-control {{$errors->first('open') ? "is-invalid": ""}}">
      <div class="invalid-feedback">
        {{$errors->first('open')}}
      </div>
    </div>

    <div class="form-group">
      <label>Close</label>
      <input value="{{old('close') ? old('close') : $temans->close}}" name="close" type="text" class="form-control {{$errors->first('close') ? "is-invalid": ""}}">
      <div class="invalid-feedback">
        {{$errors->first('close')}}
      </div>
    </div>

    <div class="form-group">
      <label for="price">Price</label> <br>
      <input value="{{old('price') ? old('price') : $temans->price}}" type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="Price">
      <div class="invalid-feedback">
        {{$errors->first('price')}}
      </div>
    </div>

    <div class="form-group">
      <label for="Price">Email</label> <br>
      <input value="{{old('email') ? old('email') : $temans->email}}" type="text" class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" name="email" id="email" placeholder="Email owner">
      <div class="invalid-feedback">
        {{$errors->first('email')}}
      </div>
    </div>

    <div class="text-right">
      <input
      class="btn btn-primary"
      type="submit"
      value="Save"/>
    </div>
  </form>
</div>
@endsection
