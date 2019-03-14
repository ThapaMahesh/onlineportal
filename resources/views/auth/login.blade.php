@extends('app')

@section('content')

    

      <div class="container">

        {{ Form::open(['url'=>'auth/login', 'class'=>'form-signin']) }}
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  @if (isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger">
                      <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                      <!-- <ul> -->
                        @foreach ($errors->all() as $error)
                          <p>{{ $error }}</p>
                        @endforeach
                      <!-- </ul> -->
                    </div>
                  @endif
                  @if(session('message'))
                    <div class="alert alert-{{session('type')}}">
                        {{session('message')}}
                    </div>
                  @endif
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="username" value="{{ old('username') }}" class="form-text" required>
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" name="password" class="form-text" required>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <label class="pull-left">
                  <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Remember me
                  </label>
                  <input type="submit" class="btn col-md-12" value="SignIn"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <!-- <a href="#">Forgot Password </a> -->
                    <a href="{{ url('auth/register') }}">Don't have an account?</a>
                </div>
          </div>
        {{ Form::close() }}

      </div>

@stop