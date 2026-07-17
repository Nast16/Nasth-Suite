<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userOrgId = auth()->user()->organization_id;

        // Ambil tugas HANYA untuk organisasi user yang login
        $tasks = Task::where('organization_id', $userOrgId)
                    ->orderBy('is_completed', 'asc')
                    ->latest()
                    ->get();
                    
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        // Tambah tugas baru dengan menyertakan organization_id
        Task::create([
            'organization_id' => auth()->user()->organization_id,
            'title' => $request->title,
            'priority' => $request->priority,
            'is_completed' => false
        ]);

        return redirect('/tasks');
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        
        // Pastikan tugas yang diselesaikan milik organisasi yang sama
        if ($task->organization_id !== auth()->user()->organization_id) {
            abort(403, 'Aksi tidak sah.');
        }

        $task->update([
            'is_completed' => true
        ]);

        return redirect('/tasks');
    }
}