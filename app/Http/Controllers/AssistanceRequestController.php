<?php

namespace App\Http\Controllers;

use App\Models\AssistanceRequest; // <--- PASTIKAN BARIS INI ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceRequestController extends Controller
{
    // Menampilkan halaman form pengajuan & riwayat user
    public function index()
    {
        // Mengambil daftar permohonan bantuan milik user yang sedang login
        $requests = AssistanceRequest::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('user.assistance.index', compact('requests'));
    }

    // Menampilkan halaman form pembuatan bantuan
    public function create()
    {
        return view('user.assistance.create');
    }

    // Menyimpan pengajuan bantuan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string',
            'location'    => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assistance_images', 'public');
        }

        AssistanceRequest::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'location'    => $request->location,
            'phone'       => $request->phone,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => 'pending',
        ]);

        return redirect()->route('assistance.index')->with('success', 'Permohonan bantuan berhasil diajukan! Menunggu verifikasi admin.');
    }
}