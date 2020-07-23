@extends('layouts.layout') @section('title', 'Bank Accounts') @section('content')

@php
$status = $fetch_banks->status;
@endphp
@if($status != 200)
$error = $fetch_banks->error;
@else
@php
$banks = $fetch_banks->list;
$banks = json_decode($banks);
@endphp
@endif

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

                <!-- Bank Account
          ============================================= -->
                <div class="bg-light shadow-sm rounded p-4 mb-4">
                    <h3 class="text-5 font-weight-400 mb-4 text-center">Bank Account <span
                            class="text-muted text-4">(for
                            withdrawal)</span></h3>
                    <div class="row">
                        @if($account)
                        <div class="col-12 col-sm-12">
                            <div class="account-card account-card-primary text-white rounded mb-4 mb-lg-0">
                                <div class="row no-gutters">
                                    <div class="col-3 d-flex justify-content-center p-3">
                                        <div class="my-auto text-center text-13"> <i class="fas fa-university"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 border-left">
                                        <div class="py-4 my-2 pl-4">
                                            <p class="text-4 font-weight-500 mb-1">{{ $account->bank_name }}</p>
                                            <p class="text-4 opacity-9 mb-1">{{ $account->account_number }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-card-overlay rounded"> <a href="#"
                                        data-target="#bank-account-details" data-toggle="modal"
                                        class="text-light btn-link mx-2"><span class="mr-1"><i
                                                class="fas fa-share"></i></span>More Details</a>
                                    <a href="#" class="text-light btn-link mx-2"><span class="mr-1"><i
                                                class="fas fa-minus-circle"></i></span>Delete</a> </div>
                            </div>
                        </div>
                        <!-- Edit Bank Account Details Modal
          ======================================== -->
                        <div id="bank-account-details" class="modal fade" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row no-gutters">
                                            <div
                                                class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                                                <div class="my-auto text-center">
                                                    <div class="text-17 text-white mb-3"><i
                                                            class="fas fa-university"></i></div>
                                                    <h3 class="text-6 text-white my-3">{{ $account->bank_name }}</h3>
                                                    <div class="text-4 text-white my-4">{{ $account->account_number }} |
                                                        NGN
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <h5 class="text-5 font-weight-400 m-3">Bank Account
                                                    Details
                                                    <button type="button" class="close font-weight-400"
                                                        data-dismiss="modal" aria-label="Close"> <span
                                                            aria-hidden="true">&times;</span> </button>
                                                </h5>
                                                <hr>
                                                <div class="px-3">
                                                    <ul class="list-unstyled">
                                                        <li class="font-weight-500">Bank Name:</li>
                                                        <li class="text-muted">{{ $account->bank_name }}</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="font-weight-500">Account Name:</li>
                                                        <li class="text-muted">{{ $account->account_name }}</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="font-weight-500">Account Number:</li>
                                                        <li class="text-muted">{{ $account->account_number }}</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="font-weight-500">Bank Country:</li>
                                                        <li class="text-muted">{{ $account->country }}</li>
                                                    </ul>
                                                    <p><a href="#"
                                                            class="btn btn-sm btn-outline-warning btn-block shadow-none"><span
                                                                class="mr-1"><i class="fas fa-pencil"></i></span>Edit
                                                            Account</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <a href="" data-target="#add-new-bank-account" data-toggle="modal"
                                class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0">
                                <p class="w-100 text-center line-height-4 m-0"> <span class="text-3"><i
                                            class="fas fa-plus-circle"></i></span> <span
                                        class="d-block text-body text-3">Add New Bank Account</span> </p>
                            </a>
                        </div>
                        <!-- Add New Bank Account Details Modal
          ======================================== -->
                        <div id="add-new-bank-account" class="modal fade" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-400">Add bank account</h5>
                                        <button type="button" class="close font-weight-400" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form id="addbankaccount" method="post"
                                            action="{{ url('bank-accounts/save-bank-account') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputCountry">Bank Country</label>
                                                <select class="custom-select" readonly name="country" id="inputCountry"
                                                    name="country_id">
                                                    <option value="NG" selected>Nigeria</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="bankName">Bank Name</label>
                                                @isset($error)
                                                <small class="text-danger text-center">{{ $error }}</small>
                                                @endisset
                                                <select class="custom-select" id="account_bank" name="account_bank">
                                                    <option value='' selected disabled>Select Bank Name</option>
                                                    @isset($banks)
                                                    @foreach($banks->data as $bank)
                                                    <option value="{{ $bank->code }}" data-name="{{ $bank->name }}">
                                                        {{ $bank->name }}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>
                                                <input type="hidden" id="bank_name" name="bank_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="accountName">Account Name</label>
                                                <input type="text" class="form-control" data-bv-field="accountName"
                                                    id="accountName" name="account_name" required value=""
                                                    placeholder="e.g. Smith Rhodes">
                                            </div>
                                            <div class="form-group">
                                                <label for="accountNumber">Account Number</label>
                                                <input type="number" step='1' class="form-control"
                                                    data-bv-field="accountNumber" id="accountNumber"
                                                    name="account_number" required value=""
                                                    placeholder="e.g. 12346678900001">
                                            </div>
                                            <div class="form-check custom-control custom-checkbox mb-3">
                                                <input id="confirm" name="confirm" class="custom-control-input"
                                                    type="checkbox">
                                                <label class="custom-control-label" for="confirm">I confirm the bank
                                                    account
                                                    details above are valid</label>
                                            </div>
                                            <button class="btn btn-primary btn-block" id="save-account" type="submit"
                                                disabled>Add Bank
                                                Account</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bank Accounts End -->
                        @endif
                    </div>
                </div>
            </div>
            <!-- Middle Panel End -->
        </div>
    </div>
</div>
<!-- Content end -->
@endsection
