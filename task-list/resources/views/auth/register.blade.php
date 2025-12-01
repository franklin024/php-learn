@extends('layouts.app')

@section('title', 'Đăng ký thành viên')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md border border-slate-200">
        <h1 class="text-2xl font-bold text-center mb-6 text-slate-700">Đăng Ký Tài Khoản</h1>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            {{-- 1. Tên (Name) --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Họ và Tên</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                    placeholder="Nhập tên của bạn">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2. Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                    placeholder="email@example.com">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 3. Mật khẩu (Password) --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                    placeholder="******">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 4. Nhập lại mật khẩu (QUAN TRỌNG: name="password_confirmation") --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Xác nhận mật
                    khẩu</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                    placeholder="Nhập lại mật khẩu y hệt bên trên">
            </div>

            {{-- Nút Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Đăng Ký Ngay
            </button>

            {{-- Link chuyển qua đăng nhập --}}
            <div class="mt-4 text-center text-sm">
                <span class="text-slate-600">Đã có tài khoản?</span>
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đăng nhập</a>
            </div>
        </form>
    </div>
@endsection
