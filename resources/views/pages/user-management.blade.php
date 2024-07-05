@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">

            {{-- <div class="alert alert-light" role="alert">
                This feature is available in <strong>Argon Dashboard 2 Pro Laravel</strong>. Check it
                <strong>
                    <a href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank">
                        here
                    </a>
                </strong>
            </div> --}}

            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                    <a class="text-sm font-weight-bold mt-3 mb-3 cursor-pointer btn btn-info" href="{{ route('user.add') }}">Add User</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                                    </th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $getallUser )
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="./img/team-3.jpg" class="avatar me-3" alt="image">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$getallUser->username}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{$getallUser->level}}</p>
                                    </td>
                                    {{-- <td class="align-middle text-center text-sm">
                                        <p class="text-sm font-weight-bold mb-0">22/03/2022</p>
                                    </td> --}}
                                    @if (auth()->user()->level == "admin" || auth()->user()->level == "manager")
                                    <td class="align-middle">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success" style="margin-right: 6px" href="{{ route('user.edit', ['id' => $getallUser->id]) }}">Edit</a>
                                            {{-- <form action="{{ route('profile.update', ['id' => auth()->user()->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success" style="margin-right: 6px">Edit</button>
                                            </form> --}}
                                            <form action="{{ route('user.delete', $getallUser->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                        @else
                                        <td class="align-middle">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <button type="button" class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-danger" disabled>No Access</button>
                                            </div>
                                        </td>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
