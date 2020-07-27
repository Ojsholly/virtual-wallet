@extends('layouts.layout')

@section('title', 'Transactions')

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

                <h2 class="font-weight-400 mb-3">Transactions</h2>

                <div class="bg-light shadow-sm rounded py-4 mb-4">
                    <h3 class="text-5 font-weight-400 d-flex align-items-center px-4 mb-3">All Transactions</h3>
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
                        @foreach($transactions as $transaction)
                        <div class="transaction-item px-4 py-3">
                            <div class="row align-items-center flex-row">
                                <div class="col-2 col-sm-1 text-center"> <span class="d-block text-4
                                        font-weight-300">{{ date('d', strtotime($transaction->created_at)) }}</span>
                                    <span
                                        class="d-block text-1 font-weight-300 text-uppercase">{{ date('M', strtotime($transaction->created_at)) }}</span>
                                </div>
                                <div class="col-2 col-sm-1">
                                    @if($transaction->type == 'Credit')
                                    <span class="d-block text-4
                                        font-weight-300 text-success">{{ $transaction->type }}</span>
                                    @else
                                    <span class="d-block text-4
                                        font-weight-300 text-danger">{{ $transaction->type }}</span>
                                    @endif
                                </div>
                                <div class="col col-sm-6"> <span class="d-block text-4">{{ $transaction->title }}</span>
                                    <span class="text-muted">{{ $transaction->narration }}</span> </div>
                                <div class="col-auto col-sm-1 d-none d-sm-block text-center text-3">
                                    @if($transaction->status == 0)
                                    <span class="text-danger" data-toggle="tooltip" data-original-title="Failed"><i
                                            class="fas fa-times-circle"></i></span>
                                    @elseif($transaction->status == 1)
                                    <span class="text-success" data-toggle="tooltip" data-original-title="Sucessful"><i
                                            class="fas fa-check-circle"></i></span>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-2 text-right text-4"> <span class="text-nowrap">
                                        &#8358;{{ $transaction->amount }}</span>
                                    <span class="text-2 text-uppercase">(NGN)</span> </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- View all Link
            =============================== -->

                        <!-- Pagination
            ============================================= -->

                        <ul class="pagination justify-content-center mt-4 mb-0">
                            {{ $transactions->links() }}
                        </ul>
                        <!-- Paginations end -->

                    </div>
                    <!-- All Transactions End -->
                </div>
                <!-- Middle End -->
            </div>
        </div>
    </div>
    <!-- Content end -->
    @endsection
