@extends('layouts.app')


@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-md border border-slate-200 text-center">

        {{-- Icon Thư --}}
        <div class="mb-4 text-blue-500 flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-slate-800 mb-2">Kiểm tra hộp thư của bạn</h1>

        <p class="text-slate-600 mb-6">
            Chúng tôi đã gửi một liên kết xác thực đến email của bạn.<br>
            Vui lòng bấm vào liên kết đó để kích hoạt tài khoản.
        </p>

        {{-- Thông báo khi gửi lại thành công --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Một liên kết xác thực mới đã được gửi đến email của bạn!
            </div>
        @endif

        {{-- Nút gửi lại --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full bg-slate-800 text-white font-bold py-2 px-4 rounded hover:bg-slate-700 transition">
                Gửi lại email xác thực
            </button>
        </form>

        {{-- Nút Đăng xuất (Cho trường hợp muốn đổi acc khác) --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-sm text-slate-500 hover:text-slate-700 hover:underline">
                Đăng xuất
            </button>
        </form>
    </div>
@endsection
