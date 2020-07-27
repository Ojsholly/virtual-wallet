<?php

namespace App\Http\Controllers\Transaction;

use App\User;
use App\Wallet;
use App\Account;
use App\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\UserTransferSucessFul;
use App\Events\WalletCreditValidated;
use Illuminate\Support\Facades\Event;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use App\Events\WalletCreditFailedValidation;
use App\Events\SuccessfulUserWalletWithdrawal;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transaction::where('user_id', Auth::user()->uuid)->latest()->paginate(15);

        return view('transactions.history', ['transactions' => $transactions]);
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

            $recipient_data = User::where('uuid', $recipient_uuid)->first();

            $data = (object) ['recipient' => $recipient, 'recipient_uuid' => $recipient_uuid, 'amount' => $amount, 'narration' => $narration, 'sender' => Auth::user()->first_name . ' ' . Auth::user()->last_name];

            $balance = Auth::user()->wallet->balance;

            $recipient_balance = User::findByUUID($recipient_uuid)->wallet->balance;

            $transfer = 0;

            if ($balance >= $amount) {
                # code...
                DB::transaction(function () use ($balance, $recipient_balance, &$data, &$transfer) {

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

                    event(new UserTransferSucessFul($recipient_data, $data));

                    return response()->json(["status" => "1", "msg" => "Transfer Completed Successfully."]);
                }

                return response()->json(["status" => "0", "msg" => "Error completing Transfer. Please try again later."]);
            }

            return response()->json(["status" => "0", "msg" => "Insufficient Wallet Balance"]);
        }
    }

    public function Withdraw()
    {
        $account = Auth::user()->bank_account;

        if (!$account) {
            # code...
            $user = Auth::user();
            return redirect()->action('Account\AccountController@index')->with('fail', 'Kindly save your bank account to continue.');
        }

        return view('transactions.withdraw', ['account' => $account]);
    }

    public function confirmation(Request $request)
    {

        $account_uuid = $request->account_uuid;
        $amount = $request->amount;

        $account = Account::findByUuid($account_uuid);

        $data = [
            'amount' => $amount,
            'account' => $account
        ];

        $data = (object) $data;

        return view('transactions.confirm-withdrawal', ['data' => $data]);
    }

    public function withdraw_money(Request $request)
    {
        $account_number = $request->account_number;
        $account_bank = $request->account_bank;
        $account_uuid = $request->account_uuid;
        $account_name = $request->account_name;
        $amount = $request->amount;

        $url = url("transactions/confirm-withdrawal");

        $data = [
            "account_number" => $account_number,
            "account_bank" => $account_bank,
            "amount" => $amount,
            "narration" => env('APP_NAME') . " Wallet Withdrawal",   // Willed be saved as transaction title
            "currency" => "NGN",
            "reference" =>  "_PMCKDU_1VWW-" . mt_rand() . "_PMCKDU_1",
            "beneficiary_name" =>  $account_name,
            "callback_url" => $url
        ];

        $available_balance = Auth::user()->wallet->balance;

        if ($available_balance < $amount) {
            # code...

            return response()->json(['status' => '0', 'msg' => 'Insufficient Wallet Balance.']);
        }

        $process_withdrawal = $this->rave_withdrawal($data);
        $status_code = $process_withdrawal->status_code;

        if ($status_code == 200) {
            # code...
            $response = json_decode($process_withdrawal->response);
            $status = $response->status;
            $message = $response->message;

            if ($status == 'success' && $message == 'Transfer Queued Successfully') {
                # code...

                $transfer_id = $response->data->id;

                $amount_withdrawn = $response->data->amount;

                $bank_name = $response->data->bank_name;

                $account_number = $response->data->account_number;

                $txn_ref = $response->data->narration;

                Wallet::where('user_id', Auth::user()->uuid)->update([
                    'balance' => $available_balance - $amount_withdrawn
                ]);

                event(new SuccessfulUserWalletWithdrawal($response));

                return response()->json(['status' => '1', 'msg' => 'Withdrawal Completed Successfully']);
            }
        }
    }

    private function rave_withdrawal($data)
    {
        $base_url = "https://api.flutterwave.com/v3/transfers";

        $token = env('RAVE_TEST_SECRET_KEY');

        $headers = [
            'Content-Type'        => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $client = new Client();

        try {
            //code...
            $request = $client->post($base_url, [
                'headers' => $headers,
                'json' => $data
            ]);

            $status_code = $request->getStatusCode();

            $response = $request->getBody()->getContents();

            return (object) ['status_code' => $status_code, 'response' =>  $response];
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $message = json_decode($e->getResponse()->getBody());
                $status_code = $e->getResponse()->getStatusCode();
                return (object) ['status' => $status_code, 'error' => $message];
            }
        } catch (ConnectException $e) {
            return (object) ['status' => 400, 'error' => 'Poor Network Connection.'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $message = json_decode($e->getResponse()->getBody());
                $status_code = $e->getResponse()->getStatusCode();
                return (object) ['status' => $status_code, 'error' => $message];
            }
        }
    }
}