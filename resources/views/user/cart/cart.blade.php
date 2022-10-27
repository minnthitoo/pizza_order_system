@extends('user.layouts.master')

@section('title', 'Cart')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cartList as $cl)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/' . $cl->pizza_image) }}" alt=""
                                        style="width: 50px;">
                                    {{ $cl->pizza_name }}
                                    <input type="hidden" class="orderId" value="{{ $cl->id }}">
                                    <input type="hidden" class="productId"
                                        value="{{ $cl->product_id }}">
                                    <input type="hidden" class="userId" value="{{ $cl->user_id }}">
                                </td>
                                <td class="align-middle" id="price">{{ $cl->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cl->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ (int) $cl->pizza_price * (int) $cl->qty }} Kyats
                                </td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                            @php
                                $total += $cl->pizza_price * $cl->qty;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $total }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotalPrice">{{ $total + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            <span class="text-white">Proceed To Checkout</span>
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">
                            <span class="text-white">Clear Cart</span>
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
        $('#orderBtn').click(function() {
            $orderList = [];

            $random = Math.floor(Math.random() * 1000000001);
            $('#dataTable tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                    'order_code': 'POS' + $random
                })
            })
            $.ajax({
                type: 'get',
                url: '/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true') {
                        window.location.href = '/user/home';
                    }
                }
            })
        })
        $('#clearBtn').click(function() {
            $('#subTotalPrice').html('0 Kyats');
            $('#finalTotalPrice').html('0 Kyats');
            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/cart',
                dataType: 'json'
            })
            $('#dataTable tr').remove();
        })

        //remove current product
        $('.btnRemove').click(function() {
            $parentNote = $(this).parents('tr');
            $productId = $parentNote.find('.productId').val();
            $orderId = $parentNote.find('.orderId').val();
            console.log($productId);
            console.log($orderId);
            $parentNote.remove();

            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/current/product',
                data: {
                    'orderId': $orderId,
                    'productId': $productId
                },
                dataType: 'json'
            })

            $totalPrice = 0;

            //total summary
            $('#dataTable tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));
            })
            $('#subTotalPrice').html($totalPrice + " Kyats");
            $('#finalTotalPrice').html(($totalPrice + 3000) + " Kyats");
        })
    </script>
@endsection
