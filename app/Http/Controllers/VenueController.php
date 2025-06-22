<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(Request $request)
    {
        // --- VALIDASI DIPERBARUI DENGAN PESAN KUSTOM ---
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|min:5|max:5120',
            'price_per_hour' => 'required|numeric|min:50000|max:150000',
        ], [
            'price_per_hour.min' => 'Harga per jam minimal adalah Rp 50.000.',
            'price_per_hour.max' => 'Harga per jam maksimal adalah Rp 150.000.',
            'image.min' => 'Ukuran gambar minimal adalah 5 KB.',
            'image.max' => 'Ukuran gambar maksimal adalah 5 MB.',
        ]);

        $data = $request->only(['name', 'price_per_hour']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('venues', 'public');
        }

        Venue::create($data);

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    public function edit(Venue $venue)
    {
        return view('venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        // --- VALIDASI DIPERBARUI DENGAN PESAN KUSTOM ---
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|min:5|max:5120',
            'price_per_hour' => 'required|numeric|min:50000|max:150000',
        ], [
            'price_per_hour.min' => 'Harga per jam minimal adalah Rp 50.000.',
            'price_per_hour.max' => 'Harga per jam maksimal adalah Rp 150.000.',
            'image.min' => 'Ukuran gambar minimal adalah 5 KB.',
            'image.max' => 'Ukuran gambar maksimal adalah 5 MB.',
        ]);

        $data = $request->only(['name', 'price_per_hour']);

        if ($request->hasFile('image')) {
            if ($venue->image) {
                Storage::disk('public')->delete($venue->image);
            }
            $data['image'] = $request->file('image')->store('venues', 'public');
        }

        $venue->update($data);

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        if ($venue->image) {
            Storage::disk('public')->delete($venue->image);
        }

        $venue->delete();

        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
    }
}
