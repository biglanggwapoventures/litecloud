@extends('registration.layout')

@section('content')

{!! Form::open(['url' => route('login.post'), 'method' => 'POST', 'class' => 'form-signin']) !!}
  <div class="text-center mb-4">
    <div class="row">
      <div class="col-6 offset-sm-3">
        <img src="{{ asset('images/litecloud-white.png') }}" class="img-fluid mb-2" alt="">
      </div>
    </div>
    <h1 class="h3 mb-1 font-weight-normal">Cloud Storage</h1>
    <p>Bring your files together in one central place.</p>
  </div>

  <div class="form-label-group">
    {!! Form::plainInput('email', 'email', null, ['id' => 'inputEmail', 'placeholder' => 'Email address', 'required' => true, 'autofocus' => true, 'class' => appendToStringWhen($errors->has('email'), 'form-control', ' is-invalid')]) !!}
    <label for="inputEmail">Email address</label>
    @if($errors->has('email'))
      <div class="invalid-feedback">
        {{ $errors->first('email') }}
      </div>
    @endif
  </div>

  <div class="form-label-group">
    {!! Form::plainInput('password', 'password', null, ['id' => 'inputPassword', 'placeholder' => 'Password', 'required' => true, 'class' => appendToStringWhen($errors->has('password'), 'form-control', ' is-invalid')]) !!}
    <label for="inputPassword">Password</label>
    @if($errors->has('password'))
      <div class="invalid-feedback">
        {{ $errors->first('password') }}
      </div>
    @endif
  </div>

  <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Sign in</button>
  <p class="mt-3">
    Create a <a href="{{ route('register.personal.show') }}">personal</a> or a <a href="{{ route('register.corporate.show') }}">corporate</a> account for free!
  </p>
{!! Form::close() !!}


@endsection
