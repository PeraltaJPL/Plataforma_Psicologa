<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FullCalendarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class FullCalendarController extends Controller
{
    protected $fullCalendarService;

    public function __construct(FullCalendarService $fullCalendarService)
    {
        $this->fullCalendarService = $fullCalendarService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('calendario.index', compact('user'));
    }

    public function events(Request $request)
    {
        return $this->fullCalendarService->events($request);
    }

    public function add(Request $request): JsonResponse
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
        ]);
    
        return response()->json(['success' => true, 'id' => $event->eventId]);
        // return $this->fullCalendarService->add($request);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->fullCalendarService->update($request->eventId);
    }

    public function destroy(Request $request)
    {
        return $this->fullCalendarService->destroy($request->eventId);
    }

}
