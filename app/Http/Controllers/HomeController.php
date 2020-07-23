<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Events\NewUserVerifiesEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $wallet = Auth::user()->wallet;

        if (!$wallet) {
            # code...
            event(new NewUserVerifiesEmail($request->user()));
        }

        $transactions = Transaction::where('user_id', Auth::user()->uuid)->latest()->get()->take(7);

        return view('dashboard', ['transactions' => $transactions]);
    }
}