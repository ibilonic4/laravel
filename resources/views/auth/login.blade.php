@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
{{-- za forget pass i remember--}}
        <div class="form-group row">
            <div class="form-group mb-1">
                <div class="checkbox">
                    <label>
                        <a href="{{ route('forget.password.get') }}">Reset Password</a>
                    </label>
                </div>
            </div>
            <div class="form-group mb-1">
                <label for="remember">Remember me</label>
                <input type="checkbox" name="remember" value="1">
          </div>
        </div>
        

        @include('auth.partials.copy')
    </form>
@endsection