@extends('layouts.layout')

@section('title', 'Transfer Money')

@section('content')


<!-- Secondary menu
  ============================================= -->
<div class="bg-white">
    <div class="container d-flex justify-content-center">
        <ul class="nav secondary-nav alternate">
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/deposit') }}">Deposit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/withdraw') }}">Withdraw</a></li>
            <li class="nav-item"> <a class="nav-link active" href="{{ url('transactions/transfer') }}">Transfer</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/request') }}">Request</a></li>
        </ul>
    </div>
</div>
<!-- Secondary menu end -->

<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <h2 class="font-weight-400 text-center mt-3">Send Money</h2>
        <p class="text-4 text-center mb-4">Send your money to anyone, anywhere in the world.</p>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
                    <h3 class="text-5 font-weight-400 mb-3">Transaction Details</h3>
                    <!-- Send Money Form
            ============================================= -->
                    <form action="{{ url('transactions/confirmation') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="emailID">Recipient</label>
                            <input type="email" required value="" class="form-control flexdatalist"
                                data-bv-field="emailid" id="recipient-email" name="recipient_email" list="emails"
                                required placeholder="Enter Email Address of Recipient">
                            <datalist id="emails">
                                @foreach($users as $user)
                                <option value="{{ $user->email }}">{{ $user->email }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="youSend">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text">&#8358;</span> </div>
                                <input type="number" min="1000" max="{{ Auth::user()->wallet->balance }}" name="amount"
                                    class="form-control" data-bv-field="youSend" id="transfer-amount" value="1,000"
                                    placeholder="Amount to Send" step="100">
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
                            <small>Minimum amount is &#8358;1000</small>
                        </div>
                        <div class="form-group">
                            <label for="youSend">Narration</label>
                            <div class="input-group">
                                <textarea name="narration" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary btn-block" id="transfer-confirm-btn" disabled>Continue</button>
                    </form>
                    <!-- Send Money Form end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content end -->

@include('layouts.partials.footer')

@endsection
