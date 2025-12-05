<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Services\FonnteService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, Room $room)
    {
        $request->validate([
            'check_in'    => 'required|date|after_or_equal:today',
            'check_out'   => 'required|date|after:check_in',
            'guest_count' => 'required|integer|min:1',
            'whatsapp'    => 'required|string',
        ]);

        // Cek bentrok tanggal
        $overlap = Reservation::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($request) {
                $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                  ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['check_in' => 'Tanggal tersebut sudah terisi, silakan pilih tanggal lain.']);
        }

        $days = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));
        if ($days <= 0) $days = 1;

        $total = $days * $room->price_per_night;

        $reservation = Reservation::create([
            'user_id'         => Auth::id(),
            'room_id'         => $room->id,
            'check_in'        => $request->check_in,
            'check_out'       => $request->check_out,
            'guest_count'     => $request->guest_count,
            'status'          => 'pending',
            'total_price'     => $total,
            'whatsapp_target' => $request->whatsapp,
        ]);

        // WA user
        $msgUser = "Halo, pesanan kamar {$room->name} berhasil dibuat.\n".
                   "Check-in: {$reservation->check_in}\n".
                   "Check-out: {$reservation->check_out}\n".
                   "Total: Rp ".number_format($total,0,',','.');
        FonnteService::send($reservation->whatsapp_target, $msgUser);

        // WA admin (3 nomor)
        $msgAdmin = "Booking baru: {$room->name}\n".
                    "Tamu: ".Auth::user()->name."\n".
                    "Tanggal: {$reservation->check_in} - {$reservation->check_out}\n".
                    "Total: Rp ".number_format($total,0,',','.');
        FonnteService::notifyAdmins($msgAdmin);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil dibuat.');
    }

    public function show(Reservation $reservation)
    {
        if (!Auth::check() ||
            (Auth::id() !== $reservation->user_id && Auth::user()->role !== 'admin')) {
            abort(403);
        }

        $reservation->load('room','user');
        return view('reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $request->status]);

        $msg = "Status reservasi kamar {$reservation->room->name} Anda sekarang: {$reservation->status}.";
        FonnteService::send($reservation->whatsapp_target, $msg);

        return back()->with('success','Status reservasi diperbarui.');
    }

    public function myReservations()
    {
        $reservations = Auth::user()
            ->reservations()
            ->with('room')
            ->latest()
            ->get();

        return view('reservations.my', compact('reservations'));
    }

   public function adminIndex()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $reservations = Reservation::with('room','user')->latest()->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        if (!Auth::check() || Auth::id() !== $reservation->user_id) {
            abort(403);
        }
        if ($reservation->status !== 'pending') {
            return back()->withErrors(['status' => 'Reservasi tidak dapat dibatalkan lagi.']);
        }

        $reservation->update(['status' => 'cancelled']);

        $msgUser = "Reservasi kamar {$reservation->room->name} dengan ID #{$reservation->id} telah dibatalkan.";
        FonnteService::send($reservation->whatsapp_target, $msgUser);

        $msgAdmin = "Reservasi dibatalkan: #{$reservation->id} - {$reservation->room->name} oleh {$reservation->user->name}.";
        FonnteService::notifyAdmins($msgAdmin);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }


}
