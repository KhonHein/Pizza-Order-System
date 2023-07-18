@extends('user.layout.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Accoutn Info </h3>
                        </div>
                        <hr>
                        <form action="{{ route('account#page',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                        <img  style="width: 350px; height:350px;" src="{{ asset('image/female_default.png') }}" />
                                        @else
                                        <img  style="width: 350px; height:350px;" src="{{ asset('image/defaultUser.png') }}" />
                                        @endif
                                    @else
                                     <img  style="width: 350px; height:350px;" src="{{ asset('storage/'.Auth::user()->image) }}" />
                                    @endif

                                    <div>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mx-auto">
                                        <hr class="bg-dark">
                                        <button type="submit" class="btn bg-dark text-white col-md-12">update <i class="fa-solid fa-forward text-primary"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-7">

                                    <div class=" col form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                        @error('name')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="col-md-12 form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input  name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                        @error('email')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="col form-group">
                                        <label  class="control-label mb-1">Address</label>
                                        <textarea  name="address" type="text" class="form-control  @error('address') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Address">
                                            {{ old('address',Auth::user()->address) }}
                                        </textarea>
                                        @error('address')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input  name="phone" type="number" value="{{ old('phone',Auth::user()->phone) }}" class="form-control  @error('phone') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                        @error('phone')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="null"><i class="fa fa-male" aria-hidden="true"></i>choose gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif > Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif > Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid_feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <input  name="role" type="text" value="{{ Auth::user()->role}}" class="form-control" aria-required="true" aria-invalid="false" disabled>

                                    </div>
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
