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
                            <li class="breadcrumb-item active" aria-current="page">Registered Users</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Registered Users</h5>
                    <hr />
                    @include('layouts.alerts_block')
                    <div class="form-body mt-4">
                        <div class="row">


                            <div class="dash-wrapper bg-dark">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
                                    <div class="col border-end border-light-2">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card-body text-center">
                                                <p class="mb-1 text-white">Transport Carbon Emissions</p>
                                                <h3 class="mb-3 text-white"> <small style="font-size: 12px;">kg/CO2/km</small></h3>
                                                <p class="font-13 text-white"><span class="text-success"><i
                                                            class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col border-end border-light-2">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card-body text-center">
                                                <p class="mb-1 text-white">Energy Consumption Emissions</p>
                                                <h3 class="mb-3 text-white"> <small style="font-size: 12px;">kg/CO2/unit</small></h3>
                                                <p class="font-13 text-white"><span class="text-success"><i
                                                            class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col border-end border-light-2">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card-body text-center">
                                                <p class="mb-1 text-white">Carbon Footprint</p>
                                                <h3 class="mb-3 text-white"></h3>
                                                <p class="font-13 text-white"><span class="text-success"><i
                                                            class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col border-end border-light-2">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card-body text-center">
                                                <p class="mb-1 text-white">Award Credits</p>
                                                <h3 class="mb-3 text-white">0 <small style="font-size: 12px;">credits</small></h3>
                                                <p class="font-13 text-white"><span class="text-success"><i
                                                            class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--end row-->


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

@extends('layouts.index')

