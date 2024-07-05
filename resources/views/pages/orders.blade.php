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
                    <!-- <a class="text-sm font-weight-bold mt-3 mb-3 cursor-pointer btn btn-info" href="{{ route('user.add') }}">Add User</a> -->
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">No</th> --}}
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Booking</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Destination</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Metode Pembayaran</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $index => $booking)
                                <tr>
                                    {{-- <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ $index + 1 }}</td> --}}
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ $booking->id }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ $booking->name }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ optional($booking->destination)->title }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ $booking->quantity }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">Rp. {{ optional($booking->transaction)->amount }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ optional($booking->transaction)->payment_method }}</td>
                                    <td class="align-middle text-center  text-sm font-weight-bold mb-0">{{ optional($booking->transaction)->payment_details }}</td>
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
