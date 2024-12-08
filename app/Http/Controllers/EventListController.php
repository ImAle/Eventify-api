<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventListController extends Controller
{
    public function index() {

        // Obtiene todos los eventos que existan
        $events = Events::all();
        return view('event.event_list', compact('events'));
    }
}
