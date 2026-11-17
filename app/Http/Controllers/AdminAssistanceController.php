<?php

namespace App\Http\Controllers;

use App\Models\AssistanceRequest;
use Illuminate\Http\Request;

class AdminAssistanceController extends Controller
{
    // Menampilkan seluruh pengajuan bantuan dari semua user
    public function index()
    {
        $requests = AssistanceRequest::with('user')->latest()->get();
        return view('admin.assistance.index', compact('requests'));
    }

    // Mengubah status bantuan (approved / rejected / completed)
    public function updateStatus(Request $request, AssistanceRequest $assistanceRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        $assistanceRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status permohonan bantuan berhasil diperbarui!');
    }
}