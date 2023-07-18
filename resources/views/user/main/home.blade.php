@extends('user.layout.master');
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->

                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="text-white bg-dark d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }} " class="text-decoration-none text-white mx-3 my-1 fs-5 fw-bold">
                            Categories->All <span class="badge border font-weight-normal"></span>
                            </a>

                        </div>
                        <hr class="bg-dark">
                        @foreach ($category as $ca)
                            <div class=" bg-dark d-flex align-items-center justify-content-between mb-3">

                                <a href="{{ route('user#filter', $ca->id) }}" class="text-decoration-none ">
                                    <span class="mx-3 my-1 text-white fs-5 fw-bold" for="price-1">{{ $ca->category_name }}</span>
                                </a>
                            </div>
                            <hr class="bg-dark">
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <div>
                    <a href="{{ route('user#contactToAdimn') }}">
                        <button class="btn btn btn-dark w-100"><i class="fa-regular fa-address-card text-white"></i>
                            Contact
                        </button>
                    </a>
                </div>
                <div class="my-2">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        @if (Session('send'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-delete-left"></i>{{ session('send') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a class="btn btn-square" href="{{ route('cart#list') }}">

                                    <button type="button" class="btn btn-dark position-relative ">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}+
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </a>
                                <a class="btn btn-square" href="{{ route('user#history') }}">
                                    <button type="button" class="btn btn-dark position-relative mx-4">
                                        <i class="fa fa-history " aria-hidden="true">history</i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}+
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption">
                                        <option value="">choose sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Session('upAccountSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-check"></i>{{ session('upAccountSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <span class="row" id="dataList">
                        @if (count($pizzas) != 0)
                            @foreach ($pizzas as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 200px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">

                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('userPizza#details', $p->id) }}"><i
                                                        class="fa-solid fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>

                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                                <h6 class="text-muted ml-2"><del>{{ $p->price }}</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1>there is no pizza</h1>
                        @endif
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div><!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        $('#sortingOption').change(function() {
            $eventOption = $('#sortingOption').val();
            if ($eventOption == 'asc') {
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/pizza/list',
                    data: {
                        'status': 'asc'
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = ``;
                        for ($i = 0; $i < response.length; $i++) {
                            //console.log(`${response[$i].name}`);
                            $list += `
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4" id="myForm">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height: 200px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                     <div class="product-action">

                                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                         <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>
                                                     </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                         <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price}</del></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                        }
                        // console.log($list);
                        $('#dataList').html($list);
                    }
                });
            } else if ($eventOption == 'desc') {
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/pizza/list',
                    data: {
                        'status': 'desc'
                    },
                    dataType: 'json',
                    success: function(response) {
                        $list = ``;
                        for ($i = 0; $i < response.length; $i++) {
                            //console.log(`${response[$i].name}`);
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 200px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price}</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>    `;
                        }
                        // console.log($list)
                        $('#dataList').html($list);
                    }
                });
            }
        })
    </script>
@endsection
