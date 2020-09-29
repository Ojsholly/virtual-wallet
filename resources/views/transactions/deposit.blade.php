@extends('layouts.layout')

@section('title', 'Deposit')

@section('content')

<!-- Secondary menu
  ============================================= -->
<div class="bg-white">
    <div class="container d-flex justify-content-center">
        <ul class="nav secondary-nav alternate">
            <li class="nav-item"> <a class="nav-link active" href="{{ url('transactions/deposit') }}">Deposit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/withdraw') }}">Withdraw</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/transfer') }}">Transfer</a></li>
        </ul>
    </div>
</div>
<!-- Secondary menu end -->

<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <h2 class="font-weight-400 text-center mt-3 mb-4">Deposit Money</h2>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">

                    <!-- Deposit Money Form
            ============================================= -->
                    <form id="form-send-money">
                        <div class="form-group">
                            <label for="youSend">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text">&#8358;</span> </div>
                                <input type="text" class="form-control" data-bv-field="youSend" id="deposit-amount"
                                    name="amount" placeholder="Enter Amount">
                                <div class="input-group-append"> <span class="input-group-text p-0">
                                        <select id="youSendCurrency" data-style="custom-select bg-transparent border-0"
                                            data-container="body" data-live-search="true"
                                            class="selectpicker form-control bg-transparent" required="">
                                            <optgroup label="Popular Currency">
                                                <option data-icon="currency-flag currency-flag-ngn mr-1"
                                                    data-subtext="Nigerian naira" value="">NGN</option>
                                            </optgroup>
                                            <option value="" data-divider="true">divider</option>
                                            <optgroup label="Other Currency">
                                                <option data-icon="currency-flag currency-flag-ngn mr-1"
                                                    data-subtext="Nigerian naira" value="">NGN</option>
                                            </optgroup>
                                        </select>
                                    </span> </div>
                            </div>
                            <small><b>Minimun of &#8358;1000</b></small>
                        </div>
                        <p class="text-muted mt-4">Transactions fees <span
                                class="float-right d-flex align-items-center"><del>100.00 NGN</del> <span
                                    class="bg-success text-1 text-white font-weight-500 rounded d-inline-block px-2 line-height-4 ml-2">Free</span></span>
                        </p>
                        <hr>
                        <p class="font-weight-500">You'll deposit <span class="text-3 float-right"
                                id="deposit-confirmation"></span>
                        </p>
                        <button id="payment-btn" class="btn btn-primary btn-block" disabled>Continue</button>
                    </form>
                    <!-- Deposit Money Form end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content end -->

@include('layouts.partials.footer')

<script src="https://checkout.flutterwave.com/v3.js"></script>

@endsection
