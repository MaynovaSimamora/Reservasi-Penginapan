@extends('layouts.app')

@section('page_title','Login')
@section('page_subtitle','Masuk untuk mengelola dan memesan villa.')

@section('content')
<section style="
    min-height:calc(100vh - 40px);
    display:flex;
    align-items:center;
    justify-content:center;
">
    <div style="
        width:100%;
        max-width:480px;
        background:radial-gradient(circle at top left,rgba(255,255,255,0.08),rgba(0,0,0,0.65));
        border-radius:24px;
        padding:26px 28px 24px;
        box-shadow:0 26px 70px rgba(0,0,0,0.85);
        border:1px solid rgba(255,255,255,0.04);
        backdrop-filter:blur(18px);
    ">
        <header style="text-align:center;margin-bottom:18px;">
            <div style="font-size:12px;letter-spacing:.22em;text-transform:uppercase;color:#b8aa9f;margin-bottom:4px;">
                Selling Villas
            </div>
            <h1 style="margin:0 0 4px;font-size:22px;">Login</h1>
            <p style="margin:0;font-size:13px;color:#b8aa9f;">
                Temukan penginapan terbaik dengan suasana mewah dan hangat.
            </p>
        </header>

        @if($errors->any())
            <div style="margin-bottom:12px;padding:8px 10px;border-radius:12px;background:#5b3030;font-size:13px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       style="
                           width:100%;padding:10px 14px;
                           border-radius:12px;border:1px solid #4a362e;
                           background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;
                       ">
            </div>

            <div style="margin-bottom:8px;">
                <label style="display:block;font-size:13px;margin-bottom:4px;">Password</label>
                <input type="password" name="password" required
                       style="
                           width:100%;padding:10px 14px;
                           border-radius:12px;border:1px solid #4a362e;
                           background:#160f0b;color:#f8f3ee;font-size:14px;outline:none;
                       ">
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;font-size:13px;color:#b8aa9f;">
                <label style="display:flex;align-items:center;gap:6px;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-pill" style="width:100%;padding:9px 0;margin-bottom:10px;">
                Login
            </button>

            <div style="text-align:center;font-size:13px;color:#b8aa9f;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#f5d7a1;text-decoration:none;">
                    Daftar
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
