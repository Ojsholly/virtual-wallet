@extends('layouts.layout')

@section('title', 'Confirm Withdrawal')

@section('content')
<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <h2 class="font-weight-400 text-center mt-3 mb-4">Withdraw Money</h2>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <!-- Withdraw Money Confirm
          ============================================= -->
                <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
                    <p class="text-4 text-center alert alert-info">Confirm Withdrawal<br>

                        <span
                            class="font-weight-500">{{ $data->account->bank_name." - ".$data->account->account_number }}</span>
                    </p>
                    <p class="mb-2 mt-4">Amount to Withdraw <span
                            class="text-3 float-right">&#8358;{{ $data->amount }}</span>
                    </p>
                    <hr>
                    <form id="form-withdraw-money-confirm">
                        <input type="hidden" id="account_number" value="{{ $data->account->account_number }}">
                        <input type="hidden" id="account_bank" value="{{ $data->account->account_bank }}">
                        <input type="hidden" id="amount" value="{{ $data->amount }}">
                        <input type="hidden" id="account_uuid" value="{{ $data->account->uuid }}">
                        <input type="hidden" id="account_name" value="{{ $data->account->account_name }}">
                        <button class="btn btn-primary btn-block" id="confirm-withdrawal">Withdraw Money</button>
                    </form>
                </div>
                <!-- Withdraw Money Confirm end -->
            </div>
        </div>
    </div>
</div>
<!-- Content end -->
@include('layouts.partials.footer')

@endsection
