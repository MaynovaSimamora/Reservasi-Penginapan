@extends('layouts.app')

@section('page_title','Detail reservasi')
@section('page_subtitle','Ringkasan pemesanan kamar Anda.')

@section('content')
<section style="max-width:900px;">

    @if(session('success'))
        <div style="margin-bottom:10px;padding:8px 10px;border-radius:12px;background:#345c3c;font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="margin-bottom:10px;padding:8px 10px;border-radius:12px;background:#5b3030;font-size:13px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <h1 style="margin:0 0 6px;font-size:22px;">Detail reservasi</h1>
    <p style="margin:0 0 14px;font-size:13px;color:#b8aa9f;">
        Ringkasan pemesanan kamar Anda.
    </p>

    <div style="
        background:linear-gradient(145deg,#211612,#130d0a);
        border-radius:24px;
        padding:20px 22px 20px;
        box-shadow:0 26px 70px rgba(0,0,0,0.85);
        border:1px solid rgba(255,255,255,0.04);
    ">
        <header style="margin-bottom:12px;">
            <h2 style="margin:0 0 4px;font-size:20px;">Reservasi #{{ $reservation->id }}</h2>
            <p style="margin:0;font-size:13px;color:#b8aa9f;">
                Status:
                <strong style="text-transform:uppercase;color:#f5d7a1;">
                    {{ $reservation->status }}
                </strong>
            </p>
        </header>

        <div class="content-two-col" style="display:grid;grid-template-columns:1.4fr 1fr;gap:18px;align-items:flex-start;">
            {{-- KIRI: INFO KAMAR --}}
            <div>
                <h3 style="margin:0 0 4px;font-size:16px;">{{ $reservation->room->name }}</h3>
                <p style="margin:0 0 8px;font-size:13px;color:#b8aa9f;">
                    {{ $reservation->room->location }} • {{ ucfirst($reservation->room->type) }} • {{ $reservation->room->capacity }} tamu
                </p>
                <img src="{{ asset($reservation->room->thumbnail ?? 'images/default-room.jpg') }}"
                     alt="{{ $reservation->room->name }}"
                     class="room-detail-img"
                     style="width:100%;height:220px;object-fit:cover;border-radius:18px;">
            </div>

            {{-- KANAN: DETAIL TAMU & PEMBAYARAN --}}
            <div style="font-size:13px;color:#f3e3cf;">
                <div style="margin-bottom:10px;">
                    <strong>Tamu:</strong><br>
                    {{ $reservation->user->name }}<br>
                    {{ $reservation->user->email }}<br>
                    WA: {{ $reservation->whatsapp_target }}
                </div>

                <div style="margin-bottom:10px;">
                    <strong>Tanggal menginap:</strong><br>
                    {{ $reservation->check_in }} s/d {{ $reservation->check_out }}<br>
                    {{ $reservation->guest_count }} tamu
                </div>

                <div style="margin-bottom:10px;">
                    <strong>Total bayar:</strong><br>
                    Rp {{ number_format($reservation->total_price,0,',','.') }}
                </div>

                <p style="font-size:12px;color:#b8aa9f;margin-top:6px;">
                    Detail pemesanan juga dikirim ke nomor WhatsApp yang Anda masukkan.
                </p>

                {{-- TOMBOL BATALKAN UNTUK USER PEMILIK RESERVASI SAAT MASIH PENDING --}}
                @if(Auth::check() && Auth::id() === $reservation->user_id && $reservation->status === 'pending')
                    <form method="POST" action="{{ route('reservations.cancel', $reservation) }}"
                          style="margin-top:10px;">
                        @csrf
                        <button type="submit"
                                onclick="return confirm('Yakin ingin membatalkan reservasi ini?')"
                                class="btn-pill"
                                style="background:#5b3030;color:#f8f3ee;padding:7px 16px;font-size:13px;">
                            Batalkan reservasi
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
