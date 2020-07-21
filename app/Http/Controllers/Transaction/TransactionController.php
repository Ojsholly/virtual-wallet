<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\WalletCreditValidated;
use Illuminate\Support\Facades\Event;
use App\Events\WalletCreditFailedValidation;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transactions.transactions-history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $user = Auth::user();

        return view('transactions.deposit');
    }

    protected function validate_rave_transaction(string $transaction_id)
    {
        $client = new Client();

        $base_url = "https://api.flutterwave.com/v3/transactions/" . $transaction_id . "/verify";

        $token = env('RAVE_TEST_SECRET_KEY');

        $headers = [
            'Content-Type'        => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $request = $client->get($base_url, [
            'headers' => $headers
        ]);

        $response = $request->getBody()->getContents();

        $response = json_decode($response);

        $status = $response->status;

        if ($status != 'success') {
            # code...
            return false;
        }

        return $response;
    }

    public function status(Request $request)
    {
        # code...
        $txn_id = $request->transaction_id;
        $amount = $request->amount;
        $txn_ref = $request->tx_ref;

        $transaction = new Transaction();

        $valid_transaction = $this->validate_rave_transaction($txn_id);

        if ($valid_transaction != false) {
            # code...
            $amount_paid = $valid_transaction->data->amount;

            if ($amount_paid >= $amount) {
                # code...

                $existing_transaction = $transaction->existing_transaction($valid_transaction->data->id, $valid_transaction->data->tx_ref);

                if (!$existing_transaction) {
                    # code...

                    event(new WalletCreditValidated($valid_transaction));
                }

                return view('transactions.sucessful-transaction', ['transaction' => $valid_transaction]);
            }

            $existing_transaction = $transaction->existing_transaction($txn_id, $txn_ref);

            if (!$existing_transaction) {
                # code...

                event(new WalletCreditFailedValidation($request->all()));
            }

            return view('transactions.failed-transaction', ['amount' => $amount]);
        }

        $existing_transaction = $transaction->existing_transaction($txn_id, $txn_ref);

        if (!$existing_transaction) {
            # code...

            event(new WalletCreditFailedValidation($request->all()));
        }

        return view('transactions.failed-transaction', ['amount' => $amount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}