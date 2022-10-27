@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <div class="row">
                            <div class="col-3">
                                <h3>Search key : {{ request('key') }}</h3>
                            </div>
                            <div class="col-3 offset-9">
                                <form action="{{ route('category#list') }}" method="GET">
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
                                <h3>Total - ( {{ $categories->total() }} )</h3>
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

                        @if (count($categories) != 0)
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category name</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="See">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button> --}}
                                                    <a href="{{ route('category#edit', $category->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
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
                                {{-- {{ $categories->links() }} --}}
                                {{ $categories->appends(request()->query())->links() }}
                            </div>
                    </div>
                @else
                    <h3 class="text-secondary text-center mt-5">There is no category here.</h3>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
