<?php

namespace App\Http\Controllers;

use App\Models\Cashbook;
use Illuminate\Http\Request;

class CashbookController extends Controller
{
    public function index()
    {
        // 1. Ambil semua riwayat kas, urutkan dari yang paling baru
        $transactions = Cashbook::latest()->get();

        // 2. Hitung total pemasukan dan pengeluaran
        $totalIncome = Cashbook::where('type', 'income')->sum('amount');
        $totalExpense = Cashbook::where('type', 'expense')->sum('amount');
        
        // 3. Hitung saldo akhir
        $currentBalance = $totalIncome - $totalExpense;

        return view('cashbook.index', compact('transactions', 'totalIncome', 'totalExpense', 'currentBalance'));
    }

    public function store(Request $request)
    {
        // Validasi inputan kas manual
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        // Simpan ke database
        Cashbook::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect('/cashbook');
    }
}