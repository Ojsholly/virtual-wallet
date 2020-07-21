@extends('layouts.layout') @section('title', 'Bank Accounts') @section('content')

<!-- Secondary Menu
  ============================================= -->
<div class="bg-primary">
    <div class="container d-flex justify-content-center">
        <ul class="nav secondary-nav">
            <li class="nav-item"> <a class="nav-link"
                    href="{{ url('profile/edit-profile/'.Auth::user()->uuid) }}">Account</a></li>
            <li class="nav-item"> <a class="nav-link active" href="{{ url('bank-accounts') }}">Bank
                    Accounts</a></li>
        </ul>
    </div>
</div>
<!-- Secondary Menu end -->


<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <div class="row">

            @include('layouts.partials.sidebar')


            <!-- Middle Panel
        ============================================= -->
            <div class="col-lg-9">

                <!-- Bank Accounts
          ============================================= -->
                <div class="bg-light shadow-sm rounded p-4 mb-4">
                    <h3 class="text-5 font-weight-400 mb-4">Bank Accounts <span class="text-muted text-4">(for
                            withdrawal)</span></h3>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="account-card account-card-primary text-white rounded mb-4 mb-lg-0">
                                <div class="row no-gutters">
                                    <div class="col-3 d-flex justify-content-center p-3">
                                        <div class="my-auto text-center text-13"> <i class="fas fa-university"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 border-left">
                                        <div class="py-4 my-2 pl-4">
                                            <p class="text-4 font-weight-500 mb-1">HDFC Bank</p>
                                            <p class="text-4 opacity-9 mb-1">XXXXXXXXXXXX-9025</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-card-overlay rounded"> <a href="#"
                                        data-target="#bank-account-details" data-toggle="modal"
                                        class="text-light btn-link mx-2"><span class="mr-1"><i
                                                class="fas fa-share"></i></span>More Details</a> <a href="#"
                                        class="text-light btn-link mx-2"><span class="mr-1"><i
                                                class="fas fa-minus-circle"></i></span>Delete</a> </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="" data-target="#add-new-bank-account" data-toggle="modal"
                                class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
                                <p class="w-100 text-center line-height-4 m-0"> <span class="text-3"><i
                                            class="fas fa-plus-circle"></i></span> <span
                                        class="d-block text-body text-3">Add New Bank Account</span> </p>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Edit Bank Account Details Modal
          ======================================== -->
                <div id="bank-account-details" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row no-gutters">
                                    <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                                        <div class="my-auto text-center">
                                            <div class="text-17 text-white mb-3"><i class="fas fa-university"></i></div>
                                            <h3 class="text-6 text-white my-3">HDFC Bank</h3>
                                            <div class="text-4 text-white my-4">XXX-9027 | INR</div>
                                            <p
                                                class="bg-light text-0 text-body font-weight-500 rounded-pill d-inline-block px-2 line-height-4 mb-0">
                                                Primary</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <h5 class="text-5 font-weight-400 m-3">Bank Account Details
                                            <button type="button" class="close font-weight-400" data-dismiss="modal"
                                                aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                        </h5>
                                        <hr>
                                        <div class="px-3">
                                            <ul class="list-unstyled">
                                                <li class="font-weight-500">Account Type:</li>
                                                <li class="text-muted">Personal</li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-500">Account Name:</li>
                                                <li class="text-muted">Smith Rhodes</li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-500">Account Number:</li>
                                                <li class="text-muted">XXXXXXXXXXXX-9025</li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-500">Bank Country:</li>
                                                <li class="text-muted">India</li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-500">Status:</li>
                                                <li class="text-muted">Approved <span class="text-success text-3"><i
                                                            class="fas fa-check-circle"></i></span></li>
                                            </ul>
                                            <p><a href="#"
                                                    class="btn btn-sm btn-outline-danger btn-block shadow-none"><span
                                                        class="mr-1"><i class="fas fa-minus-circle"></i></span>Delete
                                                    Account</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add New Bank Account Details Modal
          ======================================== -->
                <div id="add-new-bank-account" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-400">Add bank account</h5>
                                <button type="button" class="close font-weight-400" data-dismiss="modal"
                                    aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body p-4">
                                <form id="addbankaccount" method="post" action="{{ url('bank-accounts/new-account') }}">
                                    <div class="form-group">
                                        <label for="inputCountry">Bank Country</label>
                                        <select class="custom-select" id="inputCountry" name="country_id">
                                            <option value="NG">Nigeria</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bankName">Bank Name</label>
                                        <select class="custom-select" id="bankName" name="bankName">
                                            <option value=""> Please Select </option>
                                            <option value="1">Bank Name 1</option>
                                            <option value="2">Bank Name 2</option>
                                            <option value="3">Bank Name 3</option>
                                            <option value="4">Bank Name 4</option>
                                            <option value="5">Bank Name 5</option>
                                            <option value="6">Bank Name 6</option>
                                            <option value="7">Bank Name 7</option>
                                            <option value="8">Bank Name 8</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="accountName">Account Name</label>
                                        <input type="text" class="form-control" data-bv-field="accountName"
                                            id="accountName" required value="" placeholder="e.g. Smith Rhodes">
                                    </div>
                                    <div class="form-group">
                                        <label for="accountNumber">Account Number</label>
                                        <input type="text" class="form-control" data-bv-field="accountNumber"
                                            id="accountNumber" required value="" placeholder="e.g. 12346678900001">
                                    </div>
                                    <div class="form-group">
                                        <label for="ifscCode">NEFT IFSC Code</label>
                                        <input type="text" class="form-control" data-bv-field="ifscCode" id="ifscCode"
                                            required value="" placeholder="e.g. ABCDE12345">
                                    </div>
                                    <div class="form-check custom-control custom-checkbox mb-3">
                                        <input id="remember-me" name="remember" class="custom-control-input"
                                            type="checkbox">
                                        <label class="custom-control-label" for="remember-me">I confirm the bank account
                                            details above</label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Add Bank Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bank Accounts End -->

            </div>
            <!-- Middle Panel End -->
        </div>
    </div>
</div>
<!-- Content end -->
@endsection
