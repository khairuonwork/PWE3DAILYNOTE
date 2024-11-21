<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostLibrary extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch
        $libraries = Library::where('user_id', Auth::id())->get();
        return view('library', compact('libraries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);

        // Store
        $imagePath = $request->file('image')->store('library', 'public');

        Library::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'notes' => $request->notes,
            'images' => $imagePath,
        ]);

        return redirect()->route('library.index')->with('success', 'Item added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $libraryItem = Library::where('user_id', Auth::id())->findOrFail($id);
        $libraries = Library::where('user_id', Auth::id())->get();

        return view('library', compact('libraryItem', 'libraries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['required', 'string'],
            'image' => ['nullable', 'image'],
        ]);

        $libraryItem = Library::where('user_id', Auth::id())->findOrFail($id);

        // Update image
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($libraryItem->images) {
                Storage::disk('public')->delete($libraryItem->images);
            }

            // Store
            $imagePath = $request->file('image')->store('library', 'public');
            $libraryItem->images = $imagePath;
        }

        // Update
        $libraryItem->update([
            'title' => $request->title,
            'notes' => $request->notes,
        ]);

        return redirect()->route('library.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libraryItem = Library::where('user_id', Auth::id())->findOrFail($id);

        // Delete
        if ($libraryItem->images) {
            Storage::disk('public')->delete($libraryItem->images);
        }

        $libraryItem->delete();

        return redirect()->route('library.index')->with('success', 'Item deleted successfully.');
    }
}
