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
                    <h3 class="text-5 font-weight-400 d-flex align-items-center mb-3">Profile Completeness <span
                            class="bg-light-4 text-success rounded px-2 py-1 font-weight-400 text-2 ml-2">50%</span>
                    </h3>
                    <div class="row profile-completeness">
                        <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                            <div class="border rounded p-3 text-center"> <span
                                    class="d-block text-10 text-light mt-2 mb-3"><i
                                        class="fas fa-mobile-alt"></i></span> <span
                                    class="text-5 d-block text-success mt-4 mb-3"><i
                                        class="fas fa-check-circle"></i></span>
                                <p class="mb-0">Mobile Added</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                            <div class="border rounded p-3 text-center"> <span
                                    class="d-block text-10 text-light mt-2 mb-3"><i class="fas fa-envelope"></i></span>
                                <span class="text-5 d-block text-success mt-4 mb-3"><i
                                        class="fas fa-check-circle"></i></span>
                                <p class="mb-0">Email Added</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4 mb-sm-0">
                            <div class="border rounded p-3 text-center"> <span
                                    class="d-block text-10 text-light mt-2 mb-3"><i
                                        class="fas fa-credit-card"></i></span> <span
                                    class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                                <p class="mb-0"><a class="btn-link stretched-link" href="">Add Card</a></p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="border rounded p-3 text-center"> <span
                                    class="d-block text-10 text-light mt-2 mb-3"><i
                                        class="fas fa-university"></i></span> <span
                                    class="text-5 d-block text-light mt-4 mb-3"><i class="far fa-circle "></i></span>
                                <p class="mb-0"><a class="btn-link stretched-link" href="">Add Bank Account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Completeness End -->

                <!-- Recent Activity
          =============================== -->
                <div class="bg-light shadow-sm rounded py-4 mb-4">
                    <h3 class="text-5 font-weight-400 d-flex align-items-center px-4 mb-3">Recent Transactions</h3>

                    <!-- Title
            =============================== -->
                    <div class="transaction-title py-2 px-4">
                        <div class="row">
                            <div class="col-2 col-sm-1 text-center"><span class="">Date</span></div>
                            <div class="col-2 col-sm-1">Type</div>
                            <div class="col col-sm-6">Narration</div>
                            <div class="col-auto col-sm-1 d-none d-sm-block text-center">Status</div>
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
                        <div class="text-center mt-4"><a href="{{ url('/transactions') }}" class="btn-link text-3">View
                                all<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
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
