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
                            {{-- <h3 class="text-center title-2">Pizza Info </h3> --}}
                            <h4 class="mt-3"> <i class="fa-solid fa-user-pen mx-2"></i>{{ $pizzas->name }} </h4>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-5 ">
                                <i class="fa-solid fa-arrow-left text-decoration-none text-black" onclick="history.back()"></i>

                                <div class="image">
                                    <img src="{{ asset('storage/'.$pizzas->image) }}" />
                                </div>

                            </div>
                            <div class="col-md-7 ms-3 py-2 ">

                                <button class="mt-3 btn bg-dark text-white"><i class="fa-solid fa-envelope-open-text mx-2"></i>{{ $pizzas->id }}</button>
                                <button class="mt-3 btn bg-dark text-white"><i class="fa-solid fa-envelope-open-text mx-2"></i>{{ $pizzas->category_name }}</button>
                                <button class="mt-3 btn bg-dark text-white "><i class="fa-solid fa-money-bill-1-wave mx-2"></i>{{ $pizzas->price }}</button>
                                <button class="mt-3 btn bg-dark text-white "><i class="fa-regular fa-clock mx-2"></i>{{ $pizzas->waiting_time }}</button>
                                <button class="mt-3 btn bg-dark text-white "><i class="fa-regular fa-eye mx-2"></i>{{ $pizzas->view_count }}</button>
                                <button class="mt-3 btn bg-dark text-white "><i class="fa-solid fa-building-flag mx-2"></i>{{ $pizzas->created_at->format('d / M /Y') }}</button>

                            </div>
                            <div>
                                <h5><i class="fa-solid fa-circle-info my-4"></i> details</h5>
                                <span class="text-muted d-inline">{{ $pizzas->description }}</span>
                            </div>
                            <div class="mx-auto">
                                <hr class="bg-dark">
                                <a href="{{ route('products#updatePage',$pizzas->id) }}">
                                    <button class="btn bg-dark text-white ">Edit Pizza </button>
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
