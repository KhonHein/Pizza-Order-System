@extends('user.layout.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 height-400">
            <div class="col-lg-8 offset-2 table-responsive mb-5 ">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>order date</th>
                            <th>ordr id</th>
                            <th>total price </th>
                            <th>status </th>

                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataBody">
                        @foreach ($order as $o)
                            <tr>
                                <td class="">{{ $o->created_at->format('j/F/Y') }}</td>
                                <td class="">{{ $o->order_code }}</td>
                                <td class="">{{ $o->total_price }}</td>
                                <td class="">
                                    @if ( $o->status == 0)
                                        <span class="text-primary"><i class="fa-solid fa-hourglass-start mx-2"></i>pinese</span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success"><i class="fa-regular fa-square-check mx-2"></i>success</span>
                                    @elseif ($o->status == 2)
                                        <span class="text-danger"> <i class="fa-solid fa-triangle-exclamation mx-2"></i>reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>{{ $order->links() }}</span>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
@section('scriptSource')

@endsection
