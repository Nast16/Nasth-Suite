<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cashbook;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        if (auth()->user()->role !== 'owner') {
            abort(403, 'Hanya Owner yang dapat mengakses halaman pengaturan.');
        }

        // Ambil data organisasi dari user yang sedang login
        $organization = auth()->user()->organization;
        return view('settings', compact('organization'));
    }

    public function updateSettings(Request $request)
    {
        if (auth()->user()->role !== 'owner') {
            abort(403, 'Aksi tidak sah.');
        }
        
        $organization = auth()->user()->organization;

        // Jika checkbox dicentang maka nilainya true, jika tidak dicentang otomatis false
        $organization->update([
            'has_inventory' => $request->has('has_inventory'),
            'has_cashbook' => $request->has('has_cashbook'),
            'has_tasks' => $request->has('has_tasks'),
        ]);

        return redirect('/settings')->with('success', 'Konfigurasi modul berhasil diperbarui!');
    }

        public function employees()
    {
        // Proteksi: Karyawan tidak boleh masuk ke halaman manajemen karyawan
        if (auth()->user()->role !== 'owner') {
            abort(403, 'Hanya Owner yang dapat mengakses halaman ini.');
        }

        $userOrgId = auth()->user()->organization_id;

        // Ambil semua user yang memiliki organization_id yang sama (Karyawan + Owner itu sendiri)
        $employees = User::where('organization_id', $userOrgId)->get();

        return view('employees', compact('employees'));
    }

    public function storeEmployee(Request $request)
    {
        if (auth()->user()->role !== 'owner') {
            abort(403, 'Aksi tidak sah.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Daftarkan karyawan dengan menduplikasi organization_id milik owner yang sedang login
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'organization_id' => auth()->user()->organization_id, // 👈 Kunci Multi-User per Tenant
            'role' => 'employee', // 👈 Set role sebagai employee
        ]);

        return redirect('/employees')->with('success', 'Akun karyawan berhasil ditambahkan!');
    }
}