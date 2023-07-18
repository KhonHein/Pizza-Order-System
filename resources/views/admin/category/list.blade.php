@extends('admin.layout.master')
@section('title','category_list')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>
                        </div>
                                <h5 class="text-primary mt-3">Search Key-> <span class="text-danger">{{request('key') }}</span></h5>
                                <div class="bg-white mt-3 shadow-sm py-1 px-3 text-black ">
                                    <h5 class="text-center"><i class="fa-solid fa-house-tsunami mx-2 text-primary"></i>  <span class="text-danger">{{$categories->total() }}</span></h5>
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
                                    <form action="{{ route('category#list') }}" method="GET">
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
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    @if (count($categories) !=0)

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category )
                            <tr class="tr-shadow">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at->format('j/F/Y') }}</td>
                                <td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="See">
                                            <i class="fa-regular fa-eye"></i>
                                        </button> --}}
                                        <a href="{{ route('category#edit',$category->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('category#delete',$category->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h3 class="text-black text-center mt-4">there is no category here  </h3>
                    @endif
                    <div class="mt-3">{{ $categories->links() }}</div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection
