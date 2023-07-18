@extends('admin.layout.master')
@section('title','category_list')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3"><button class="btn bg-dark text-white my-3"><i class="fa fa-home" aria-hidden="true"></i></button></a>
                </div>
            </div>
            @if (Session('upAccountSuccess'))

            <div class="col-lg-8 offset-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-cloud-upload-alt"></i>{{ session('upAccountSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Accoutn Info </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-5 ">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'female')
                                    <img  style="width: 350px; height:250px;" src="{{ asset('image/female_default.png') }}" />
                                    @else
                                    <img  style="width: 350px; height:250px;" src="{{ asset('image/defaultUser.png') }}" />
                                    @endif
                                @else
                                <img  style="width: 350px; height:250px;" src="{{ asset('storage/'.Auth::user()->image) }}" />
                                @endif
                            </div>
                            <div class="col-md-7 ms-3 py-2">
                                <h4 class="mt-3"><i class="fa-solid fa-user-pen mx-2"></i>{{ Auth::user()->name }}</h4>
                                <h5 class="mt-3"><i class="fa-solid fa-envelope-open-text mx-2"></i>{{ Auth::user()->email }}</h5>
                                <h5 class="mt-3"><i class="fa-regular fa-address-book mx-2"></i>{{ Auth::user()->address }}</h5>
                                <h5 class="mt-3"><i class="fa-solid fa-mobile-screen-button mx-2"></i>{{ Auth::user()->phone }}</h5>
                                <h5 class="mt-3"><i class="fa-solid fa-transgender mx-2"></i>{{ Auth::user()->gender }}</h5>
                                <h5 class="mt-3"><i class="fa-solid fa-building-flag mx-2"></i>{{ Auth::user()->created_at->format('d / M /Y') }}</h5>

                            </div>

                            <div class="mx-auto">
                                <hr class="bg-dark">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn bg-dark text-white ">Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
