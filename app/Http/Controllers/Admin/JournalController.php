<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JournalAdmin;

class JournalController extends Controller
{
    public function index()
    {
        $journaux = JournalAdmin::with('admin')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        $stats = [
            'total'        => JournalAdmin::count(),
            'consultation' => JournalAdmin::where('action', 'consultation')->count(),
            'relation'     => JournalAdmin::where('action', 'relation')->count(),
            'notification' => JournalAdmin::where('action', 'notification')->count(),
        ];

        return view('admin.journal', compact('journaux', 'stats'));
    }
}