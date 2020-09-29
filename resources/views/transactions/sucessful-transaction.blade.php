@extends('layouts.layout')

@section('title', 'Sucessful Wallet Deposit')

@section('content')

<!-- Secondary menu
  ============================================= -->
<div class="bg-white">
    <div class="container d-flex justify-content-center">
        <ul class="nav secondary-nav alternate">
            <li class="nav-item"> <a class="nav-link" href="{{ url('transactions/deposit') }}">Deposit</a></li>
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
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">

                <!-- Deposit Money Success
          ============================================= -->
                <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
                    <div class="text-center my-5">
                        <p class="text-center text-success text-20 line-height-07"><i class="fas fa-check-circle"></i>
                        </p>
                        <p class="text-center text-success text-8 line-height-07">Success!</p>
                        <p class="text-center text-4">Wallet Deposit Sucessful.</p>
                    </div>
                    <p class="text-center text-3 mb-4">You've successfully deposited a sum of <span
                            class="text-4 font-weight-500">&#8358;{{ number_format($transaction->data->amount, 2) }}</span>
                        in your
                        wallet.</p>
                    <small class="text-center text-2 mb-4"><i>This payment was made via
                            <span class="text-4
                                font-weight-300">{{ $transaction->data->payment_type }}</span> on
                            {{ date('Y-m-d H:i:s', strtotime($transaction->data->created_at)) }}</i></small>
                    <a class="btn btn-primary btn-block" href='{{ url('transactions/deposit') }}'>Deposit Money
                        Again</a>
                    <button class="btn btn-link btn-block"><i class="fas fa-print"></i> Print</button>
                </div>
                <!-- Request Money Success end -->
            </div>
        </div>
    </div>
</div>
<!-- Content end -->
@endsection
