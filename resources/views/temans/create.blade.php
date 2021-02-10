@extends('layouts.global')

@section("title") Friends create @endsection

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
    action="{{route('temans.store')}}"
    method="POST">

    @csrf

    <div class="form-group">
      <label for="name">Name</label>
      <input
      value="{{old('name')}}"
      class="form-control {{$errors->first('name') ? "is-invalid": ""}}"
      placeholder="Friends Name"
      type="text"
      name="name"
      id="name"/>
      <div class="invalid-feedback">
        {{$errors->first('name')}}
      </div>
    </div>

    <div class="form-group">
      <label for="umur">Umur</label>
      <input
      value="{{old('umur')}}"
      class="form-control {{$errors->first('umur') ? "is-invalid": ""}}"
      placeholder="Friends old"
      type="text"
      name="umur"
      id="umur"/>
      <div class="invalid-feedback">
        {{$errors->first('umur')}}
      </div>
    </div>

    <div class="form-group">
      <label for="username">Username</label>
      <input
      value="{{old('username')}}"
      class="form-control {{$errors->first('username') ? "is-invalid": ""}}"
      placeholder="Friends Username"
      type="text"
      name="username"
      id="username"/>
      <div class="invalid-feedback">
        {{$errors->first('username')}}
      </div>
    </div>

    <div class="form-group">
      <label for="picture">Picture</label>
      <div class="custom-file">
        <input name="picture" type="file" class="custom-file-input {{$errors->first('picture') ? "is-invalid" : ""}}" id="picture">
        <label class="custom-file-label" for="picture">Choose Friends</label>
        <div class="invalid-feedback">
          {{$errors->first('picture')}}
        </div>
      </div>
    </div>

    <!-- <div class="form-group">
      <label for="category">Category</label>
      <select name="category" class="form-control {{$errors->first('category') ? "is-invalid": ""}}">
        <option value="Futsal">Futsal</option>
        <option value="Volly" disabled>Volly (Coming Soon)</option>
        <option value="Badminton" disabled>Badminton (Coming Soon)</option>
      </select>
    </div> -->

    <div class="form-group">
      <label for="address">Address</label>
      <textarea
      name="address"
      id="address"
      class="form-control {{$errors->first('address') ? "is-invalid" : ""}}">{{old('address')}}</textarea>
      <div class="invalid-feedback">
        {{$errors->first('address')}}
      </div>
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <input
      value="{{old('location')}}"
      class="form-control {{$errors->first('location') ? "is-invalid": ""}}"
      placeholder="Friends Location"
      type="text"
      name="location"/>
      <div class="invalid-feedback">
        {{$errors->first('location')}}
      </div>
    </div>

    <div class="form-group">
      <label>Open</label>
      <input name="open" type="text" class="form-control {{$errors->first('open') ? "is-invalid": ""}}" placeholder="e.g 08:00" value="{{old('open')}}">
      <div class="invalid-feedback">
        {{$errors->first('open')}}
      </div>
    </div>

    <div class="form-group">
      <label>Close</label>
      <input name="close" type="text" class="form-control {{$errors->first('close') ? "is-invalid": ""}}" placeholder="e.g 16:00" value="{{old('close')}}">
      <div class="invalid-feedback">
        {{$errors->first('close')}}
      </div>
    </div>

    <div class="form-group">
      <label for="Price">Price</label> <br>
      <input value="{{old('price')}}" type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price" placeholder="Book price">
      <div class="invalid-feedback">
        {{$errors->first('price')}}
      </div>
    </div>

    <div class="form-group">
      <label for="Price">Email</label> <br>
      <input value="{{old('email')}}" type="text" class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" name="email" id="email" placeholder="Email owner">
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
