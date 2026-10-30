<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'required|string|max:50',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image'] = basename($path);
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'required|string|max:50',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gallery->image) {
                Storage::disk('public')->delete('galleries/' . $gallery->image);
            }
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image'] = basename($path);
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete('galleries/' . $gallery->image);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
