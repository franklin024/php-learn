{{-- @extends('layouts.app')

@section('title', 'Danh sách nhiệm vụ')

@section('content')
    <div class="mb-4">
        <a href="{{ route('task.create') }}" class="font-medium text-gray-700  decoration-black-200">➕Add task</a>
    </div>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task]) }}" @class(['line-through' => $task->completed])>
                {{ $task->title }}
            </a>
        </div>
    @empty
        <div>Task rỗng</div>
    @endforelse

    @if ($tasks->count())
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    @endif
@endsection --}}



@extends('layouts.app')

{{-- @section('title', 'Danh sách nhiệm vụ') --}}

@section('content')
    {{-- CONTAINER CHÍNH: Giới hạn chiều rộng (khoảng 670px) và căn giữa màn hình --}}
    <div class="max-w-2xl mx-auto mt-6 p-4">

        {{-- 1. HEADER: Tiêu đề bên trái, Nút thêm bên phải --}}
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-slate-700">📌 Việc cần làm</h1>

            <a href="{{ route('task.create') }}"
                class="flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-800 underline decoration-2 underline-offset-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Thêm Task
            </a>
        </div>

        {{-- 2. DANH SÁCH TASKS --}}
        <div class="space-y-3"> {{-- Tạo khoảng cách đều nhau giữa các thẻ div con --}}
            @forelse ($tasks as $task)
                {{-- ITEM CARD: Nền trắng, bo góc, có bóng nhẹ --}}
                <div
                    class="bg-white rounded-lg border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-200 transition duration-200 group">

                    {{-- Thẻ A bao phủ toàn bộ Card để bấm đâu cũng được --}}
                    <a href="{{ route('task.show', ['task' => $task]) }}" class="block px-5 py-4">
                        <div class="flex justify-between items-center">

                            {{-- Tên Task --}}
                            <span @class([
                                'font-medium text-lg transition-colors', // Style chung
                                'line-through text-slate-400' => $task->completed, // Đã xong: Gạch ngang, màu mờ
                                'text-slate-700 group-hover:text-blue-600' => !$task->completed, // Chưa xong: Màu đậm, hover xanh
                            ])>
                                {{ $task->title }}
                            </span>

                            {{-- Icon trạng thái nhỏ bên phải (Trang trí) --}}
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
                {{-- 3. TRẠNG THÁI RỖNG (EMPTY STATE) --}}
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
