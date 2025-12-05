@extends('layouts.app')

@section('content')
<section class="section section-light">
    <div class="container">
        <h2 style="margin-bottom:16px;">Semua Reservasi</h2>

        @if(session('success'))
            <div style="margin-bottom:12px;padding:8px 12px;border-radius:8px;background:#345c3c;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <thead>
            <tr style="background:#42332c;">
                <th style="padding:8px;border-bottom:1px solid #5a463d;">ID</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Tamu</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">WA</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Kamar</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Tanggal</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Total</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Status</th>
                <th style="padding:8px;border-bottom:1px solid #5a463d;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $r)
                <tr>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">#{{ $r->id }}</td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ $r->user->name }}</td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ $r->whatsapp_target }}</td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ $r->room->name }}</td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">
                        {{ $r->check_in }} s/d {{ $r->check_out }}
                    </td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">
                        Rp {{ number_format($r->total_price,0,',','.') }}
                    </td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;text-transform:uppercase;">
                        {{ $r->status }}
                    </td>
                    <td style="padding:8px;border-bottom:1px solid #4a3830;">
                        <form action="{{ route('admin.reservations.updateStatus', $r) }}" method="POST"
                              style="display:flex;gap:6px;">
                            @csrf
                            <select name="status" class="pill" style="padding:4px 8px;font-size:12px;">
                                <option value="pending" @selected($r->status=='pending')>Pending</option>
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

        <div style="margin-top:16px;">
            {{ $reservations->links() }}
        </div>
    </div>
</section>
@endsection
