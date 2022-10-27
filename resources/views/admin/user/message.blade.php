@extends('admin.layouts.master')

@section('title', 'User Messages')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody class="dataList">
                                @foreach ($messages as $message)
                                    <tr>
                                        <input type="hidden" name="id" class="id" value="{{ $message->id }}">
                                        <td class="col-3">
                                            <input type="text" class="form-control" name="" id=""
                                                value="{{ $message->name }}" disabled>
                                        </td>
                                        <td class="col-3">
                                            <input type="email" class="form-control" name="" id=""
                                                value="{{ $message->email }}" disabled>
                                        </td>
                                        <td class="col-5">
                                            <textarea name="" id="" rows="1" class="form-control">{{ $message->message }}</textarea>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-danger delete"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $messages->links() }}
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
            $('.delete').click(function() {
                $parentNote = $(this).parents('tr');
                $id = $parentNote.find('.id').val();
                $data = {
                    'id': $id
                }
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/message/delete',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = 'http://127.0.0.1:8000/user/message';
                    }
                })
            })
        })
    </script>
@endsection
