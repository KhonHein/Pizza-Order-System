@extends('admin.layout.master')
@section('title','category_list')
@section('content')

<div class="main-content">
    <i class="fa-solid fa-arrow-left mx-2 text-black fw-bold"  onclick=" history.back()"></i>
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
                            <h3 class="text-center title-2">Change Role  </h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#change',$admin->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    @if ($admin->image == null)
                                        @if ($admin->gender == 'female')
                                        <img  style="width: 700px; height:80px;" src="{{ asset('image/female_default.png') }}" />
                                        @else
                                        <img  style="width: 700px; height:80px;" src="{{ asset('image/defaultUser.png') }}" />
                                        @endif
                                    @else
                                     <img  style="width: 700px; height:80px;" src="{{ asset('storage/'.$admin->image) }}" />
                                    @endif

                                    <hr class="bg-dark">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="admin" @if ($admin->role == 'admin') selected  @endif>Admin</option>
                                            <option value="user" @if ($admin->role == 'user') selected  @endif>User</option>
                                        </select>

                                    </div>
                                    <div class="mx-auto">
                                        <hr class="bg-dark">
                                        <button class="btn bg-dark text-white col-md-12">Change <i class="fa-solid fa-forward text-primary"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-7">

                                    <div class=" col form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input  disabled name="name" type="text" value="{{ old('name',$admin->name) }}" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                        @error('name')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="col-md-12 form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input  disabled name="email" type="email" value="{{ old('email',$admin->email) }}" class="form-control @error('email') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                        @error('email')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="col form-group">
                                        <label  class="control-label mb-1">Address</label>
                                        <textarea  disabled name="address" type="text" class="form-control  @error('address') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Address">
                                            {{ old('address',$admin->address) }}
                                        </textarea>
                                        @error('address')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input  disabled name="phone" type="number" value="{{ old('phone',$admin->phone) }}" class="form-control  @error('phone') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                        @error('phone')
                                            <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <hr class="bg-dark"></hr>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select disabled name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="male" @if ($admin->gender == 'male') selected @endif > Male</option>
                                            <option value="female" @if ($admin->gender == 'female') selected @endif > Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid_feedback text-danger">{{ $message }}</div>
                                        @enderror
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
