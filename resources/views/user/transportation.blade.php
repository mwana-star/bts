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
                            <li class="breadcrumb-item active" aria-current="page">Transportation Statistics</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Transportation Statistics</h5>
                    <hr />
                    @include('layouts.alerts_block')
                    <div class="form-body mt-4">
                        <div class="row">

                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <form action="{{ route('transportation.store') }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputMode" class="form-label">Mode of Transportation</label>
                                                <select class="form-select @error('mode') is-invalid @enderror"
                                                    id="inputMode" name="mode">
                                                    <option></option>
                                                    <option value="walking">Walking</option>
                                                    <option value="cycling">Cycling</option>
                                                    <option value="public_transport">Public Transport</option>
                                                    <option value="car">Car</option>
                                                    <option value="motorbike">Motorbike</option>
                                                </select>
                                                @error('mode')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDistance" class="form-label">Distance (in
                                                    kilometers)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('distance') is-invalid @enderror"
                                                    id="inputDistance" name="distance" placeholder="Enter distance">
                                                @error('distance')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFrequency" class="form-label">Frequency of Travel</label>
                                                <select class="form-select @error('frequency') is-invalid @enderror"
                                                    id="inputFrequency" name="frequency">
                                                    <option></option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                </select>
                                                @error('frequency')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDuration" class="form-label">Duration (in minutes or
                                                    hours)</label>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    id="inputDuration" name="duration" placeholder="Enter duration">
                                                @error('duration')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Save
                                                        Transportation</button>
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
                                                        <th>Mode of Transportation</th>
                                                        <th>Distance (km)</th>
                                                        <th>Frequency</th>
                                                        <th>Duration</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transportations as $transportation)
                                                        <tr>
                                                            <td>{{ $transportation->mode }}</td>
                                                            <td>{{ $transportation->distance }}</td>
                                                            <td>{{ $transportation->frequency }}</td>
                                                            <td>{{ $transportation->duration }}</td>
                                                            <td>{{ $transportation->created_at }}</td>
                                                            {{-- <td>
                                                                <!-- Actions buttons -->
                                                                <a href="{{ route('transportation.edit', $transportation->id) }}" class="btn btn-primary btn-sm"><i class="bx bxs-edit"></i></a>
                                                                <form action="{{ route('transportation.destroy', $transportation->id) }}" method="POST" class="d-inline">
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
