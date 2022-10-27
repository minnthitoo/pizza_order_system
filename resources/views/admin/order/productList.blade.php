@extends('admin.layouts.master')

@section('title', 'Order Detail')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}"><button class="btn btn-outline-primary text-black "><i class="fa-solid fa-arrow-left"></i></button></a>
                        <div class="row col-4">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h3>Order Info</h3>
                                    <small class="text-success fs-5"><i class="fa-solid fa-triangle-exclamation"></i> Include Deliver Charges</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fa-solid fa-user"></i> Customer Name
                                        </div>
                                        <div class="col">
                                            {{ strtoupper($orderList[0]->username) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <i class="fa-solid fa-barcode"></i> Order Code
                                        </div>
                                        <div class="col">
                                            {{ $orderList[0]->order_code }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <i class="fa-solid fa-calendar"></i> Order Date
                                        </div>
                                        <div class="col">
                                            {{ $orderList[0]->created_at->format('j-F-Y') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <i class="fa-solid fa-money-check-dollar"></i> Total
                                        </div>
                                        <div class="col">
                                            {{ $order->total_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $ol)
                                    <tr>
                                        <td>{{ $ol->id }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/'.$ol->product_image) }}" class="img-thumbnail shadow-sm" alt="">
                                        </td>
                                        <td>{{ $ol->product_name  }}</td>
                                        <td>{{ $ol->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $ol->qty }}</td>
                                        <td>{{ $ol->total }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
