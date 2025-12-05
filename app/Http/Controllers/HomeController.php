<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing(Request $request)
    {
        $query = Room::where('is_active', true);

        if ($request->filled('location')) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('min_price')) {
            $query->where('price_per_night', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        $rooms = $query->orderBy('price_per_night')->get();

        return view('landing', compact('rooms'));
    }

    public function showRoom(Room $room)
    {
        $room->load('images');
        return view('rooms.show', compact('room'));
    }
}
