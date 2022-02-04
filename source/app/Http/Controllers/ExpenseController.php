<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expense.create');
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
            $transaction->transaction_type = 'expense';
            $transaction->note = $request->input('note');
            $transaction->created_by = Auth::id();
            $transaction->updated_by = Auth::id();
            $transaction->save();

            return redirect('expense/create')->with('success', 'create success');
        }
        catch(Exception $e) {
            return redirect('expense/create')->with('error',"operation failed");
        }
    }
}
