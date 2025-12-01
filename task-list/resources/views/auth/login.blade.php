@extends('layouts.app')

@section('title', 'Đăng nhập hệ thống')

@section('content')
    <div class="max-w-md mx-auto mt-10">

        {{-- Card chứa Form --}}
        <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-md">

            <h1 class="text-2xl font-bold text-center text-slate-800 mb-6">Đăng Nhập</h1>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- 1. Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Địa chỉ Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full border-slate-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500"
                        placeholder="admin@example.com" required autofocus>

                    {{-- Hiển thị lỗi đăng nhập thất bại ở đây --}}
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Mật khẩu</label>
                    <input type="password" name="password" id="password"
                        class="w-full border-slate-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500"
                        placeholder="******" required>

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 3. Nút Submit --}}
                <button type="submit"
                    class="w-full bg-slate-800 text-white font-bold py-2.5 px-4 rounded-md hover:bg-slate-700 transition duration-150">
                    Đăng Nhập
                </button>

            </form>

            {{-- Footer: Link qua trang đăng ký --}}
            <div class="mt-6 text-center border-t border-slate-100 pt-4">
                <p class="text-sm text-slate-600">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 hover:underline">
                        Đăng ký ngay
                    </a>
                </p>
            </div>

        </div>
    </div>
@endsection
