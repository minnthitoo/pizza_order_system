@extends('admin.layouts.master')

@section('title', 'Accounts')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <div class="row">
                            <div class="col-3">
                                <h3>Search key : {{ request('key') }}</h3>
                            </div>
                            <div class="col-3 offset-9">
                                <form action="{{ route('admin#list') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="key" id="" class="form-control"
                                            placeholder="Search..." value="{{ request('key') }}">
                                        <button class="btn btn-dark text-white"><i class="zmdi zmdi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-5">
                                {{-- <h3>Total - ( {{ $categories->total() }} )</h3> --}}
                            </div>
                        </div>

                        <div class="col-4 offset-8">
                            @if (session('deleteSuccess'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="zmdi zmdi-times-circle"></i> {{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>


                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if (isset($d->image))
                                                <img src="{{ asset('storage/' . $d->image) }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                @if ($d->gender == 'male')
                                                    <img src="{{ asset('images/default_user.jpeg') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @else
                                                    <img src="{{ asset('images/female.webp') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{ $d->name }}
                                        </td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->gender }}</td>
                                        <td>{{ $d->phone }}</td>
                                        <td>{{ $d->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id != $d->id)
                                                <a href="{{ route('admin#changeRole', $d->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Change Role">
                                                        <i class="fa-solid fa-person-circle-minus"></i>
                                                    </button>
                                                </a>
                                                    <a href="{{ route('admin#delete', $d->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $data->links() }}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
