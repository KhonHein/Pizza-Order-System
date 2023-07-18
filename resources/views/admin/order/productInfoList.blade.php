@extends('admin.layout.master')
@section('title','order_product_lists')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p10">
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
                                    <h5 class="text-center"><i class="fa-solid fa-house-tsunami mx-2 text-primary"></i>  <span class="text-danger">total->{{ count($orderList) }}</span></h5>
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
                <div class="card" style="width: 18rem;">
                    <p class="card-header text-dark text-center font-weight-bold">
                        order info
                    </p>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item "> <i class="fa fa-user mx-3" aria-hidden="true"></i><span class="text-primary">{{ $orderList[0]->user_name }}</span></li>
                      <li class="list-group-item "><i class="fa fa-clock-o mx-3" aria-hidden="true"></i><span class="text-primary">{{ $orderList[0]->created_at->format('d/m/y') }}</span></li>

                    </ul>
                  </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>user Id </th>
                                <th>user name</th>
                                <th>product Image</th>
                                <th>product name</th>
                                <th>Date</th>>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id='dataList'>
                            @foreach ($orderList as $o)
                                <tr>
                                    <td>{{ $o->user_id }}</td>
                                    <td>{{ $o->user_name }}</td>
                                    <td> <img src="{{ asset('storage/'.$o->product_image) }}" > </td>
                                    <td>{{ $o->product_name }}</td>
                                    <td>{{ $o->created_at->format('d/m/y') }}</td>
                                    <td>{{ $o->qty }}</td>
                                    <td>{{ $o->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <span>{{ $order->links() }}</span> --}}
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection

