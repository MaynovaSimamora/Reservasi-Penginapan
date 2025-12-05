@extends('layouts.app')

@section('page_title','Selling Villas')
@section('page_subtitle','Dashboard villa & kamar dengan nuansa hangat dan modern.')

@section('content')
    {{-- SECTION ATAS: HERO + FILTER --}}
    <section class="hero-shell" style="display:grid;grid-template-columns:minmax(0,1.6fr) minmax(0,1.1fr);gap:28px;align-items:stretch;">
        {{-- HERO --}}
        <article style="
            position:relative;
            overflow:hidden;
            border-radius:24px;
            background:url('/images/hero-villa.jpg') center/cover no-repeat;
            min-height:260px;
            box-shadow:0 26px 60px rgba(0,0,0,0.75);
        ">
            <div style="
                position:absolute;inset:0;
                background:linear-gradient(120deg,rgba(0,0,0,0.85),rgba(0,0,0,0.15));
            "></div>

            <div style="
                position:relative;
                height:100%;
                padding:24px 28px 18px;
                display:flex;
                flex-direction:column;
                justify-content:space-between;
            ">
                <header>
                    <div style="font-size:11px;letter-spacing:.34em;text-transform:uppercase;color:#f3e3cf;">
                        Curated villa collection
                    </div>
                    <h1 style="margin:10px 0 0;font-size:30px;letter-spacing:.08em;font-weight:300;">
                        Selling Villas
                    </h1>
                    <p style="margin-top:10px;font-size:14px;color:#c9bbb0;max-width:360px;line-height:1.5;">
                        Temukan penginapan terbaik dengan suasana mewah dan hangat untuk liburan, staycation,
                        atau perjalanan bisnis.
                    </p>
                </header>

                <div style="display:flex;gap:26px;font-size:12px;color:#f3e3cf;">
                    <div>
                        <strong style="display:block;font-size:18px;color:#f5d7a1;">24+</strong>
                        Kota pilihan
                    </div>
                    <div>
                        <strong style="display:block;font-size:18px;color:#f5d7a1;">120+</strong>
                        Villa premium
                    </div>
                    <div>
                        <strong style="display:block;font-size:18px;color:#f5d7a1;">4.8</strong>
                        Rating tamu
                    </div>
                </div>
            </div>
        </article>

        {{-- FILTER --}}
        <aside style="
            border-radius:22px;
            background:radial-gradient(circle at top left,#2b1912,#130c09);
            padding:18px 18px 16px;
            border:1px solid rgba(255,255,255,0.05);
            box-shadow:0 18px 48px rgba(0,0,0,0.7);
        ">
            <header style="margin-bottom:10px;">
                <div style="font-size:18px;margin-bottom:4px;">Find your best room</div>
                <div style="font-size:13px;color:#b8aa9f;">
                    Filter berdasarkan lokasi, tipe kamar, dan rentang harga.
                </div>
            </header>

            <form method="GET" action="{{ route('landing') }}">
                <div style="
                    display:grid;
                    grid-template-columns:2.2fr 1.1fr;
                    gap:10px 10px;
                    margin-bottom:10px;
                ">
                    <div style="grid-column:1 / span 2;position:relative;">
                        <label style="
                            position:absolute;top:6px;left:14px;
                            font-size:11px;color:#a2958b;
                            text-transform:uppercase;letter-spacing:.11em;
                        ">Location</label>
                        <input type="text" name="location"
                               placeholder="Jakarta, Bali, Makassar..."
                               value="{{ request('location') }}"
                               style="
                                   width:100%;padding:22px 14px 8px;
                                   border-radius:999px;border:1px solid #433129;
                                   background:rgba(22,13,10,0.92);
                                   color:#f8f3ee;font-size:13px;outline:none;
                               ">
                    </div>

                    <div style="position:relative;">
                        <label style="
                            position:absolute;top:6px;left:14px;
                            font-size:11px;color:#a2958b;
                            text-transform:uppercase;letter-spacing:.11em;
                        ">Type</label>
                        <select name="type" style="
                            width:100%;padding:22px 14px 8px;
                            border-radius:999px;border:1px solid #433129;
                            background:rgba(22,13,10,0.92);
                            color:#f8f3ee;font-size:13px;outline:none;
                        ">
                            <option value="">Any type</option>
                            <option value="standard" @selected(request('type')=='standard')>Standard</option>
                            <option value="deluxe" @selected(request('type')=='deluxe')>Deluxe</option>
                            <option value="suite" @selected(request('type')=='suite')>Suite</option>
                        </select>
                    </div>

                    <div style="position:relative;">
                        <label style="
                            position:absolute;top:6px;left:14px;
                            font-size:11px;color:#a2958b;
                            text-transform:uppercase;letter-spacing:.11em;
                        ">Min price</label>
                        <input type="number" name="min_price" placeholder="0"
                               value="{{ request('min_price') }}"
                               style="
                                   width:100%;padding:22px 14px 8px;
                                   border-radius:999px;border:1px solid #433129;
                                   background:rgba(22,13,10,0.92);
                                   color:#f8f3ee;font-size:13px;outline:none;
                               ">
                    </div>

                    <div style="position:relative;">
                        <label style="
                            position:absolute;top:6px;left:14px;
                            font-size:11px;color:#a2958b;
                            text-transform:uppercase;letter-spacing:.11em;
                        ">Max price</label>
                        <input type="number" name="max_price" placeholder="5000000"
                               value="{{ request('max_price') }}"
                               style="
                                   width:100%;padding:22px 14px 8px;
                                   border-radius:999px;border:1px solid #433129;
                                   background:rgba(22,13,10,0.92);
                                   color:#f8f3ee;font-size:13px;outline:none;
                               ">
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;">
                    <button type="submit" class="btn-pill">Find Now</button>
                </div>
            </form>
        </aside>
    </section>

    {{-- SECTION BAWAH: FEATURED ROOMS --}}
    <section style="margin-top:32px;">
        <header style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:16px;">
            <div>
                <h2 style="font-size:20px;margin:0;">Featured rooms</h2>
                <p style="margin:4px 0 0;font-size:13px;color:#b8aa9f;">
                    Pilihan kamar terbaik yang siap dipesan.
                </p>
            </div>
            <span style="font-size:13px;color:#b8aa9f;">
                {{ $rooms->count() }} kamar tersimpan dalam sistem
            </span>
        </header>

        @if($rooms->isEmpty())
            <p style="color:#b8aa9f;">
                Belum ada kamar tersedia. Tambahkan lewat menu admin kamar.
            </p>
        @else
            <div class="rooms-grid" style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
                gap:20px;
            ">
                @foreach($rooms as $room)
                    <article class="room-card" style="
                        background:linear-gradient(140deg,#271813,#18100d);
                        border-radius:20px;
                        overflow:hidden;
                        box-shadow:0 22px 55px rgba(0,0,0,0.75);
                        display:flex;
                        flex-direction:column;
                        min-height:260px;
                        transition:transform .18s ease,box-shadow .18s ease;
                    " onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 28px 70px rgba(0,0,0,0.85)';"
                       onmouseout="this.style.transform='';this.style.boxShadow='0 22px 55px rgba(0,0,0,0.75)';">
                        <img src="{{ asset($room->thumbnail ?? 'images/default-room.jpg') }}"
                             alt="{{ $room->name }}"
                             style="width:100%;height:150px;object-fit:cover;display:block;">
                        <div style="padding:12px 16px 14px;flex:1;display:flex;flex-direction:column;">
                            <div style="font-size:12px;color:#b8aa9f;margin-bottom:4px;">
                                {{ $room->location }} • {{ ucfirst($room->type) }} • {{ $room->capacity }} tamu
                            </div>
                            <h3 style="font-size:16px;margin:0 0 4px;">{{ $room->name }}</h3>
                            <div style="margin-top:auto;">
                                <div style="font-size:14px;color:#f3e3cf;">
                                    Rp {{ number_format($room->price_per_night,0,',','.') }} / malam
                                </div>
                                <div style="margin-top:8px;display:flex;justify-content:space-between;align-items:center;">
                                    <a href="{{ route('rooms.show',$room) }}"
                                       class="btn-pill"
                                       style="padding:7px 16px;font-size:12px;">
                                        View detail
                                    </a>
                                    <span style="font-size:11px;color:#b8aa9f;">ID #{{ $room->id }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
