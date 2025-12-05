@extends('layouts.app')

@section('page_title','Edit kamar')
@section('page_subtitle','Perbarui data kamar penginapan.')

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
                Edit kamar
            </div>
            <h2 style="margin:4px 0 0;font-size:20px;">{{ $room->name }}</h2>
        </header>

        <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Nama kamar</label>
                <input type="text" name="name" value="{{ old('name',$room->name) }}"
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
                <input type="text" name="location" value="{{ old('location',$room->location) }}"
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
                        <option value="standard" @selected(old('type',$room->type)=='standard')>Standard</option>
                        <option value="deluxe"   @selected(old('type',$room->type)=='deluxe')>Deluxe</option>
                        <option value="suite"    @selected(old('type',$room->type)=='suite')>Suite</option>
                    </select>
                    @error('type')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Kapasitas (orang)</label>
                    <input type="number" name="capacity" value="{{ old('capacity',$room->capacity) }}" min="1"
                           style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid #4a362e;
                                  background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">
                    @error('capacity')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Harga per malam (Rp)</label>
                    <input type="number" name="price_per_night"
                           value="{{ old('price_per_night',$room->price_per_night) }}" min="0"
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
                                 background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;">{{ old('description',$room->description) }}</textarea>
                @error('description')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            {{-- Aktif --}}
            <div style="margin-bottom:12px;">
                <label style="font-size:13px;">
                    <input type="checkbox" name="is_active" value="1"
                           @checked(old('is_active',$room->is_active))
                           style="margin-right:6px;">
                    Kamar aktif
                </label>
            </div>

            {{-- Thumbnail --}}
            <div style="margin-bottom:16px;display:grid;grid-template-columns:1fr 1.4fr;gap:14px;align-items:center;">
                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Thumbnail saat ini</label>
                    @if($room->thumbnail)
                        <img src="{{ asset($room->thumbnail) }}" alt=""
                             style="width:100%;max-width:160px;height:100px;object-fit:cover;border-radius:14px;
                                    box-shadow:0 12px 30px rgba(0,0,0,0.7);">
                    @else
                        <div style="width:160px;height:100px;border-radius:14px;border:1px dashed #4a362e;
                                    display:flex;align-items:center;justify-content:center;font-size:12px;color:#b8aa9f;">
                            Belum ada gambar
                        </div>
                    @endif
                </div>
                <div>
                    <label style="display:block;font-size:13px;margin-bottom:4px;">Ganti thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*"
                           style="font-size:13px;color:#b8aa9f;">
                    @error('thumbnail')<small style="color:#ffb4b4;display:block;">{{ $message }}</small>@enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-pill" style="padding:9px 22px;">
                    Simpan perubahan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
