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
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Add your pizza </h3>
                        </div>
                        <hr>
                        <form action="{{ route('products#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName') }}" type="text" class="form-control @error('pizzaName') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                @error('pizzaName')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Categorie</label>
                                <select name="pizzaCategorie" >
                                    <option value="">choose categories</option>
                                    @foreach ($categories as $cat )
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach

                                </select>
                                @error('pizzaCategorie')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Description</label>
                                <textarea id="cc-pament" name="pizzaDescription" value="{{ old('pizzaDescription') }} type="text" class="form-control @error('pizzaDescription') is-invalid @enderror " aria-required="true" placeholder="Enter Description"></textarea>
                                @error('pizzaDescription')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Image</label>
                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror ">
                                @error('pizzaImage')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice') }} " type="number" class="form-control @error('pizzaPrice') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Price">
                                @error('pizzaPrice')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="control-label mb-1">Waiting time </label>
                                <input id="cc-pament" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime') }}" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Waiting time">
                                @error('pizzaWaitingTime')
                                    <div class="invalid_feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
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
