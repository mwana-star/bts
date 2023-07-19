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
                    <a href="{{ route('admin.createBus') }}" class="btn btn-primary">Add Bus</a>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Registered Buses</h5>

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
                                                        <th>Name</th>
                                                        <th>Total Seats</th>
                                                        <th>Model</th>
                                                        <th>Registration Number</th>
                                                        <th>Is Available</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($buses as $bus)
                                                    <tr>
                                                        <td><a href="{{ route('buses.show', $bus->id) }}">{{ $bus->name }}</a></td>
                                                        <td>{{ $bus->total_seats }}</td>
                                                        <td>{{ $bus->model ?: 'N/A' }}</td>
                                                        <td>{{ $bus->registration_number }}</td>
                                                        <td>{{ $bus->is_available ? 'Yes' : 'No' }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.editBus', $bus->id) }}"
                                                                class="btn btn-primary btn-sm">Edit</a>
                                                            <form class="d-inline"
                                                                action="{{ route('admin.deleteBus', $bus->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this bus?')">Delete</button>
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
