@extends('layouts.app')

@section('page_title','Admin reservasi')
@section('page_subtitle','Pantau dan ubah status semua reservasi.')

@section('content')
<section>
    @if(session('success'))
        <div style="margin-bottom:12px;padding:8px 12px;border-radius:8px;background:#345c3c;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
        <h2>Daftar reservasi</h2>
        <span style="font-size:13px;color:#b8aa9f;">
            {{ $reservations->total() }} data
        </span>
    </div>

    <table style="width:100%;border-collapse:separate;border-spacing:0 4px;font-size:14px;">
        <thead>
        <tr style="background:#3b2a22;">
            <th style="padding:10px 14px;border-radius:10px 0 0 10px;">ID</th>
            <th style="padding:10px 14px;">Tamu</th>
            <th style="padding:10px 14px;">WA</th>
            <th style="padding:10px 14px;">Kamar</th>
            <th style="padding:10px 14px;">Tanggal</th>
            <th style="padding:10px 14px;">Total</th>
            <th style="padding:10px 14px;">Status</th>
            <th style="padding:10px 14px;border-radius:0 10px 10px 0;text-align:center;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $r)
            <tr style="background:#1c1411;border-radius:10px;box-shadow:0 4px 14px rgba(0,0,0,0.55);">
                <td style="padding:9px 14px;border-top-left-radius:10px;border-bottom-left-radius:10px;">
                    #{{ $r->id }}
                </td>
                <td style="padding:9px 14px;">{{ $r->user->name }}</td>
                <td style="padding:9px 14px;">{{ $r->whatsapp_target }}</td>
                <td style="padding:9px 14px;">{{ $r->room->name }}</td>
                <td style="padding:9px 14px;">
                    {{ $r->check_in }} s/d {{ $r->check_out }}
                </td>
                <td style="padding:9px 14px;">
                    Rp {{ number_format($r->total_price,0,',','.') }}
                </td>
                <td style="padding:9px 14px;text-transform:uppercase;">
                    {{ $r->status }}
                </td>
                <td style="padding:9px 14px;text-align:center;border-top-right-radius:10px;border-bottom-right-radius:10px;">
                    <form action="{{ route('admin.reservations.updateStatus',$r) }}" method="POST"
                          style="display:flex;gap:6px;justify-content:center;">
                        @csrf
                        <select name="status" style="
                            border-radius:999px;border:1px solid #433129;
                            background:#23140f;color:#f8f3ee;font-size:12px;padding:4px 8px;
                        ">
                            <option value="pending"   @selected($r->status=='pending')>Pending</option>
                            <option value="confirmed" @selected($r->status=='confirmed')>Confirmed</option>
                            <option value="cancelled" @selected($r->status=='cancelled')>Cancelled</option>
                        </select>
                        <button type="submit" class="btn-pill" style="padding:4px 12px;font-size:12px;">
                            Update
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:14px;">
        {{ $reservations->links() }}
    </div>
</section>
@endsection
