<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Venue;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $start = \Carbon\Carbon::parse($request->start_time);
        $end = \Carbon\Carbon::parse($request->end_time);
        $duration = $end->diffInHours($start);

        $total_price = ($duration * $venue->price_per_hour) + $event->registration_fee;

        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
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

        $start = \Carbon\Carbon::parse($request->start_time);
        $end = \Carbon\Carbon::parse($request->end_time);
        $duration = $end->diffInHours($start);

        $total_price = ($duration * $venue->price_per_hour) + $event->registration_fee;

        $booking->update([
            'event_id' => $request->event_id,
            'venue_id' => $request->venue_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
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
