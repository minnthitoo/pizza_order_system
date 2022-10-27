@extends('user.layouts.master')

@section('title', 'Contact Us')

@section('content')
    <div class="col-6 offset-3">
        <form action="{{ route('user#contact') }}" method="post">
            @csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="userName"
                            placeholder="Enter your name...">
                    </div>
                    <div class="col-6">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" name="userEmail" class="form-control" id="userEmail"
                            placeholder="name@example.com">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="userMessage" class="form-label">Message</label>
                <textarea class="form-control" name="userMessage" id="userMessage" rows="5" placeholder="Enter your message"></textarea>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-dark">Send</button>
            </div>
        </form>
    </div>
@endsection
