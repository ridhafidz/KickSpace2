<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        try {
            // --- VALIDASI DIPERBARUI DENGAN PESAN KUSTOM ---
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'registration_fee' => 'required|numeric|min:50000|max:250000',
            ], [
                'registration_fee.min' => 'Biaya registrasi minimal adalah Rp 50.000.',
                'registration_fee.max' => 'Biaya registrasi maksimal adalah Rp 250.000.',
                'name.required' => 'Nama event tidak boleh kosong.',
            ]);

            Event::create($validatedData);

            return redirect()->route('events.index')->with('success', 'Event created successfully.');

        } catch (ValidationException $e) {
            // Cukup kembalikan dengan error dan input, view akan menanganinya
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        try {
            // --- VALIDASI DIPERBARUI DENGAN PESAN KUSTOM ---
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'registration_fee' => 'required|numeric|min:50000|max:250000',
            ], [
                'registration_fee.min' => 'Biaya registrasi minimal adalah Rp 50.000.',
                'registration_fee.max' => 'Biaya registrasi maksimal adalah Rp 250.000.',
                'name.required' => 'Nama event tidak boleh kosong.',
            ]);

            $event->update($validatedData);

            return redirect()->route('events.index')->with('success', 'Event updated successfully.');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
