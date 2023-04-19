<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEventAttendee;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date'
        ]);

        $event = new Event();
        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->location = $validated['location'];
        $event->date = $validated['date'];
        $event->user_id = auth()->id();
        $event->save();

        return redirect()->route('events.index');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function register($id)
    {
        $event = Event::findOrFail($id);
        return view('events.register', compact('event'));
    }

    public function storeAttendee(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt('password');
            $user->save();
        }

        $attendee = new UserEventAttendee();
        $attendee->user_id = $user->id;
        $attendee->event_id = $id;
        $attendee->save();

        return redirect()->route('events.show', $id);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date'
        ]);

        $event = Event::findOrFail($id);
        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->location = $validated['location'];
        $event->date = $validated['date'];
        $event->save();

        return redirect()->route('events.show', $id);
    }
}

