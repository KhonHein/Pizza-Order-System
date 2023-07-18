@extends('user.layout.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-3 offset-8">
                    <a href="{{ route('user#home') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div> --}}
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password </h3>
                        </div>
                        <hr>
                        <form action="{{ route('change#password') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Old Password</label>
                                <input  name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                @error('oldPassword')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                                @if (session('notMatch'))
                                <div class="invalid_feedback text-danger">{{ session('notMatch') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">New Password</label>
                                <input  name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                @error('newPassword')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Conform Password</label>
                                <input  name="conformPassword" type="password" class="form-control @error('conformPassword') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Conform Password">
                                @error('conformPassword')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
