<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Ambil semua tugas, urutkan dari yang belum selesai, lalu yang paling baru
        $tasks = Task::orderBy('is_completed', 'asc')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'title' => $request->title,
            'priority' => $request->priority,
            'is_completed' => false // Tugas baru otomatis berstatus belum selesai
        ]);

        return redirect('/tasks');
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        
        // Ubah status menjadi true (selesai)
        $task->update([
            'is_completed' => true
        ]);

        return redirect('/tasks');
    }
}