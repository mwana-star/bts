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

                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <form action="{{ route('energy.store') }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="inputLocation" class="form-label">Location</label>
                                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                                    id="inputLocation" name="location" placeholder="Enter location">
                                                @error('location')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputElectricityUsage" class="form-label">Electricity Usage (kWh)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('electricity_usage') is-invalid @enderror"
                                                    id="inputElectricityUsage" name="electricity_usage" placeholder="Enter electricity usage">
                                                @error('electricity_usage')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCookingFuelType" class="form-label">Cooking Fuel Type</label>
                                                <select class="form-select @error('cooking_fuel_type') is-invalid @enderror"
                                                    id="inputCookingFuelType" name="cooking_fuel_type">
                                                    <option></option>
                                                    <option value="electricity">Electricity</option>
                                                    <option value="gas">Gas</option>
                                                    <option value="charcoal">Charcoal</option>
                                                    <option value="firewood">Firewood</option>
                                                </select>
                                                @error('cooking_fuel_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputGeneratorFuelConsumption" class="form-label">Generator Fuel Consumption (units)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('generator_fuel_consumption') is-invalid @enderror"
                                                    id="inputGeneratorFuelConsumption" name="generator_fuel_consumption" placeholder="Enter generator fuel consumption">
                                                @error('generator_fuel_consumption')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save Energy Consumption</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                            <div class="col-lg-8">

                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table mb-0">
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
