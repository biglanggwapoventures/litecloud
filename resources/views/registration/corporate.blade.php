@extends('registration.layout')

@section('content')
{!! Form::open(['url' => route('register.corporate.post'), 'method' => 'POST', 'class' => 'form-signin']) !!}
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
    {!! Form::plainInput('text', 'name', null, ['id' => 'inputName', 'placeholder' => 'Company Name', 'class' => appendToStringWhen($errors->has('name'), 'form-control', ' is-invalid')]) !!}
    <label for="inputName">Company Name</label>
    @if($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

  <div class="form-label-group">
    {!! Form::plainInput('email', 'email', null, ['id' => 'inputEmail', 'placeholder' => 'Company email address', 'autofocus' => true, 'class' => appendToStringWhen($errors->has('email'), 'form-control', ' is-invalid')]) !!}
    <label for="inputEmail">Company Email</label>
    @if($errors->has('email'))
      <div class="invalid-feedback">
        {{ $errors->first('email') }}
      </div>
    @endif
  </div>

  <div class="form-label-group">
    {!! Form::plainInput('password', 'password', null, ['id' => 'inputPassword', 'placeholder' => 'Password', 'class' => appendToStringWhen($errors->has('password'), 'form-control', ' is-invalid')]) !!}
    <label for="inputPassword">Password</label>
    @if($errors->has('password'))
      <div class="invalid-feedback">
        {{ $errors->first('password') }}
      </div>
    @endif
  </div>

  <div class="form-label-group">
    {!! Form::plainInput('password', 'password_confirmation', null, ['id' => 'inputPasswordConfirmation', 'placeholder' => 'Password', 'class' => appendToStringWhen($errors->has('password_confirmation'), 'form-control', ' is-invalid')]) !!}
    <label for="inputPasswordConfirmation">Password Confirmation</label>
    @if($errors->has('password_confirmation'))
      <div class="invalid-feedback">
        {{ $errors->first('password_confirmation') }}
      </div>
    @endif
  </div>

  <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Sign up</button>
  <a href="{{ route('login.show') }}" class="d-block mt-2">Already have an account? Click here to log in.</a>
{!! Form::close() !!}


@endsection
