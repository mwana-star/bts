@extends('layouts.index')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Registered Bookings</li>
                        </ol>
                    </nav>
                </div>
                <div class="pe-3">
                    <a href="{{ route('admin.createBooking') }}" class="btn btn-primary">Add Booking</a>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Registered Bookings</h5>
                    <hr />
                    @include('layouts.alerts_block')
                    <div class="form-body mt-4">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table mb-0" id="example2">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Bus</th>
                                                        <th>Trip Route</th>
                                                        <th>Booking Date</th>
                                                        <th>Number of Passengers</th>
                                                        <th>Total Cost</th>
                                                        <th>Payment Status</th>
                                                        <th>Cancelled</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->user->first_name .' '. $booking->user->last_name }}</td>
                                                        <td>{{ $booking->bus->name }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.showTripRoutes', $booking->trip_route_id) }}">
                                                                {{ $booking->tripRoute->origin }}
                                                                to {{ $booking->tripRoute->destination }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $booking->booking_date }}</td>
                                                        <td>{{ $booking->num_passengers }}</td>
                                                        <td>{{ $booking->total_cost }}</td>
                                                        <td>{{ $booking->payment_status }}</td>
                                                        <td>{{ $booking->is_cancelled ? 'Yes' : 'No' }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.editBooking', $booking->id) }}"
                                                                class="btn btn-primary btn-sm">Edit</a>
                                                            <form class="d-inline"
                                                                action="{{ route('admin.deleteBooking', $booking->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                                            </form>
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
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
