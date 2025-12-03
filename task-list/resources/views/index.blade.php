@extends('layouts.app')

@section('content')
    {{-- CONTAINER CHÍNH: Giới hạn chiều rộng và căn giữa --}}
    <div class="max-w-2xl mx-auto mt-6 p-4">

        {{-- 👇 0. KHU VỰC USER INFO & LOGOUT (MỚI) --}}
        <div class="flex justify-end items-center gap-4 mb-8 pb-4 border-b border-slate-200">
            @auth
                <span class="text-sm text-slate-600">
                    Xin chào, <span class="font-bold text-slate-800">{{ Auth::user()->name }}</span>
                </span>

                {{-- Form Đăng xuất --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-sm font-medium text-red-500 hover:text-red-700 hover:underline transition-colors">
                        Đăng xuất
                    </button>
                </form>
            @endauth
        </div>

        {{-- 1. HEADER: Tiêu đề bên trái, Nút thêm bên phải --}}
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-700">📌 Việc cần làm</h1>

            <a href="{{ route('task.create') }}"
                class="flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-800 underline decoration-2 underline-offset-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Thêm Task
            </a>
        </div>

        {{-- 2. DANH SÁCH TASKS --}}
        <div class="space-y-3">
            @forelse ($tasks as $task)
                {{-- ITEM CARD --}}
                <div
                    class="bg-white rounded-lg border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-200 group">

                    {{-- Thẻ A bao phủ toàn bộ Card --}}
                    <a href="{{ route('task.show', ['task' => $task]) }}" class="block px-5 py-4">
                        <div class="flex justify-between items-center">

                            {{-- Tên Task --}}
                            <span @class([
                                'font-medium text-lg transition-colors',
                                'line-through text-slate-400' => $task->completed,
                                'text-slate-700 group-hover:text-blue-600' => !$task->completed,
                            ])>
                                {{ $task->title }}
                            </span>

                            {{-- Icon trạng thái --}}
                            @if ($task->completed)
                                <span
                                    class="text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded-full">XONG</span>
                            @else
                                <span class="text-slate-300 group-hover:text-blue-400 transition">👉</span>
                            @endif
                        </div>
                    </a>

                </div>
            @empty
                {{-- 3. TRẠNG THÁI RỖNG --}}
                <div class="text-center py-10 px-4 bg-slate-50 border-2 border-dashed border-slate-300 rounded-lg">
                    <div class="text-4xl mb-2">📭</div>
                    <p class="text-slate-500 font-medium">Danh sách đang trống!</p>
                    <p class="text-slate-400 text-sm mt-1">Bạn chưa có nhiệm vụ nào, hãy tạo mới nhé.</p>
                </div>
            @endforelse
        </div>

        {{-- 4. PHÂN TRANG --}}
        @if ($tasks->count())
            <div class="mt-8 mb-10">
                {{ $tasks->links() }}
            </div>
        @endif

    </div>
@endsection
