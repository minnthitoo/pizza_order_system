@extends('admin.layouts.master')

@section('title', 'Order')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <div class="row">
                            <div class="col-3">
                                <h3>Search key : <span class="text-danger">{{ request('key') }} </span> </h3>
                            </div>
                            <div class="col-3 offset-9">
                                <form action="{{ route('admin#orderList') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="orderCode" id="" class="form-control"
                                            placeholder="Enter ordercode to search..." value="{{ request('ordercode') }}">
                                        <button class="btn btn-dark text-white"><i class="zmdi zmdi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-5">
                                <h3>Total - ( {{ count($order) }} )</h3>
                            </div>
                        </div>

                        <form action="{{ route('admin#orderStatus') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <div class="input-group">
                                    <select name="orderStatus" id="orderStatus" class="custom-select col-2">
                                        <option value="" @if (request('orderStatus') == '') selected @endif>All
                                        </option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                        </option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept
                                        </option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                        </option>
                                    </select>
                                    <div class="input-group-text" id="btnGroupAddon2">
                                        <button class="btn btn-sm btn-dark text-white" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>


                        </form>

                        {{-- @if (count($order) > 0) --}}
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Username</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" name="" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->username }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td><a href="{{ route('admin#listInfo', $o->order_code) }}"
                                                class="text-primary">{{ $o->order_code }}</a></td>
                                        <td>{{ $o->total_price }}</td>
                                        <td>
                                            <select name="status" id="" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @else
                            <h1 class="text-center">There is no order with name <span
                                    class="text-danger">{{ request('key') }}</span></h1>
                        @endif --}}

                        <div class="mt-3">
                            {{-- {{ $order->links() }} --}}
                        </div>
                    </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function() {

            //change status
            $('.statusChange').change(function() {
                $parentNote = $(this).parents('tr');
                $orderId = $parentNote.find('.orderId').val();
                $currentStatus = $(this).val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '/order/list';
                    }
                })

            })

        })
    </script>
@endsection
