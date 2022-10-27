@extends('admin.layouts.master')

@section('title', 'Account Details')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-3">
                @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-times-circle"></i> {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img class="shadow-sm" src="{{ asset('images/default_user.jpeg ') }}" />
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}"/>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <form action="#">
                                        <h4 class="my-2"> <i class="fa-solid fa-pencil"></i> {{ Auth::user()->name }}</h4>
                                        <h4 class="my-2"> <i class="fa-solid fa-envelope"></i> {{ Auth::user()->email }}</h4>
                                        <h4 class="my-2"> <i class="fa-solid fa-phone"></i> {{ Auth::user()->phone }}</h4>
                                        <h4 class="my-2"> <i class="fa-solid fa-mars-and-venus"></i> {{ Auth::user()->gender }}</h4>
                                        <h4 class="my-2"> <i class="fa-solid fa-address-card"></i> {{ Auth::user()->address }}</h4>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4 offset-2">
                                    <a href="{{ route('admin#edit') }}" class="btn btn-dark text-white">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
