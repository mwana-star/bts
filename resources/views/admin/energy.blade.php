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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Energy Consumption Statistics</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Energy Consumption Statistics</h5>
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
                                                        <th>Location</th>
                                                        <th>Electricity Usage (kWh)</th>
                                                        <th>Cooking Fuel Type</th>
                                                        <th>Generator Fuel Consumption (units)</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($energyConsumption as $energyConsumption)
                                                        <tr>
                                                            <td>{{ $energyConsumption->location }}</td>
                                                            <td>{{ $energyConsumption->electricity_usage }}</td>
                                                            <td>{{ $energyConsumption->cooking_fuel_type }}</td>
                                                            <td>{{ $energyConsumption->generator_fuel_consumption }}</td>
                                                            <td>{{ $energyConsumption->created_at }}</td>
                                                            {{-- <td>
                                                                <!-- Actions buttons -->
                                                                <a href="{{ route('energy.edit', $energyConsumption->id) }}" class="btn btn-primary btn-sm"><i class="bx bxs-edit"></i></a>
                                                                <form action="{{ route('energy.destroy', $energyConsumption->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bx bxs-trash"></i></button>
                                                                </form>
                                                            </td> --}}
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
