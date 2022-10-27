@extends('admin.layouts.master')

@section('title', 'Pizza Update')

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
                                <h3 class="text-center title-2">Pizza Update</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/' . $pizza->image) }}"
                                            class="img-thumbnail shadow-sm" />
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage"
                                                class="form-control" id="">
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white col-12" type="submit">Update <i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="name" name="pizzaName" value="{{ old('pizzaName', $pizza->name) }}"
                                                type="text" class="form-control @error('pizzaName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="price" name="pizzaPrice" value="{{ old('pizzaPrice', $pizza->price) }}"
                                                type="number" class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" type="number"
                                                class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror col-12">
                                                <option value="">Choose Your Pizza Type...</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}" @if ($pizza->category_id == $cat->id)
                                                        selected
                                                    @endif>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id="" rows="10"
                                                placeholder="Enter Pizza Description">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="" name="view_count"
                                                value="{{ $pizza->view_count }}" type="number"
                                                class="form-control "
                                                aria-required="true" aria-invalid="false" placeholder="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="" name="created_at"
                                                value="{{ $pizza->created_at->format('j-F-Y') }}" type="text"
                                                class="form-control"
                                                aria-required="true" aria-invalid="false" placeholder="" disabled>
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
