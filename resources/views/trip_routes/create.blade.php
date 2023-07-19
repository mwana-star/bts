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
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('trip_routes.index') }}">Trip Routes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ isset($tripRoute) ? 'Edit Trip Route' : 'Create Trip Route' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">{{ isset($tripRoute) ? 'Edit Trip Route' : 'Create Trip Route' }}</h5>
                    <hr />
                    @include('layouts.alerts_block')
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    @if(isset($tripRoute))
                                    <form action="{{ route('admin.updateTripRoute', $tripRoute->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    @else
                                    <form action="{{ route('admin.storeTripRoute') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    @endif
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputOrigin" class="form-label">Origin</label>
                                                <input type="text" class="form-control @error('origin') is-invalid @enderror"
                                                    id="inputOrigin" name="origin" placeholder="Enter origin" value="{{ isset($tripRoute) ? $tripRoute->origin : old('origin') }}">
                                                @error('origin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDestination" class="form-label">Destination</label>
                                                <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                                    id="inputDestination" name="destination" placeholder="Enter destination" value="{{ isset($tripRoute) ? $tripRoute->destination : old('destination') }}">
                                                @error('destination')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDistance" class="form-label">Distance (in km)</label>
                                                <input type="number" step="0.01" class="form-control @error('distance') is-invalid @enderror"
                                                    id="inputDistance" name="distance" placeholder="Enter distance" value="{{ isset($tripRoute) ? $tripRoute->distance : old('distance') }}">
                                                @error('distance')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEstimatedTravelTime" class="form-label">Estimated Travel Time</label>
                                                <input type="time" class="form-control @error('estimated_travel_time') is-invalid @enderror"
                                                    id="inputEstimatedTravelTime" name="estimated_travel_time" placeholder="Enter estimated travel time" value="{{ isset($tripRoute) ? $tripRoute->estimated_travel_time : old('estimated_travel_time') }}">
                                                @error('estimated_travel_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputRouteCode" class="form-label">Route Code</label>
                                                <input type="text" class="form-control @error('route_code') is-invalid @enderror"
                                                    id="inputRouteCode" name="route_code" placeholder="Enter route code" value="{{ isset($tripRoute) ? $tripRoute->route_code : old('route_code') }}">
                                                @error('route_code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDescription" class="form-label">Description</label>
                                                <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Enter trip route description">{{ isset($tripRoute) ? $tripRoute->description : old('description') }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputRouteMap" class="form-label">Route Map</label>
                                                <input type="file" class="form-control" id="inputRouteMap" name="route_map">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Active</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="active" value="1" {{ (isset($tripRoute) && $tripRoute->active) || old('active') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">{{ isset($tripRoute) ? 'Update Trip Route' : 'Create Trip Route' }}</button>
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
