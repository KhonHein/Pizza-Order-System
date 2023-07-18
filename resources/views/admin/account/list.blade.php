@extends('admin.layout.master')
@section('title','admin_list')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p5">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>
                        </div>
                                <h5 class="text-primary mt-3">Search Key-> <span class="text-danger">{{request('key') }}</span></h5>
                                <i class="fa fa-arrow-left text-danger mt-2" aria-hidden="true" onclick="history.back()"></i>
                                <div class="bg-white mt-3 shadow-sm py-1 px-3 text-black ">
                                    <h5 class="text-center"><i class="fa-solid fa-house-tsunami mx-2 text-primary"></i>  <span class="text-danger">total-> {{ count($admins) }}</span></h5>
                                </div>
                    </div>
                    <div class="table-data__tool-right">
                        <div>
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                            <div class="d-flex">
                                    <form action="{{ route('admin#list') }}" method="GET">
                                        <div class="row">
                                            <div class="mt-2 col-md-9 ">
                                                <input type="text" name="key" value="{{ request('key') }}" placeholder="Search..." class="form-control">
                                            </div>

                                            <div class="mt-2 ">
                                                <button type="submit" class=" py-1  fw-bold m-auto">
                                                    <h3><i class="fa-solid fa-magnifying-glass fs-5 text-primary"></i></h3>
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                            </div>
                            @if (Session('categorySuccess'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>{{ session('categorySuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session('adminDelete'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-delete-left"></i>{{ session('adminDelete') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session('editSuccess'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>{{ session('editSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session('changeRole'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>{{ session('changeRole') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($admins) !=0)
                                @foreach ($admins as $ad )
                                <table class="table table-data2">
                                    <tbody>
                                        <tr class="tr-shadow row">

                                            <td class=" col-md-2">

                                                <div class="col-md-12">
                                                    @if ($ad->image == null)
                                                        @if ($ad->gender == 'female')

                                                            <img  style="width: 700px; height:80px;" src="{{ asset('image/female_default.png') }}" />

                                                        @else

                                                            <img  style="width: 700px; height:80px;" src="{{ asset('image/defaultUser.png') }}" />

                                                        @endif
                                                    @else

                                                        <img  style="width: 700px; height:80px;" src="{{ asset('storage/'.$ad->image) }}" />

                                                    @endif
                                                </div>

                                            </td>
                                                <input type="hidden" class="userId" value="{{ $ad->id }}">
                                                <td class="col">{{ $ad->name }}</td>
                                                <td class="col">{{ $ad->email }}</td>
                                                <td class="col">{{ $ad->gender }}</td>
                                                <td class="col">{{ $ad->phone }}</td>
                                                <td class="col">{{ $ad->address }}</td>
                                                <td>
                                                   @if ($ad->id == Auth::user()->id)

                                                   @else

                                                   <select name="" class="statusRole" id="">
                                                    <option value="user" @if ($ad->role == 'user') selected @endif>User</option>
                                                    <option value="admin" @if ($ad->role == 'admin') selected @endif>Admin</option>
                                                    </select>

                                                   @endif
                                                </td>
                                                <td class="col">
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin#delete',$ad->id) }}">
                                                            @if (Auth::user()->id == $ad->id)

                                                            @else
                                                            <button class="btn btn-outline-warning "><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </td>
                                        </tr>
                                        <hr class="bg-dark">
                                    </tbody>
                                </table>
                                @endforeach

                            @else
                                <h3 class="text-black text-center mt-4">there is no admin here  </h3>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-3">{{ $admins->links() }}</div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
         //change status button
         $('.statusRole').change(function(){
             $currentRole = $(this).val();//$currentStatus = $('.currentRole').val();
             $parentNode = $(this).parents('tr');
             $userId = $parentNode.find('.userId').val();

            $data={
                'role' : $currentRole,
                'userId' : $userId
            };
            //console.log($data);

            $.ajax({
                type: 'get',
                url : 'http://127.0.0.1:8000/admin/changeRole',
                data: $data,
                dataType:'json',
            })
             location.reload();
         })
    })
</script>
@endsection
