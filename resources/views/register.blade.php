@extends('admin.master')
@section('title','Login')
@section('content')
<div class="login-form">
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="name">
        </div>
        @error('username')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>
        @error('email')
             <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>phone</label>
            <input class="au-input au-input--full" type="number" name="phone" placeholder="09+xxxx">
        </div>
        @error('phone')
        <small class="text-danger">{{ $message }}</small>
         @enderror
         <div class="form-group">
            <label>Gender</label>
           <select name="gender" class="form-control">
            <option value="null"><i class="fa fa-male" aria-hidden="true"></i>choose gender</option>
            <option value="male"> Male</option>
            <option value="female">Female</option>
           </select>
        </div>
        @error('gender')
        <small class="text-danger">{{ $message }}</small>
         @enderror


        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Enter Address">
        </div>
        @error('address')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>
        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('admin#loginPage') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection
