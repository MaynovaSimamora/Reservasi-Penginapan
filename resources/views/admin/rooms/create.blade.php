@extends('layouts.app')

@section('page_title','Tambah kamar')
@section('page_subtitle','Input kamar baru ke sistem.')

@section('content')
<section style="display:flex;justify-content:center;">
    <div style="
        width:100%;
        max-width:720px;
        background:linear-gradient(145deg,#211612,#130d0a);
        border-radius:22px;
        padding:20px 26px 22px;
        box-shadow:0 22px 60px rgba(0,0,0,0.8);
        border:1px solid rgba(255,255,255,0.04);
    ">
        <header style="margin-bottom:18px;">
            <div style="font-size:12px;letter-spacing:.22em;text-transform:uppercase;color:#b8aa9f;">
                Tambah kamar
            </div>
            <h2 style="margin:4px 0 0;font-size:20px;">Tambah kamar baru</h2>
        </header>

        <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Nama --}}
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Nama kamar</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       style="
                           width:100%;padding:10px 14px;
                           border-radius:12px;border:1px solid #4a362e;
                           background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;
                       ">
                @error('name')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            {{-- Lokasi --}}
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                              background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">
                @error('location')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            {{-- Grid tipe + kapasitas + harga --}}
            <div style="display:grid;grid-template-columns:1.1fr 0.9fr 1.2fr;gap:12px;margin-bottom:12px;">
                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Tipe</label>
                    <select name="type"
                            style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                                   background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">
                        <option value="standard" @selected(old('type')=='standard')>Standard</option>
                        <option value="deluxe"   @selected(old('type')=='deluxe')>Deluxe</option>
                        <option value="suite"    @selected(old('type')=='suite')>Suite</option>
                    </select>
                    @error('type')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Kapasitas (orang)</label>
                    <input type="number" name="capacity" value="{{ old('capacity',2) }}" min="1"
                           style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                                  background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">
                    @error('capacity')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Harga per malam (Rp)</label>
                    <input type="number" name="price_per_night" value="{{ old('price_per_night') }}" min="0"
                           style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                                  background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">
                    @error('price_per_night')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Deskripsi</label>
                <textarea name="description" rows="3"
                          style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                                 background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">{{ old('description') }}</textarea>
                @error('description')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            {{-- Thumbnail --}}
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*" style="font-size:13px;color:#b8aa9f;">
                @error('thumbnail')<small style="color:#ffb4b4;display:block;">{{ $message }}</small>@enderror
            </div>

            {{-- Tombol --}}
            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-pill" style="padding:9px 22px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
