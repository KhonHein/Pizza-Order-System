@extends('admin.layout.master')
@section('title','contact')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p10">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            @if (Session('upAccountSuccess'))

            <div class="col-lg-8 offset-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-cloud-upload-alt"></i>{{ session('upAccountSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact to admin </h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#sendToAdmin') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-10 offset-1 d-flex ">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <div class="col  mx-1">
                                        <input type="text" class="form-control my-2 " name="name" id=""  placeholder="Name">
                                    </div>
                                    <div class="col  mx-1">
                                        <input type="email" class="form-control my-2 " name="email" id=""  placeholder="enter email address">
                                    </div>
                                </div>
                                <div class="col-md-8 offset-2 ">
                                    <textarea name="message"  class="form-control my-2" id=""  cols="30" rows="10" >Enter Message</textarea>
                                </div>

                                <div class="col-md-6 offset-3">
                                    <hr class="bg-dark my-2">
                                </div>

                                <a href="" class="text-center m-auto col-12" >
                                    <button type="submit" class="btn bg-dark text-white "><i class="fa fa-send text-center " aria-hidden="true"></i></button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

