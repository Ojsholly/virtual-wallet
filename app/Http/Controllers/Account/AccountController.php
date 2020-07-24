<?php

namespace App\Http\Controllers\Account;

use App\Account;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;


class AccountController extends Controller
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
        $account = Auth::user()->bank_account;

        $fetch_banks = $this->fetch_banks('NG');

        $fetch_banks = (object) $fetch_banks;

        return view('profile.bank-accounts', ['account' => $account, 'fetch_banks' => $fetch_banks]);
    }


    protected function validator($request)
    {
        return Validator::make($request, [
            'remember' => ['required'],
            'country' => ['required', 'string'],
            'account_bank' => ['required', 'numeric'],
            'account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'account_number' => ['required', 'string']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function fetch_banks($country)
    {
        $client = new Client();
        $base_url = "https://api.flutterwave.com/v3/banks/" . $country;

        $token = env('RAVE_TEST_SECRET_KEY');

        $headers = [
            'Content-Type'        => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        try {

            $request = $client->get($base_url, [
                'headers' => $headers
            ]);

            $list = $request->getBody()->getContents();

            return ['status' => $request->getStatusCode(), 'list' => $list];
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $message = json_decode($e->getResponse()->getBody());
                $status_code = $e->getResponse()->getStatusCode();
                return ['status' => $status_code, 'error' => $message];
            }
        } catch (ConnectException $e) {
            return ['status' => 400, 'error' => 'Poor Network Connection. System unable to fetch supported banks.'];
        } catch (RequestException $e) {
            return ['status' => 400, 'error' => 'Request timeout. Fetching of supported banks failed.'];
        }
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

        $this->validator($request->all());

        $request->input('user_id', Auth::user()->uuid);

        $request->merge(['user_id' => auth()->user()->uuid]);

        $create_account = Account::updateOrCreate(['user_id' => Auth::user()->uuid], $request->except('confirm'));

        if ($create_account) {
            # code...
            return redirect()->back()->with('success', 'Bank Account Successfully Saved.');
        }

        return redirect()->back()->with('fail', 'Error saving bank account. Please try again later.');
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