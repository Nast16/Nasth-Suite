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
        // Ambil ID organisasi dari user yang sedang login saat ini
        $userOrgId = auth()->user()->organization_id;

        // 1. Hitung total saldo HANYA untuk organisasi user tersebut
        $totalIncome = Cashbook::where('organization_id', $userOrgId)->where('type', 'income')->sum('amount');
        $totalExpense = Cashbook::where('organization_id', $userOrgId)->where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;

        // 2. Hitung total jenis produk HANYA untuk organisasi user tersebut
        $totalProducts = Product::where('organization_id', $userOrgId)->count();

        // 3. Hitung jumlah tugas menggantung HANYA untuk organisasi user tersebut
        $pendingTasks = Task::where('organization_id', $userOrgId)->where('is_completed', false)->count();

        return view('dashboard', compact('currentBalance', 'totalProducts', 'pendingTasks'));
    }
}