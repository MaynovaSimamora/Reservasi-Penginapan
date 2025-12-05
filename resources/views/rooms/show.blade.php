@extends('layouts.app')

@section('page_title', $room->name)
@section('page_subtitle','Detail kamar dan formulir reservasi.')

@section('content')
<section class="content-two-col" style="display:grid;grid-template-columns:1.6fr 1.1fr;gap:26px;align-items:flex-start;">

    {{-- KIRI: DETAIL KAMAR --}}
    <article style="
        background:linear-gradient(145deg,#211612,#130d0a);
        border-radius:22px;
        padding:18px 20px 20px;
        box-shadow:0 22px 60px rgba(0,0,0,0.8);
        border:1px solid rgba(255,255,255,0.04);
    ">
        <h2 style="margin:0 0 10px;">{{ $room->name }}</h2>
        <p style="margin:0 0 10px;font-size:13px;color:#b8aa9f;">
            {{ $room->location }} • {{ ucfirst($room->type) }} • {{ $room->capacity }} tamu
        </p>

        <img src="{{ asset($room->thumbnail ?? 'images/default-room.jpg') }}"
             alt="{{ $room->name }}"
             class="room-detail-img"
             style="width:100%;height:260px;object-fit:cover;border-radius:18px;margin-bottom:12px;">

        <div style="font-size:14px;color:#f3e3cf;margin-bottom:8px;">
            Rp {{ number_format($room->price_per_night,0,',','.') }} / malam
        </div>

        <p style="font-size:14px;line-height:1.6;color:#d4c6bb;">
            {{ $room->description ?? 'Belum ada deskripsi khusus untuk kamar ini.' }}
        </p>
    </article>

    {{-- KANAN: FORM RESERVASI --}}
    <aside style="
        background:radial-gradient(circle at top left,#2b1912,#130c09);
        border-radius:22px;
        padding:18px 18px 16px;
        border:1px solid rgba(255,255,255,0.08);
        box-shadow:0 18px 48px rgba(0,0,0,0.7);
    ">
        <h3 style="margin:0 0 6px;font-size:18px;">Pesan kamar ini</h3>
        <p style="margin:0 0 12px;font-size:13px;color:#b8aa9f;">
            Pilih tanggal, jumlah tamu, dan isi nomor WhatsApp aktif.
        </p>

        @if ($errors->any())
            <div style="margin-bottom:10px;padding:8px 10px;border-radius:12px;background:#5b3030;font-size:13px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @auth
            <form method="POST" action="{{ route('reservations.store', $room->slug) }}">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                    <div>
                        <label style="display:block;font-size:13px;margin-bottom:4px;">Check-in</label>
                        <input type="date" name="check_in" value="{{ old('check_in') }}"
                               style="width:100%;padding:9px 12px;border-radius:12px;border:1px solid #4a362e;
                                      background:#160f0b;color:#f8f3ee;font-size:13px;outline:none;">
                    </div>
                    <div>
                        <label style="display:block;font-size:13px;margin-bottom:4px;">Check-out</label>
                        <input type="date" name="check_out" value="{{ old('check_out') }}"
                               style="width:100%;padding:9px 12px;border-radius:12px;border:1px solid #4a362e;
                                      background:#160f0b;color:#f8f3ee;font-size:13px;outline:none;">
                    </div>
                </div>

                <div style="margin-bottom:10px;">
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Jumlah tamu</label>
                    <input type="number" name="guest_count" value="{{ old('guest_count',1) }}" min="1" max="{{ $room->capacity }}"
                           style="width:100%;padding:9px 12px;border-radius:12px;border:1px solid #4a362e;
                                  background:#160f0b;color:#f8f3ee;font-size:13px;outline:none;">
                </div>

                <div style="margin-bottom:12px;">
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', auth()->user()->phone ?? '') }}"
                           placeholder="628xx..."
                           style="width:100%;padding:9px 12px;border-radius:12px;border:1px solid #4a362e;
                                  background:#160f0b;color:#f8f3ee;font-size:13px;outline:none;">
                </div>

                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit" class="btn-pill" style="padding:9px 20px;">
                        Pesan sekarang
                    </button>
                </div>
            </form>
        @else
            <p style="font-size:13px;color:#b8aa9f;">
                Silakan <a href="{{ route('login') }}" style="color:#f5d7a1;">login</a> terlebih dahulu untuk melakukan pemesanan.
            </p>
        @endauth
    </aside>
</section>
@endsection
