@extends('layouts.index')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row">
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="border border-3 p-4 rounded">
                                <form action="{{ route('admin.storeBus') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputTripRoute" class="form-label">Trip Route</label>
                                            <select class="form-control @error('trip_route_id') is-invalid @enderror" id="inputTripRoute" name="trip_route_id">
                                                <option value="">Select a Trip Route</option>
                                                @foreach($tripRoutes as $tripRoute)
                                                    <option value="{{ $tripRoute->id }}">{{ $tripRoute->origin }} to {{ $tripRoute->destination }}</option>
                                                @endforeach
                                            </select>
                                            @error('trip_route_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-3">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Select Trip</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>


                    </div>
                    <!--end row-->
                    <div class="card">
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31912.35718701679!2d36.878011789301205!3d-1.1283569767876993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f3ed24117de5b%3A0xf1df679a37a70faa!2sTatu%20City!5e0!3m2!1sen!2ske!4v1689765004275!5m2!1sen!2ske" width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
@endsection
