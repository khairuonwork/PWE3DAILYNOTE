<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCatatan extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Display all notes for the authenticated user
        $notes = Catatan::where('user_id', Auth::id())->get();
        return view('catatan', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('catatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string'],
            'status' => ['required', 'in:Pending,Progress,Completed'], 
        ]);

        Catatan::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->route('notes')->with('success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $note = Catatan::findOrFail($id);
        $notes = Catatan::where('user_id', Auth::id())->get();
        return view('catatan', compact('note', 'notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string'],
            'status' => ['required', 'in:Pending,Progress,Completed'], 
        ]);
        $note = Catatan::findOrFail($id);
        $note->update([
            'title' => $request->title,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->route('notes')->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $note = Catatan::findOrFail($id);
        $note->delete();
        return redirect()->route('notes')->with('success', 'Note deleted successfully.');
    }
    
}
