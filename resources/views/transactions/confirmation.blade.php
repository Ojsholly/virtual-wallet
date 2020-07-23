@extends('layouts.layout')

@section('title', 'Confirm Transfer')

@section('content')

<!-- Content
  ============================================= -->
<div id="content" class="py-4">
    <div class="container">
        <h2 class="font-weight-400 text-center mt-3">Confirm Transfer</h2>
        <p class="text-4 text-center mb-4"><span class="font-weight-500">Kindly confirm the recipient and details of
                your impending transaction.</span>
        </p>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">

                    <!-- Send Money Confirm
            ============================================= -->
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="description">Recipient</label>
                            <input readonly class="form-control" type="text"
                                value="{{ $recipient->first_name." ".$recipient->last_name }}" id="recipient">
                            <input id="recipient_uuid" type="hidden" name="recipient_uuid"
                                value="{{ $recipient->uuid }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">Amount</label>
                            <input readonly class="form-control" id="amount" type="text" name="amount"
                                value="{{ $transaction->amount }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">Narration</label>
                            <textarea readonly class="form-control" name="narration"
                                id="narration">{{ $transaction->narration }}</textarea>
                        </div>
                        <hr>
                        <a class="btn btn-secondary btn-block" href="{{ url()->previous() }}">Go Back</a>
                        <button class="btn btn-primary btn-block" id="confirm-transfer-btn">Send Money</button>
                    </form>
                    <!-- Send Money Confirm end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content end -->

@include('layouts.partials.footer')

@endsection
