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

    <table style="width:100%;border-collapse:collapse;font-size:14px;">
        <thead>
        <tr style="background:#42332c;">
            <th style="padding:8px;border-bottom:1px solid #5a463d;">Nama</th>
            <th style="padding:8px;border-bottom:1px solid #5a463d;">Lokasi</th>
            <th style="padding:8px;border-bottom:1px solid #5a463d;">Tipe</th>
            <th style="padding:8px;border-bottom:1px solid #5a463d;">Harga</th>
            <th style="padding:8px;border-bottom:1px solid #5a463d;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            <tr>
                <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ $room->name }}</td>
                <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ $room->location }}</td>
                <td style="padding:8px;border-bottom:1px solid #4a3830;">{{ ucfirst($room->type) }}</td>
                <td style="padding:8px;border-bottom:1px solid #4a3830;">
                    Rp {{ number_format($room->price_per_night,0,',','.') }}
                </td>
                <td style="padding:8px;border-bottom:1px solid #4a3830;">
                    <a href="{{ route('admin.rooms.edit',$room) }}"
                       style="color:#f7d794;margin-right:8px;">Edit</a>
                    <form action="{{ route('admin.rooms.destroy',$room) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Hapus kamar ini?')"
                                style="background:none;border:none;color:#ff7979;cursor:pointer;">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:14px;">
        {{ $rooms->links() }}
    </div>
</section>
@endsection
