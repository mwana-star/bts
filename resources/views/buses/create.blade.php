@extends('layouts.index')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('buses.index') }}">Buses</a>
                    </li>
                            <li class="breadcrumb-item active" aria-current="page">Create Bus</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Create Bus</h5>
                    <hr />
                    @include('layouts.alerts_block')
                    <div class="form-body mt-4">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    <form action="{{ route('admin.storeBus') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputName" class="form-label">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    id="inputName" name="name" placeholder="Enter bus name">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputTotalSeats" class="form-label">Total Seats</label>
                                                <input type="number" class="form-control @error('total_seats') is-invalid @enderror"
                                                    id="inputTotalSeats" name="total_seats" placeholder="Enter total seats">
                                                @error('total_seats')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputModel" class="form-label">Model</label>
                                                <input type="text" class="form-control" id="inputModel" name="model" placeholder="Enter bus model">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputManufactureYear" class="form-label">Manufacture Year</label>
                                                <input type="number" class="form-control" id="inputManufactureYear" name="manufacture_year" placeholder="Enter manufacture year">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputRegistrationNumber" class="form-label">Registration Number</label>
                                                <input type="text" class="form-control @error('registration_number') is-invalid @enderror"
                                                    id="inputRegistrationNumber" name="registration_number" placeholder="Enter registration number">
                                                @error('registration_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDescription" class="form-label">Description</label>
                                                <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Enter bus description"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Availability</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_available" value="1" checked>
                                                    <label class="form-check-label">
                                                        Available
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_available" value="0">
                                                    <label class="form-check-label">
                                                        Not Available
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputImage" class="form-label">Image</label>
                                                <input type="file" class="form-control" id="inputImage" name="image">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDriverName" class="form-label">Driver Name</label>
                                                <input type="text" class="form-control" id="inputDriverName" name="driver_name" placeholder="Enter driver name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputContactNumber" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="inputContactNumber" name="contact_number" placeholder="Enter contact number">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Wi-Fi Available</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="wifi_available" value="1">
                                                    <label class="form-check-label">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Air Conditioned</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="air_conditioned" value="1">
                                                    <label class="form-check-label">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Wheelchair Accessible</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="wheelchair_accessible" value="1">
                                                    <label class="form-check-label">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Create Bus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


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
