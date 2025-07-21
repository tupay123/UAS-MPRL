<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->get();
        return view('dashboard.ebook.index', compact('ebooks'));
    }

    public function create()
    {
        return view('dashboard.ebook.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'required|file|mimes:pdf',
            'thumbnail' => 'nullable|image|mimes:jpg,png',
            'price' => 'required|integer',
            'is_published' => 'required|boolean',
        ]);

        // Simpan file PDF ke storage privat (default 'local' disk)
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('ebooks'); // disimpan di storage/app/ebooks
        }

        // Simpan thumbnail ke storage publik (boleh diakses bebas)
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Ebook::create($validated);

        return redirect()->route('dashboard.ebooks.index')->with('success', 'Ebook berhasil ditambahkan');
    }

    public function edit(Ebook $ebook)
    {
        return view('dashboard.ebook.edit', compact('ebook'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|file|mimes:pdf',
            'thumbnail' => 'nullable|image|mimes:jpg,png',
            'price' => 'required|integer',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($ebook->file);
            $validated['file'] = $request->file('file')->store('ebooks');
        }

        if ($request->hasFile('thumbnail')) {
            Storage::delete($ebook->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $ebook->update($validated);

        return redirect()->route('dashboard.ebooks.index')->with('success', 'Ebook berhasil diperbarui');
    }

    public function destroy(Ebook $ebook)
    {
        if ($ebook->file) {
            Storage::delete($ebook->file);
        }

        if ($ebook->thumbnail) {
            Storage::delete($ebook->thumbnail);
        }

        $ebook->delete();

        return redirect()->route('dashboard.ebooks.index')->with('success', 'Ebook berhasil dihapus');
    }

    public function show(Ebook $ebook)
    {
        return view('dashboard.ebook.show', compact('ebook'));
    }


}
