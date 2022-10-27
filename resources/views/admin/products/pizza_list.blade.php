@extends('admin.layouts.master')

@section('title', 'Product List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                        </div>
                    </div>
                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <div class="row">
                                <div class="col-3">
                                    <h3>Search key : <span class="text-danger">{{ request('key') }} </span> </h3>
                                </div>
                                <div class="col-3 offset-9">
                                    <form action="{{ route('product#list') }}" method="GET">
                                        @csrf
                                        <div class="d-flex">
                                            <input type="text" name="key" id="" class="form-control"
                                                placeholder="Search..." value="{{ request('key') }}">
                                            <button class="btn btn-dark text-white"><i
                                                    class="zmdi zmdi-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-5">
                                    <h3>Total - ( {{ $pizzas->total() }} )</h3>
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
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{ asset('storage/' . $pizza->image) }}"
                                                    class="img-thumbnail shadow-sm"></td>
                                            <td class="col-3">{{ $pizza->name }}</td>
                                            <td class="col-2">{{ $pizza->price }}</td>
                                            <td class="col-2">{{ $pizza->category_name }}</td>
                                            <td class="col-2"><i class="zmdi zmdi-eye"></i> {{ $pizza->view_count }}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature">

                                                    <a href="{{ route('product#edit', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="See">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Data.</h3>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
