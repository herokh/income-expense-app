<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $transaction = new Transaction();
            $transaction->amount = $request->input('amount');
            $transaction->transaction_datetime = $request->input('transaction_datetime');
            $transaction->transaction_type = 'income';
            $transaction->note = $request->input('note');
            $transaction->created_by = Auth::id();
            $transaction->updated_by = Auth::id();
            $transaction->save();

            return redirect('income/create')->with('success', 'create success');
        }
        catch(Exception $e) {
            return redirect('income/create')->with('error',"operation failed");
        }
    }

}
