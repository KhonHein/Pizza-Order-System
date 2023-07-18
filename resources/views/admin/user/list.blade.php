@extends('admin.layout.master')
@section('title','user_list')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p2">
        <div class="container-fluid">
            <i class="fa-solid fa-arrow-left text-decoration-none text-black" onclick="history.back()"></i>
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">

                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Pizza List</h2>
                        </div>
                                <h5 class="text-primary mt-3">Search Key-> <span class="text-danger">{{request('key') }}</span></h5>
                                <div class="bg-white mt-3 shadow-sm py-1 px-3 text-black ">
                                    <h5 class="text-center"><i class="fa-solid fa-house-tsunami mx-2 text-primary"></i>  <span class="text-danger">total->{{ count($users) }}</span></h5>
                                </div>
                    </div>
                    <div class="table-data__tool-right">
                        <div>
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                            <div class="d-flex">
                                    <form action="{{ route('products#list') }}" method="GET">
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
                            @if (Session('deleteSuccess'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-delete-left"></i>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session('editSuccess'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>{{ session('editSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (Session('updateSuccess'))

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>{{ session('updateSuccess') }}</strong>
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
                                <th>Image </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id='dataList'>
                           @foreach ($users as $user)
                           <tr>
                            <td>
                                @if ($user->image == null)
                                @if ($user->gender == 'female')
                                <img  style="width: 100px; height:70px;" src="{{ asset('image/female_default.png') }}" />
                                @else
                                <img  style="width: 100px; height:70px;" src="{{ asset('image/defaultUser.png') }}" />
                                @endif
                            @else
                            <img  style="width: 100px; height:70px;" src="{{ asset('storage/'.$user->image) }}" />
                            @endif
                            </td>
                            <input type="hidden" class="userId" value="{{ $user->id }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->phone }}</td>>
                            <td>{{ $user->address }}</td>
                            <td>
                                <select name="" class="statusRole" id="">
                                    <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                    <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                </select>
                            </td>
                            <td><button class="btnDelete"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></td>
                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <span>{{ $users->links() }}</span>
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
                url : 'http://127.0.0.1:8000/admin/user/change/role',
                data: $data,
                dataType:'json',
            })
            location.reload();
         })

         $('.btnDelete').click(function(){
                confirm('Are you sure you wanna delete this Account');
            //$userId = $('.userId').val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('.userId').val();

            $data = {'userId' : $userId};
            //console.log($data);
            $.ajax({
                type: 'get',
                url : 'http://127.0.0.1:8000/admin/deleteUser',
                data: $data,
                dataType:'json',
            })
            location.reload();
         })
    })
</script>
@endsection

