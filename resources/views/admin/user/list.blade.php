@extends('admin.layouts.master')

@section('title', 'User List')

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
                                <form action="{{ route('admin#userList') }}" method="GET">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="name" id="" class="form-control"
                                            placeholder="Search..." value="{{ request('name') }}">
                                        <button class="btn btn-dark text-white"><i class="zmdi zmdi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody class="dataList">
                                @foreach ($users as $user)
                                    <tr>
                                        <input type="hidden" name="userId" class="userId" value="{{ $user->id }}">
                                        <td>
                                            @if ($user->image == null)
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('images/default_user.jpeg') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @else
                                                    <img src="{{ asset('images/female.webp') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}" alt="John Doe" />
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <select name="role" id="" class="form-control statusChange">
                                                <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $users->links() }}
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

            //change role
            $('.statusChange').change(function() {
                $parentNote = $(this).parents('tr');
                $userId = $parentNote.find('.userId').val();
                $currentRole = $(this).val();

                $data = {
                    'userId': $userId,
                    'currentRole': $currentRole
                }

                $.ajax({
                    type: 'get',
                    url: '/admin/ajax/change/role',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '/user/list';
                    }
                })
            })

        })
    </script>
@endsection
