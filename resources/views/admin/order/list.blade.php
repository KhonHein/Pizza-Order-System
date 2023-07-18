@extends('admin.layout.master')
@section('title','order_lists')
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
                                    <h5 class="text-center"><i class="fa-solid fa-house-tsunami mx-2 text-primary"></i>  <span class="text-danger">total->{{ count($order) }}</span></h5>
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
                    <form action="{{ route('admin#orderStatus') }}" method="get">
                        @csrf
                        <div>
                            <label for="orderStatus">Status </label>
                            <select name="orderStatus" id="orderStatus">
                                <option class="text-black" value="">All</option>
                                <option class="text-black bg-primary" value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option class="text-black bg-success" value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                <option class="text-black bg-danger" value="2" @if (request('orderStatus') == '2') selected  @endif>Reject</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Button</button>
                        </div>
                    </form>

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>user Id </th>
                                <th>user name</th>
                                <th>order code</th>
                                <th>Amount</th>
                                <th>status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id='dataList'>
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <input type="hidden" class="orderId" value="{{ $o->id }}">
                                <td class="userId">{{ $o->user_id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td class="orderCode"><a href="{{ route('order#info',$o->order_code) }}">{{ $o->order_code }}</a></td>
                                <td class="amount">{{ $o->total_price }} mmk</td>
                                <td>
                                    <select name="" id="" class="statusChange">
                                        <option class="text-primary"  value="0" @if ($o->status == '0') selected @endif>pending</option>
                                        <option class="text-success"  value="1" @if ($o->status == '1') selected @endif>success</option>
                                        <option class="text-danger"  value="2" @if ($o->status == '2') selected @endif>reject</option>
                                    </select>
                                </td>
                                <td>{{ $o->created_at->format('d/m/y') }}</td>
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
@section('scriptSource')
    <script>
        $(document).ready(function(){

             $('.statusChange').change(function(){
                 $currentStatus = $(this).val();//$currentStatus = $('.statusChange').val();
                 $parentNode = $(this).parents('tr');
                 $orderCode = $parentNode.find('.orderCode').html();

                $data={
                    'status' : $currentStatus,
                    'orderCode' : $orderCode
                };

                $.ajax({
                    type: 'get',
                    url : 'http://127.0.0.1:8000/admin/order/ajax/change/status',
                    data: $data,
                    dataType:'json',
                    success:function(response){

                    }
                })

             })
        })
    </script>
@endsection
