@extends('admin.layouts.master')

@section('title', 'Pizza Details')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-3">
                @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="zmdi zmdi-times-circle"></i> {{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        {{-- <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a> --}}
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-success" onclick="history.back()">Back</button>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" />
                                </div>
                                <div class="col-7">
                                    <form action="#">
                                        <span class="my-2 btn btn-success"> <i class="fa-solid fa-pencil me-2"></i>
                                            {{ $pizza->name }}</span><br>
                                        <span class="my-2 btn btn-dark"> <i class="fa-solid fa-envelope me-2"></i>
                                            {{ $pizza->price }}</span>
                                        <span class="my-2 btn btn-dark"> <i class="fa-solid fa-phone me-2"></i>
                                            {{ $pizza->waiting_time }}</span>
                                        <span class="my-2 btn btn-dark"> <i class="fa-solid fa-mars-and-venus me-2"></i>
                                            {{ $pizza->view_count }}</span>
                                        <span class="my-2 btn btn-dark"> <i class="fa-solid fa-mars-and-venus me-2"></i>
                                            {{ $pizza->category_name }}</span><br>
                                        <span class="my-2 btn btn-dark"> <i class="fa-solid fa-address-card me-2"></i>
                                            {{ $pizza->created_at->format('j-F-Y') }}</span>
                                        <div class="my-2"> <i class="fa-solid fa-address-card me-2"></i>
                                            {{ $pizza->description }}</div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{-- <div class="col-4 offset-2">
                                    <a href="" class="btn btn-dark text-white">Edit Pizza</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
