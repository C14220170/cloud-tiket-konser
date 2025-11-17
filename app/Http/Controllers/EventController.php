<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function home()
    {
         $featured = Event::latest()->take(3)->get();
        return view('home', compact('featured'));
    }

    public function index()
    {
        $events = Event::orderBy('start_at', 'asc')->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('ticketTypes');
        return view('events.show', compact('event'));
    }
}