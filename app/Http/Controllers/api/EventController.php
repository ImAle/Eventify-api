<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Models\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::all();
        return $this->sendResponse($events, "Events retrieved successfully");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return $this->sendError('You must be logged to create an event.', [], 500);
        }

        if ($user->role !== 'o') {
            return $this->sendError('Unauthorized. You must be an organizer to create an event.', [], 403);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors(), 500);

        $event = Events::create([
            'organizer_id' => $user->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'location' => $request['location'],
            'latitude' => $request['latitude'],
            'max_attendees' => $request['max_attendees'],
            'longitude' => $request['longitude'],
            'price' => $request['price'],
            'image_url' => $request['image_url'],
            'deleted' => 0,
        ]);

        if ($request->hasFile('image_url')) {
            // Almacena la imagen en la carpeta "public/event_images" y guarda la ruta
            $imagePath = $request->file('image_url')->store('storage/event_images', 'public');
            $event->image_url = $imagePath;
        } else {
            // Da imagen por defecto
            $imagePath = 'event_images/image_not_found.jpg';
            $event->image_url = $imagePath;
        }

        return $this->sendResponse($event, "Event created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = Events::find($id);

        if (is_null($events)) {
            return $this->sendError('Event not found.');
        }

        return $this->sendResponse($events, 'Events retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $event = Events::findOrFail($id);
            $input = $request->all();

            $user = Auth::user();
            if (!($user->role === 'a' || ($user->role === 'o' && $event->organizer_id === $user->id))) {
                return $this->sendError('Unauthorized. Only the organizer or an admin can update this event.', [], 403);
            }

            // Validar los datos entrantes
            $validator = Validator::make($input, [
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after_or_equal:start_time',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'location' => 'required|string|max:255',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'max_attendees' => 'required|integer|min:1',
            ]);

            if ($validator->fails())
                return $this->sendError('Validation Error.', $validator->errors());

            // Actualizar datos del evento
            $event->organizer_id = Auth::id();
            $event->title = $request->title;
            $event->description = $request->description;
            $event->category_id = $request->category_id;
            $event->start_time = $request->start_time;
            $event->end_time = $request->end_time;
            $event->location = $request->location;
            $event->latitude = $request->latitude;
            $event->longitude = $request->longitude;
            $event->max_attendees = $request->max_attendees;
            $event->price = $request->price;
            $event->deleted = 0;

            // Subir y actualizar imagen si está presente
            if ($request->hasFile('image_url')) {
                $imagePath = $request->file('image_url')->store('storage/event_images', 'public');
                $event->image_url = $imagePath;
            }

            $event->save();

            return $this->sendResponse($event, "Event updated successfully.");
        } catch (\Exception $e) {
            return $this->sendError('Event update failed.', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Events::findOrFail($id);

            $user = Auth::user();
            if (!($user->role === 'a' || ($user->role === 'o' && $event->organizer_id === $user->id))) {
                return $this->sendError('Unauthorized. Only the organizer or an admin can update this event.', [], 403);
            }

            if($event->deleted === 1){
                return $this->sendError('Event deletion failed',["There is no event for this id"]);
            }

            $event->deleted = 1;
            $event->save();

            return $this->sendResponse($event, "Event deleted successfully");
        } catch (\Exception $e) {
            return $this->sendError('Event deletion failed', ['error' => $e->getMessage()], 500);
        }
    }
}
