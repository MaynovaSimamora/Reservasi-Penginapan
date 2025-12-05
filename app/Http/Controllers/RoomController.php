<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        // view index admin kamar
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'type'            => 'required|in:standard,deluxe,suite',
            'description'     => 'nullable|string',
            'capacity'        => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'thumbnail'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name','location','type','description','capacity','price_per_night');
        $data['slug'] = Str::slug($request->name).'-'.Str::random(5);
        $data['is_active'] = true;

        // SIMPAN GAMBAR
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('rooms', 'public'); // storage/app/public/rooms/xxx.jpg
            $data['thumbnail'] = 'storage/'.$path; // disimpan: storage/rooms/xxx.jpg
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success','Kamar berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'type'            => 'required|in:standard,deluxe,suite',
            'description'     => 'nullable|string',
            'capacity'        => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'thumbnail'       => 'nullable|image|max:2048',
            'is_active'       => 'nullable|boolean',
        ]);

        $data = $request->only('name','location','type','description','capacity','price_per_night');
        $data['is_active'] = $request->boolean('is_active');

        // UPDATE GAMBAR (jika diisi)
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('rooms', 'public');
            $data['thumbnail'] = 'storage/'.$path;
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success','Kamar berhasil diupdate.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')
            ->with('success','Kamar berhasil dihapus.');
    }
}
