@extends('layouts.app')

@section('page_title','Reservasi saya')
@section('page_subtitle','Daftar semua pemesanan kamar Anda.')

@section('content')
<section>
    <h2 style="margin-bottom:14px;">Reservasi saya</h2>

    @if($reservations->isEmpty())
        <p style="color:#b8aa9f;">Belum ada reservasi. Silakan pesan kamar dari halaman beranda.</p>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
            @foreach($reservations as $r)
                <article style="
                    background:linear-gradient(145deg,#211612,#130d0a);
                    border-radius:18px;
                    padding:12px 14px 14px;
                    box-shadow:0 18px 50px rgba(0,0,0,0.8);
                ">
                    <div style="font-size:12px;color:#b8aa9f;margin-bottom:4px;">
                        #{{ $r->id }} • {{ strtoupper($r->status) }}
                    </div>
                    <h3 style="margin:0 0 4px;font-size:15px;">{{ $r->room->name }}</h3>
                    <p style="margin:0 0 6px;font-size:12px;color:#b8aa9f;">
                        {{ $r->check_in }} s/d {{ $r->check_out }} • {{ $r->guest_count }} tamu
                    </p>
                    <div style="font-size:13px;color:#f3e3cf;margin-bottom:8px;">
                        Rp {{ number_format($r->total_price,0,',','.') }}
                    </div>
                    <a href="{{ route('reservations.show',$r) }}"
                       class="btn-pill"
                       style="padding:6px 14px;font-size:12px;">
                        Lihat detail
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
