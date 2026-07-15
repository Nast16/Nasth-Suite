<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cashbook;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total saldo dari modul Cashbook
        $totalIncome = Cashbook::where('type', 'income')->sum('amount');
        $totalExpense = Cashbook::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        // 2. Hitung total jenis produk dari modul Product
        $totalProducts = Product::count();

        // 3. Hitung jumlah tugas yang belum diselesaikan dari modul Task
        $pendingTasks = Task::where('is_completed', false)->count();

        // Lempar semua data ringkasan ke view dashboard
        return view('dashboard', compact('currentBalance', 'totalProducts', 'pendingTasks'));
    }
}