@extends('layouts.app')

@section('content')
<section class="section section-light">
    <div class="container" style="max-width:600px;">
        <h2 style="margin-bottom:16px;">Tambah Kamar Baru</h2>

        <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:12px;">
                <label>Nama Kamar</label><br>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="pill" style="width:100%;padding:8px 12px;">
                @error('name')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Lokasi</label><br>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="pill" style="width:100%;padding:8px 12px;">
                @error('location')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Tipe</label><br>
                <select name="type" class="pill" style="width:100%;padding:8px 12px;">
                    <option value="standard" @selected(old('type')=='standard')>Standard</option>
                    <option value="deluxe" @selected(old('type')=='deluxe')>Deluxe</option>
                    <option value="suite" @selected(old('type')=='suite')>Suite</option>
                </select>
                @error('type')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Kapasitas (orang)</label><br>
                <input type="number" name="capacity" value="{{ old('capacity',2) }}"
                       class="pill" style="width:100%;padding:8px 12px;" min="1">
                @error('capacity')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Harga per Malam (Rp)</label><br>
                <input type="number" name="price_per_night" value="{{ old('price_per_night') }}"
                       class="pill" style="width:100%;padding:8px 12px;" min="0">
                @error('price_per_night')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:12px;">
                <label>Deskripsi</label><br>
                <textarea name="description" rows="3"
                          class="pill" style="width:100%;padding:8px 12px;">{{ old('description') }}</textarea>
                @error('description')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:14px;">
                <label>Gambar Thumbnail</label><br>
                <input type="file" name="thumbnail" accept="image/*">
                @error('thumbnail')<small style="color:#ffb4b4;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn-pill" style="width:100%;">Simpan Kamar</button>
        </form>
    </div>
</section>
@endsection
