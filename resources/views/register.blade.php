<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    {!! Form::open(['url' => route('register.post'), 'method' => 'POST', 'class' => 'form-signin']) !!}
      <div class="text-center mb-4">
        <i class="fa fa-cloud fa-5x mb-2 d-block text-primary"></i>
        <h1 class="h3 mb-1 font-weight-normal">Lite Cloud Storage</h1>
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
        {!! Form::plainInput('text', 'name', null, ['id' => 'inputName', 'placeholder' => 'Full Name', 'required' => true, 'class' => appendToStringWhen($errors->has('name'), 'form-control', ' is-invalid')]) !!}
        <label for="inputName">Full Name</label>
        @if($errors->has('name'))
          <div class="invalid-feedback">
            {{ $errors->first('name') }}
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

      <div class="form-label-group">
        {!! Form::plainInput('password', 'password_confirmation', null, ['id' => 'inputPasswordConfirmation', 'placeholder' => 'Password', 'required' => true, 'class' => appendToStringWhen($errors->has('password_confirmation'), 'form-control', ' is-invalid')]) !!}
        <label for="inputPasswordConfirmation">Password Confirmation</label>
        @if($errors->has('password_confirmation'))
          <div class="invalid-feedback">
            {{ $errors->first('password_confirmation') }}
          </div>
        @endif
      </div>

      <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Sign up</button>
      <a href="{{ route('login.show') }}" class="d-block mt-2 text-center">Already have an account? Click here to log in.</a>
      <p class="mt-5 mb-3 text-muted text-center">&copy; Lite Stock Technology Services 2018</p>
    {!! Form::close() !!}

</body>
</html>
