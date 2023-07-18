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
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Pizza </h3>
                        </div>
                        <i class="fa-solid fa-arrow-left text-decoration-none text-black" onclick="history.back()"></i>
                        <hr>
                        <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">

                                    <div class="image">
                                        <img src="{{ asset('storage/'.$pizza->image) }}"  />
                                    </div>


                                    <div>
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mx-auto">
                                        <hr class="bg-dark">
                                        <button type="submit" class="btn bg-dark text-white col-md-12">update <i class="fa-solid fa-forward text-primary"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                    <div class=" col form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  name="pizzaName" type="text" value="{{ old('name',$pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter pizza Name">
                                        @error('pizzaName')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="col-md-12 form-group">
                                        <label  class="control-label mb-1">Price</label>
                                        <input  name="pizzaPrice" type="number" value="{{ old('pizzaPrice',$pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter pizza price">
                                        @error('pizzaPrice')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Category</label>
                                        <select name="pizzaCategorie" class="form-control @error('pizzaCategorie') is-invalid @enderror">
                                            <option value="null"><i class="fa fa-male" aria-hidden="true"></i>choose pizza category</option>
                                            @foreach ($categorie as $cat )
                                                <option value="{{ $cat->id }}" @if ($pizza->category_id == $cat->id) selected @endif >{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategorie')
                                        <div class="invalid_feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>

                                    <hr class="bg-dark"></hr>
                                    <div class="col form-group">
                                        <label  class="control-label mb-1">Description</label>
                                        <textarea  name="pizzaDescription" type="text" class="form-control  @error('pizzaDescription') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter description">
                                            {{ old('pizzaDescription',$pizza->description) }}
                                        </textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Waiting Time</label>
                                        <input  name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" class="form-control  @error('pizzaWaitingTime') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter waiting time">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">View Count</label>
                                        <input  name="pizzaViewCount" type="number" value="{{ old('pizzaViewCount',$pizza->view_count) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                    </div>
                                    <hr class="bg-dark"></hr>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
