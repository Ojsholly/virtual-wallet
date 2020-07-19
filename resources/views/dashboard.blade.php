@extends('layouts.layout')
@section('title', "Dashboard")
@section('content')
<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <div class="row">

            @include('layouts.partials.sidebar')

            <!-- Middle Panel
        ============================================= -->
            <div class="col-lg-9">

                <!-- Profile Completeness
          =============================== -->
                <div class="bg-light shadow-sm rounded p-4 mb-4">
                    <h3 class="text-5 font-weight-400 d-flex align-items-center mb-3">Profile Completeness <span class="bg-light-4 text-success rounded px-2 py-1 font-weight-400 text-2 ml-2">50%</span></h3>
                    <div class="row profile-completeness">
                        <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                            <div class="border rounded p-3 text-center"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-mobile-alt"></i></span> <span class="text-5 d-block text-success mt-4 mb-3"><i class="fas fa-check-circle"></i></span>
                                <p class="mb-0">Mobile Added</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                            <div class="border rounded p-3 text-center"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-envelope"></i></span> <span class="text-5 d-block text-success mt-4 mb-3"><i class="fas fa-check-circle"></i></span>
                                <p class="mb-0">Email Added</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4 mb-sm-0">
                            <div class="border rounded p-3 text-center"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-credit-card"></i></span> <span class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                                <p class="mb-0"><a class="btn-link stretched-link" href="">Add Card</a></p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="border rounded p-3 text-center"> <span class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-university"></i></span> <span class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                                <p class="mb-0"><a class="btn-link stretched-link" href="">Add Bank Account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Completeness End -->

                <!-- Recent Activity
          =============================== -->
                <div class="bg-light shadow-sm rounded py-4 mb-4">
                    <h3 class="text-5 font-weight-400 d-flex align-items-center px-4 mb-3">Recent Activity</h3>

                    <!-- Title
            =============================== -->
                    <div class="transaction-title py-2 px-4">
                        <div class="row">
                            <div class="col-2 col-sm-1 text-center"><span class="">Date</span></div>
                            <div class="col col-sm-7">Description</div>
                            <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                            <div class="col-3 col-sm-2 text-right">Amount</div>
                        </div>
                    </div>
                    <!-- Title End -->

                    <!-- Transaction List
            =============================== -->
                    <div class="transaction-list">
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">16</span> <span class="d-block text-1 font-weight-300 text-uppercase">APR</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">HDFC Bank</span> <span class="text-muted">Withdraw to Bank account</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-warning" data-toggle="tooltip" data-original-title="In Progress"><i class="fas fa-ellipsis-h"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">- $562</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">15</span> <span class="d-block text-1 font-weight-300 text-uppercase">APR</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">Envato Pty Ltd</span> <span class="text-muted">Payment Received</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">+ $562</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">04</span> <span class="d-block text-1 font-weight-300 text-uppercase">APR</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">HDFC Bank</span> <span class="text-muted">Withdraw to Bank account</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">- $106</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">28</span> <span class="d-block text-1 font-weight-300 text-uppercase">MAR</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">Patrick Cary</span> <span class="text-muted">Refund</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">+ $60</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">28</span> <span class="d-block text-1 font-weight-300 text-uppercase">MAR</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">Patrick Cary</span> <span class="text-muted">Payment Sent</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-danger" data-toggle="tooltip" data-original-title="Cancelled"><i class="fas fa-times-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">- $60</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">16</span> <span class="d-block text-1 font-weight-300 text-uppercase">FEB</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">HDFC Bank</span> <span class="text-muted">Withdraw to Bank account</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">- $1498</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                        <div class="transaction-item px-4 py-3" data-toggle="modal" data-target="#transaction-detail">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4 font-weight-300">15</span> <span class="d-block text-1 font-weight-300 text-uppercase">FEB</span> </div>
                                <div class="col col-sm-7"> <span class="d-block text-4">Envato Pty Ltd</span> <span class="text-muted">Payment Received</span> </div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3"> <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span> </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">+ $1498</span> <span class="text-2 text-uppercase">(USD)</span> </div>
                            </div>
                        </div>
                    </div>
                    <!-- Transaction List End -->

                    <!-- Transaction Item Details Modal
            =========================================== -->
                    <div id="transaction-detail" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row no-gutters">
                                        <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                                            <div class="my-auto text-center">
                                                <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                                                <h3 class="text-4 text-white font-weight-400 my-3">Envato Pty Ltd</h3>
                                                <div class="text-8 font-weight-500 text-white my-4">$557.20</div>
                                                <p class="text-white">15 March 2019</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <h5 class="text-5 font-weight-400 m-3">Transaction Details
                                                <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                            </h5>
                                            <hr>
                                            <div class="px-3">
                                                <ul class="list-unstyled">
                                                    <li class="mb-2">Payment Amount <span class="float-right text-3">$562.00</span></li>
                                                    <li class="mb-2">Fee <span class="float-right text-3">-$4.80</span></li>
                                                </ul>
                                                <hr class="mb-2">
                                                <p class="d-flex align-items-center font-weight-500 mb-4">Total Amount <span class="text-3 ml-auto">$557.20</span></p>
                                                <ul class="list-unstyled">
                                                    <li class="font-weight-500">Paid By:</li>
                                                    <li class="text-muted">Envato Pty Ltd</li>
                                                </ul>
                                                <ul class="list-unstyled">
                                                    <li class="font-weight-500">Transaction ID:</li>
                                                    <li class="text-muted">26566689645685976589</li>
                                                </ul>
                                                <ul class="list-unstyled">
                                                    <li class="font-weight-500">Description:</li>
                                                    <li class="text-muted">Envato March 2019 Member Payment</li>
                                                </ul>
                                                <ul class="list-unstyled">
                                                    <li class="font-weight-500">Status:</li>
                                                    <li class="text-muted">Completed</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Transaction Item Details Modal End -->

                    <!-- View all Link
            =============================== -->
                    <div class="text-center mt-4"><a href="transactions.html" class="btn-link text-3">View all<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
                    <!-- View all Link End -->

                </div>
                <!-- Recent Activity End -->
            </div>
            <!-- Middle Panel End -->
        </div>
    </div>
</div>
<!-- Content end -->

@include('layouts.partials.footer')

</div>
<!-- Document Wrapper end -->

<!-- Back to Top
============================================= -->

@endsection
