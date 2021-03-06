@extends('app')

@section('content')

      <div class="container">

        {{ Form::open(['url'=>'auth/register', 'class'=>'form-signin']) }}
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  @if (session('message'))
                    <div class="alert alert-{{session('type')}}">
                      <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                      <!-- <ul> -->
                          <p>{{ session('message') }}</p>
                      <!-- </ul> -->
                    </div>
                  @endif
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="name" value="{{old('name')}}" class="form-text" required>
                    <span class="bar"></span>
                    <label>Name</label>
                    @if($errors->has('name'))
                    <p class="alert alert-danger">{{$errors->first('name')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" name="email" value="{{old('email')}}" class="form-text" required>
                    <span class="bar"></span>
                    <label>Email</label>
                    @if($errors->has('email'))
                    <p class="alert alert-danger">{{$errors->first('email')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="username" value="{{old('username')}}" class="form-text" required>
                    <span class="bar"></span>
                    <label>Username</label>
                    @if($errors->has('username'))
                    <p class="alert alert-danger">{{$errors->first('username')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" name="password" class="form-text" required>
                    <span class="bar"></span>
                    <label>Password</label>
                    @if($errors->has('password'))
                    <p class="alert alert-danger">{{$errors->first('password')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" name="confirm_password" class="form-text" required>
                    <span class="bar"></span>
                    <label>Confim Password</label>
                    @if($errors->has('confirm_password'))
                    <p class="alert alert-danger">{{$errors->first('confirm_password')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <p style="font-size:18px; float:left;">Faculty</p>
                    <select name="faculty" class="form-control" required>
                      <option value="0">Choose Faculty</option>
                      @foreach($faculty as $eachfaculty)
                      <option value="{{$eachfaculty->id}}">{{$eachfaculty->name}}</option>
                      @endforeach
                    </select>
                    <p>*(Select only if Student)</p>
                    @if($errors->has('faculty'))
                    <p class="alert alert-danger">{{$errors->first('faculty')}}</p>
                    @endif
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="your_key" class="form-text" required>
                    <span class="bar"></span>
                    <label>Your Key</label>
                    @if($errors->has('your_key'))
                    <p class="alert alert-danger">{{$errors->first('your_key')}}</p>
                    @endif
                  </div>
                  
                  <input type="submit" class="btn col-md-12" value="SignUp"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="{{ url('auth/login') }}">Already have an account?</a>
                </div>
          </div>
        {{ Form::close() }}

      </div>
@stop