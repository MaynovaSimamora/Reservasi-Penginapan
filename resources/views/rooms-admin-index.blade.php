@extends('layouts.app')

@section('page_title','Edit kamar')
@section('page_subtitle','Perbarui informasi kamar penginapan.')

@section('content')
<section>
    <div style="max-width:640px;">
        <h2 style="margin-bottom:16px;">Edit kamar: {{ $room->name }}</h2>

        <form method="POST"
              action="{{ route('admin.rooms.update', $room) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:12px;">
                <label>Nama kamar</label><br>
                <input type="text" name="name"
                       value="{{ old('name',$room->name) }}"
                       style="width:100%;padding:9px 12px;border-radius:999px;
                              border:1px solid #433129;background:#120c09;color:#f8f3ee;">
                @error('name')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Lokasi</label><br>
                <input type="text" name="location"
                       value="{{ old('location',$room->location) }}"
                       style="width:100%;padding:9px 12px;border-radius:999px;
                              border:1px solid #433129;background:#120c09;color:#f8f3ee;">
                @error('location')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;display:flex;gap:10px;">
                <div style="flex:1;">
                    <label>Tipe</label><br>
                    <select name="type"
                            style="width:100%;padding:9px 12px;border-radius:999px;
                                   border:1px solid #433129;background:#120c09;color:#f8f3ee;">
                        <option value="standard" @selected(old('type',$room->type)=='standard')>Standard</option>
                        <option value="deluxe"   @selected(old('type',$room->type)=='deluxe')>Deluxe</option>
                        <option value="suite"    @selected(old('type',$room->type)=='suite')>Suite</option>
                    </select>
                    @error('type')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>
                <div style="flex:1;">
                    <label>Kapasitas (orang)</label><br>
                    <input type="number" name="capacity"
                           value="{{ old('capacity',$room->capacity) }}" min="1"
                           style="width:100%;padding:9px 12px;border-radius:999px;
                                  border:1px solid #433129;background:#120c09;color:#f8f3ee;">
                    @error('capacity')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="margin-bottom:12px;">
                <label>Harga per malam (Rp)</label><br>
                <input type="number" name="price_per_night"
                       value="{{ old('price_per_night',$room->price_per_night) }}" min="0"
                       style="width:100%;padding:9px 12px;border-radius:999px;
                              border:1px solid #433129;background:#120c09;color:#f8f3ee;">
                @error('price_per_night')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Deskripsi</label><br>
                <textarea name="description" rows="3"
                          style="width:100%;padding:9px 12px;border-radius:12px;
                                 border:1px solid #433129;background:#120c09;color:#f8f3ee;">{{ old('description',$room->description) }}</textarea>
                @error('description')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>
                    <input type="checkbox" name="is_active" value="1"
                           @checked(old('is_active',$room->is_active))>
                    Kamar aktif
                </label>
            </div>

            <div style="margin-bottom:14px;">
                <label>Thumbnail</label><br>
                @if($room->thumbnail)
                    <img src="{{ asset($room->thumbnail) }}" alt=""
                         style="width:140px;height:90px;object-fit:cover;border-radius:10px;margin-bottom:6px;"><br>
                @endif
                <input type="file" name="thumbnail" accept="image/*">
                @error('thumbnail')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn-pill" style="flex:1;">Simpan perubahan</button>
                <a href="{{ route('admin.rooms.index') }}"
                   class="btn-pill"
                   style="flex:1;text-align:center;background:#3a2a23;color:#f8f3ee;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
