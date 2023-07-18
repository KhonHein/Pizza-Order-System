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
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataBody">
                        @foreach ($cartList as $c )

                        <tr>
                            <input type="hidden" id="userId" value="{{ $c->user_id }}">
                            <input type="hidden" id="orderId" value="{{ $c->id }}">
                            <input type="hidden" id="productId" value="{{ $c->product_id }}">
                            <td class="align-middle"><img src="{{ asset('storage/'.$c->pizza_image) }}" alt="" style="width: 100px;"></td>
                            <td class="align-middle" id="name">{{ $c->pizza_name  }}</td>
                            <td class="align-middle" id="price">{{ $c->pizza_price }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" id="fa-minus">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->qty }}">
                                    <input type="hidden" id="qty" value="{{ $c->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" id="fa-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $c->qty*$c->pizza_price }} kyats </td>
                            <input type="hidden" id="totalHidden" value="{{ $c->qty*$c->pizza_price }}">
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delievery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="sumPrice">${{ $totalPrice+3000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            Proceed To Checkout
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">
                            Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>

        $('#orderBtn').click(function(){

            $orderList =[];
            $random = Math.floor(Math.random()*100000001);
           // console.log($random);
            $('#dataBody tr').each(function(index,row){
                $orderList.push({
                    'userId' : $(row).find('#userId').val(),
                    'productId' : $(row).find('#productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#totalHidden').val()),
                    'orderCode' : 'POS'+$random+'code'

                });
            });
            $.ajax({
                            type: 'get',
                            url: '/user/ajax/order',
                            data: Object.assign({} , $orderList),
                            dataType: 'json',
                            success: function (response) {
                                //console.log(response.status);
                                if(response.status == 'true'){
                                     window.location.href = '/user/homePage';
                                }
                             }
                    });

        })


        //when clear btn is clicked
        $('#clearBtn').click(function(){
            $('#dataBody tr').remove();
            $('#subTotal').html('0 kyats');
            $('#sumPrice').html('3000 kyat');
            $.ajax({
                            type: 'get',
                            url: '/user/ajax/clear/cart',
                            dataType: 'json',

                    });
        })
    </script>
@endsection
