<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Event;

class FullCalendarService
{
    public function events(Request $request)
    {
        $data = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['eventId as id', 'title', 'start', 'end']);
        return response()->json($data);
    }

    public function add(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);
        return response()->json($event);
    }

    public function update(Request $request)
    {
        // Validar datos
        $validatedData = $request->validate([
            'eventId' => 'required|exists:events,eventId',
            'title' => 'required|string|max:100',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        // Buscar y actualizar evento
        $event = Event::find($validatedData['eventId']);
        if ($event) {
            $event->update([
                'title' => $validatedData['title'],
                'start' => $validatedData['start'],
                'end' => $validatedData['end'],
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Evento no encontrado.']);

        // $event = Event::find($request->eventId);
        // if ($event) {
        //     $event->update([
        //         'title' => $request->title,
        //         'start' => $request->start,
        //         'end' => $request->end,
        //     ]);
        //     return response()->json(['success' => true]);
        // }
        // return response()->json(['success' => false, 'message' => 'Evento no encontrado.']);

        // $event = Event::find($request->eventId)->update([
        //     'title' => $request->title,
        //     'start' => $request->start,
        //     'end' => $request->end,
        // ]);        
        // return response()->json($event);

    }

    public function destroy($eventId)
    {
        $event = Event::find($eventId);
        if ($event) {
            $event->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Evento no encontrado.']);
    }
}
