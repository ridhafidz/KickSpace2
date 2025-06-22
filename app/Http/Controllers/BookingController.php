<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Venue;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'venue', 'event')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $events = Event::all();
        $venues = Venue::all();
        return view('bookings.create', compact('events', 'venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $venue = Venue::findOrFail($request->venue_id);
        $event = Event::findOrFail($request->event_id);

        $start = Carbon::parse($request->date . ' ' . $request->start_time);
        $end = Carbon::parse($request->date . ' ' . $request->end_time);

        if ($start->greaterThanOrEqualTo($end)) {
            return back()->withErrors(['end_time' => 'End time must be after start time.'])->withInput();
        }

        $conflict = Booking::where('venue_id', $request->venue_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->where('start_time', '>=', $start->format('H:i:s'))
                      ->where('start_time', '<', $end->format('H:i:s'));
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('end_time', '>', $start->format('H:i:s'))
                      ->where('end_time', '<=', $end->format('H:i:s'));
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start_time', '<=', $start->format('H:i:s'))
                      ->where('end_time', '>=', $end->format('H:i:s'));
                });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'This venue is already booked during the selected time.'])->withInput();
        }

        // --- PERBAIKAN FINAL ---
        $duration_in_minutes = $end->diffInMinutes($start);
        // Gunakan abs() untuk memastikan durasi selalu positif
        $duration_in_hours = abs($duration_in_minutes / 60);

        // Gunakan abs() pada harga untuk keamanan ekstra dan atasi nilai null
        $price_per_hour = abs($venue->price_per_hour ?? 0);
        $registration_fee = abs($event->registration_fee ?? 0);

        $total_price = ($duration_in_hours * $price_per_hour) + $registration_fee;

        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'date' => $request->date,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'total_price' => $total_price,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $events = Event::all();
        $venues = Venue::all();
        return view('bookings.edit', compact('booking', 'events', 'venues'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $venue = Venue::findOrFail($request->venue_id);
        $event = Event::findOrFail($request->event_id);

        $start = Carbon::parse($request->date . ' ' . $request->start_time);
        $end = Carbon::parse($request->date . ' ' . $request->end_time);

        if ($start->greaterThanOrEqualTo($end)) {
            return back()->withErrors(['end_time' => 'End time must be after start time.'])->withInput();
        }

        $conflict = Booking::where('id', '!=', $booking->id)
            ->where('venue_id', $request->venue_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->where('start_time', '>=', $start->format('H:i:s'))
                      ->where('start_time', '<', $end->format('H:i:s'));
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('end_time', '>', $start->format('H:i:s'))
                      ->where('end_time', '<=', $end->format('H:i:s'));
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start_time', '<=', $start->format('H:i:s'))
                      ->where('end_time', '>=', $end->format('H:i:s'));
                });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'This venue is already booked during the selected time.'])->withInput();
        }

        // --- PERBAIKAN FINAL ---
        $duration_in_minutes = $end->diffInMinutes($start);
        // Gunakan abs() untuk memastikan durasi selalu positif
        $duration_in_hours = abs($duration_in_minutes / 60);

        // Gunakan abs() pada harga untuk keamanan ekstra dan atasi nilai null
        $price_per_hour = abs($venue->price_per_hour ?? 0);
        $registration_fee = abs($event->registration_fee ?? 0);

        $total_price = ($duration_in_hours * $price_per_hour) + $registration_fee;

        $booking->update([
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'date' => $request->date,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'total_price' => $total_price,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted.');
    }
}
