<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::query()
            ->orderByDesc('transaction_datetime')
            ->take(100)
            ->get();

        $last7Days = DB::select('
            SELECT
                t.transaction_datetime,
                SUM(CASE WHEN t.transaction_type = "income" THEN t.amount ELSE 0 END) total_income_amount,
                SUM(CASE WHEN t.transaction_type = "expense" THEN t.amount ELSE 0 END) total_expense_amount
            FROM
                transactions as t
            GROUP BY
                t.transaction_datetime
            HAVING
                t.transaction_datetime
                BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY)
                AND NOW()
            ORDER BY
                t.transaction_datetime DESC
            LIMIT
                0, 6;
        ');

        $last4Months = DB::select('
            SELECT
                month(t.transaction_datetime) as transaction_month,
                year(t.transaction_datetime) as transaction_year,
                SUM(CASE WHEN t.transaction_type = "income" THEN t.amount ELSE 0 END) total_income_amount,
                SUM(CASE WHEN t.transaction_type = "expense" THEN t.amount ELSE 0 END) total_expense_amount
            FROM
                transactions as t
            GROUP BY
            transaction_year, transaction_month
            HAVING
                STR_TO_DATE(concat(transaction_year, "-", transaction_month, "-1"), "%Y-%m-%d")
                BETWEEN DATE_SUB(NOW(), INTERVAL 4 MONTH)
                AND NOW()
            ORDER BY
                t.transaction_datetime DESC
            LIMIT
                0, 3;
        ');

        return view('report.index', [
            'transactions' => $transactions,
            'last7Days'=> $last7Days,
            'last4Months'=> $last4Months
        ]);
    }
}
