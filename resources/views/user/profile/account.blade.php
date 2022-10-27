@extends('user.layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="main-content">
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
                                <h3 class="text-center title-2">Account Update</h3>
                            </div>
                            <hr>

                            @if (session('updateSuccess'))
                                <div class="col-3 offset-8">
                                    <div class="alert alert-success alert-dismissable fade show" role='alert'>
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('updateSuccess') }}
                                        <button class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('images/default_user.jpeg ') }}"
                                                class="img-thumbnail shadow-sm col-12" />
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror" id="">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white col-12" type="submit">Update <i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="name" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="email" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="phone" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" type="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30"
                                                rows="10" placeholder="Enter Admin Address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="role" name="role" value="{{ Auth::user()->role }}"
                                                type="text" class="form-control" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Name" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
