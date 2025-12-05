@extends('layouts.app')

@section('page_title','Admin kamar')
@section('page_subtitle','Kelola data kamar penginapan.')

@section('content')
<section>
    @if(session('success'))
        <div style="margin-bottom:12px;padding:8px 12px;border-radius:8px;background:#345c3c;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
        <h2>Data kamar</h2>
        <a href="{{ route('admin.rooms.create') }}" class="btn-pill">Tambah kamar</a>
    </div>

    <div class="table-wrapper">
        <table style="width:100%;border-collapse:separate;border-spacing:0 4px;font-size:14px;">
            <thead>
            <tr style="background:#3b2a22;">
                <th style="padding:10px 14px;text-align:left;border-radius:10px 0 0 10px;">Nama</th>
                <th style="padding:10px 14px;text-align:left;">Lokasi</th>
                <th style="padding:10px 14px;text-align:left;">Tipe</th>
                <th style="padding:10px 14px;text-align:left;">Harga</th>
                <th style="padding:10px 14px;text-align:center;border-radius:0 10px 10px 0;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr style="background:#1c1411;border-radius:10px;box-shadow:0 4px 14px rgba(0,0,0,0.55);">
                    <td style="padding:9px 14px;border-top-left-radius:10px;border-bottom-left-radius:10px;">
                        {{ $room->name }}
                    </td>
                    <td style="padding:9px 14px;">{{ $room->location }}</td>
                    <td style="padding:9px 14px;">{{ ucfirst($room->type) }}</td>
                    <td style="padding:9px 14px;">
                        Rp {{ number_format($room->price_per_night,0,',','.') }}
                    </td>
                    <td style="padding:9px 14px;text-align:center;border-top-right-radius:10px;border-bottom-right-radius:10px;">
                        <a href="{{ route('admin.rooms.edit',$room) }}"
                           style="color:#f7d794;margin-right:12px;text-decoration:none;">Edit</a>
                        <form action="{{ route('admin.rooms.destroy',$room) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Hapus kamar ini?')"
                                    style="background:none;border:none;color:#ff6b6b;cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:14px;">
        {{ $rooms->links() }}
    </div>
</section>
@endsection
