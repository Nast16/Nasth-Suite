<?php

namespace App\Http\Controllers;

use App\Models\Cashbook;
use Illuminate\Http\Request;

class CashbookController extends Controller
{
    public function index()
    {
        $userOrgId = auth()->user()->organization_id;

        // Ambil riwayat kas HANYA untuk organisasi user yang login
        $transactions = Cashbook::where('organization_id', $userOrgId)->latest()->get();

        $totalIncome = Cashbook::where('organization_id', $userOrgId)->where('type', 'income')->sum('amount');
        $totalExpense = Cashbook::where('organization_id', $userOrgId)->where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        return view('cashbook.index', compact('transactions', 'totalIncome', 'totalExpense', 'currentBalance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        // Simpan kas manual dengan menyertakan organization_id
        Cashbook::create([
            'organization_id' => auth()->user()->organization_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect('/cashbook');
    }
}