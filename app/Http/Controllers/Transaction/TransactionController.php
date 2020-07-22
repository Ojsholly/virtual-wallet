<?php

namespace App\Http\Controllers\Transaction;

use App\User;
use App\Wallet;
use App\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\WalletCreditValidated;
use Illuminate\Support\Facades\Event;
use App\Events\WalletCreditFailedValidation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function transfer()
    {
        $users = User::where('email', '!=', Auth::user()->email)->get();

        return view('transactions.transfer', ['users' => $users]);
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

    public function confirm(Request $request)
    {
        $user = new User();

        $recipient = $user->find_by_email($request->recipient_email);

        $transaction = $request->all();

        $transaction = (object) $transaction;

        return view('transactions.confirmation', ['transaction' => $transaction, 'recipient' => $recipient]);
    }

    public function transfer_money(Request $request)
    {
        if ($request->ajax()) {
            # code...

            $recipient_uuid = $request->recipient_uuid;
            $recipient = $request->recipient;
            $amount = $request->amount;
            $narration = $request->narration;
            $data = (object) ['recipient' => $recipient, 'recipient_uuid' => $recipient_uuid, 'amount' => $amount, 'narration' => $narration];

            $balance = Auth::user()->wallet->balance;

            $recipient_balance = User::findByUUID($recipient_uuid)->wallet->balance;

            $transfer = 0;

            if ($balance >= $amount) {
                # code...
                DB::transaction(function () use ($balance, $recipient_balance, $data, &$transfer) {

                    $debit = Wallet::where('user_id', Auth::user()->uuid)->update([
                        'balance' => $balance - $data->amount
                    ]);

                    if ($debit) {
                        # code...
                        $credit = Wallet::where('user_id', $data->recipient_uuid)->update([
                            'balance' => $recipient_balance + $data->amount
                        ]);

                        if ($credit) {
                            # code...
                            $transfer = 1;

                            return $transfer;
                        }

                        throw new ModelNotFoundException('Transfer Failed.');
                    }

                    throw new ModelNotFoundException('Error Transferring Money.');
                });

                if ($transfer) {
                    # code..

                    return response()->json(["status" => "1", "msg" => "Transfer Completed Successfully."]);
                }

                return response()->json(["status" => "0", "msg" => "Error completing Transfer. Please try again later."]);
            }

            return response()->json(["status" => "0", "msg" => "Insufficient Wallet Balance"]);
        }
    }
}