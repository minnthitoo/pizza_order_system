@extends('user.layouts.master')

@section('title', 'History')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 400px">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }}</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text text-info"><i class="fa-solid fa-hourglass-half"></i> Pending...</span>
                                    @elseif ($o->status == 1)
                                        <span class="text text-success"><i class="fa-solid fa-check"></i> Success</span>
                                    @elseif($o->status ==2)
                                        <span class="text text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
