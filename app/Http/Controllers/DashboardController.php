<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cashbook;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Organization;

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

        $organization = auth()->user()->organization; 
        return view('dashboard', compact('currentBalance', 'totalProducts', 'pendingTasks', 'organization')); 
    }

    public function settings()
    {
        // Ambil data organisasi dari user yang sedang login
        $organization = auth()->user()->organization;
        return view('settings', compact('organization'));
    }

    public function updateSettings(Request $request)
    {
        $organization = auth()->user()->organization;

        // Jika checkbox dicentang maka nilainya true, jika tidak dicentang otomatis false
        $organization->update([
            'has_inventory' => $request->has('has_inventory'),
            'has_cashbook' => $request->has('has_cashbook'),
            'has_tasks' => $request->has('has_tasks'),
        ]);

        return redirect('/settings')->with('success', 'Konfigurasi modul berhasil diperbarui!');
    }
}