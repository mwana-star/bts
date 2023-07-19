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
                            <li class="breadcrumb-item active" aria-current="page">Payments Made</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Payments Made</h5>
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
                                                        <th>Trip Route</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Transaction ID</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->user->name }}</td>
                                                        <td>
                                                            <a href="{{ route('bookings.show', $payment->booking_id) }}">
                                                                {{ $payment->booking->tripRoute->origin }}
                                                                to {{ $payment->booking->tripRoute->destination }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>{{ $payment->payment_method }}</td>
                                                        <td>{{ $payment->transaction_id }}</td>
                                                        <td>{{ $payment->status }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.editPayment', $payment->id) }}"
                                                                class="btn btn-primary btn-sm">Edit</a>
                                                            <form class="d-inline"
                                                                action="{{ route('admin.deletePayment', $payment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
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
