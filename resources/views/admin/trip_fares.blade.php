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
                            <li class="breadcrumb-item active" aria-current="page">Registered Trip Fares</li>
                        </ol>
                    </nav>
                </div>
                <div class="pe-3">
                    <a href="{{ route('admin.createTripFare') }}" class="btn btn-primary">Add Trip Fare</a>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Registered Trip Fares</h5>
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
                                                        <th>Trip Route</th>
                                                        <th>Base Fare</th>
                                                        <th>Discount</th>
                                                        <th>Discount Type</th>
                                                        <th>Additional Fee</th>
                                                        <th>Additional Fee Type</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tripFares as $fare)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.showTripRoutes', $fare->trip_route_id) }}">
                                                                {{ $fare->tripRoute->origin }} to {{ $fare->tripRoute->destination }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $fare->base_fare }}</td>
                                                        <td>{{ $fare->discount }}</td>
                                                        <td>{{ $fare->discount_type ?: 'N/A' }}</td>
                                                        <td>{{ $fare->additional_fee }}</td>
                                                        <td>{{ $fare->additional_fee_type ?: 'N/A' }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.editTripFare', $fare->id) }}"
                                                                class="btn btn-primary btn-sm">Edit</a>
                                                            <form class="d-inline"
                                                                action="{{ route('admin.deleteTripFare', $fare->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this trip fare?')">Delete</button>
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
