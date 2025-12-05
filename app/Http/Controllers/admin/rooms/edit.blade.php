@extends('layouts.app')

@section('content')
<section class="section section-light">
    <div class="container" style="max-width:600px;">
        <h2 style="margin-bottom:16px;">Edit Kamar: {{ $room->name }}</h2>

        <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:12px;">
                <label>Nama Kamar</label><br>
                <input type="text" name="name" value="{{ old('name', $room->name) }}"
                       class="pill" style="width:100%;padding:8px 12px;">
                @error('name')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Lokasi</label><br>
                <input type="text" name="location" value="{{ old('location', $room->location) }}"
                       class="pill" style="width:100%;padding:8px 12px;">
                @error('location')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Tipe</label><br>
                <select name="type" class="pill" style="width:100%;padding:8px 12px;">
                    <option value="standard" @selected(old('type',$room->type)=='standard')>Standard</option>
                    <option value="deluxe" @selected(old('type',$room->type)=='deluxe')>Deluxe</option>
                    <option value="suite" @selected(old('type',$room->type)=='suite')>Suite</option>
                </select>
                @error('type')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Kapasitas (orang)</label><br>
                <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}"
                       class="pill" style="width:100%;padding:8px 12px;" min="1">
                @error('capacity')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Harga per Malam (Rp)</label><br>
                <input type="number" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}"
                       class="pill" style="width:100%;padding:8px 12px;" min="0">
                @error('price_per_night')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Deskripsi</label><br>
                <textarea name="description" rows="3"
                          class="pill" style="width:100%;padding:8px 12px;">{{ old('description', $room->description) }}</textarea>
                @error('description')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>
                    <input type="checkbox" name="is_active" value="1"
                           @checked(old('is_active', $room->is_active))> Aktif
                </label>
            </div>

            <div style="margin-bottom:14px;">
                <label>Ganti Gambar Thumbnail</label><br>
                @if($room->thumbnail)
                    <img src="{{ asset($room->thumbnail) }}" alt=""
                         style="width:120px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;"><br>
                @endif
                <input type="file" name="thumbnail" accept="image/*">
                @error('thumbnail')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn-pill" style="width:100%;">Update Kamar</button>
        </form>
    </div>
</section>
@endsection
