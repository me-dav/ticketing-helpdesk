<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Daftar tiket milik user login
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    // Form buat tiket baru
    public function create()
    {
        return view('tickets.create');
    }

    // Simpan tiket baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Hardware,Software,Jaringan',
        ]);

        auth()->user()->tickets()->create($request->only('title', 'description', 'category'));

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat!');
    }

    // Detail tiket
    public function show(Ticket $ticket)
    {
        // Pastikan user cuma bisa lihat tiketnya sendiri
        abort_if($ticket->user_id !== auth()->id(), 403);

        return view('tickets.show', compact('ticket'));
    }
}