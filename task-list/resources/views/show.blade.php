{{-- @extends('layouts.app')


@section('content')
    <div class="font-medium text-gray-800  decoration-black-200 mb-4">
        <a href="{{ route('task.index') }}">⬅Back</a>
    </div>

    <div class="mb-4">
        <h1 class="text-3xl mb-4">{{ $task->title }}</h1>
        @if (session()->has('success'))
            <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>


    @if ($task->long_description)
        <p class="mb-4 text-slate-500">{{ $task->long_description }}</p>
    @endif


    <p class="mb-4 text-slate-500">
        Tạo {{ $task->created_at->locale('vi')->diffForHumans() }} - Cập
        nhật{{ $task->updated_at->locale('vi')->diffForHumans() }}</p>
    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">
                Nhiệm vụ đã hoàn thành.
            </span>
        @else
            <span class="font-medium text-red-500">
                Nhiệm vụ chưa hoàn thành.

            </span>
        @endif
    </p>


    <div class="flex gap-2">
        <form action="{{ route('task.toggle-complete', ['task' => $task]) }}" method="POST">

            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                {{ $task->completed ? 'đánh dấu chưa hoàn thành' : 'đánh dấu hoàn thành' }}
            </button>

        </form>

        <form action="{{ route('task.destroy', ['task' => $task]) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="btn danger">
                Delete
            </button>
        </form>

        <a href="{{ route('task.edit', ['task' => $task]) }}" class="btn">
            Edit
        </a>
    </div>
@endsection --}}


@extends('layouts.app')


@section('content')
    {{-- CONTAINER: Giới hạn chiều rộng và căn giữa --}}
    <div class="max-w-2xl mx-auto mt-6 p-4">

        {{-- NÚT BACK: Đơn giản, tinh tế --}}
        <div class="mb-6">
            <a href="{{ route('task.index') }}"
                class="inline-flex items-center gap-1 font-medium text-slate-600 hover:text-slate-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Quay lại danh sách
            </a>
        </div>

        {{-- CARD CHÍNH: Chứa toàn bộ nội dung --}}
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">

            {{-- Header của Card: Chứa Tiêu đề và Trạng thái --}}
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-start gap-4">
                <h1 class="text-2xl font-bold text-slate-800 leading-tight">{{ $task->title }}</h1>

                {{-- Badge trạng thái --}}
                @if ($task->completed)
                    <span
                        class="shrink-0 inline-block px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full border border-green-200">
                        ĐÃ XONG
                    </span>
                @else
                    <span
                        class="shrink-0 inline-block px-3 py-1 text-xs font-bold text-amber-700 bg-amber-100 rounded-full border border-amber-200">
                        CHƯA XONG
                    </span>
                @endif
            </div>

            {{-- Body của Card: Nội dung chi tiết --}}
            <div class="px-6 py-6">
                {{-- Thông báo thành công (Flash Message) --}}
                @if (session()->has('success'))
                    <div x-data="{ flash: true }">
                        <div x-show="flash"
                            class="relative mb-6 rounded-md bg-green-50 border border-green-200 p-4 text-sm text-green-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}

                            <span class="absolute top-0 right-0 bottom-0 p-4 hover:cursor-pointer" @click="flash = false">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" transform=""
                                    id="injected-svg">
                                    <!-- Boxicons v3.0.6 https://boxicons.com | License  https://docs.boxicons.com/free -->
                                    <path
                                        d="m7.76 14.83-2.83 2.83 1.41 1.41 2.83-2.83 2.12-2.12.71-.71.71.71 1.41 1.42 3.54 3.53 1.41-1.41-3.53-3.54-1.42-1.41-.71-.71 5.66-5.66-1.41-1.41L12 10.59 6.34 4.93 4.93 6.34 10.59 12l-.71.71z" />
                                </svg>
                            </span>
                        </div>

                    </div>
                @endif

                {{-- Mô tả ngắn --}}
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Mô tả ngắn</h3>
                    <p class="text-slate-800 text-lg">{{ $task->description }}</p>
                </div>

                {{-- Mô tả dài (Nếu có) --}}
                @if ($task->long_description)
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Chi tiết</h3>
                        <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $task->long_description }}</p>
                    </div>
                @endif

                {{-- Thông tin thời gian --}}
                <div class="text-xs text-slate-400 border-t border-slate-100 pt-4 mt-6 flex gap-4">
                    <span>📅 Tạo: {{ $task->created_at->locale('vi')->diffForHumans() }}</span>
                    <span>✏️ Cập nhật: {{ $task->updated_at->locale('vi')->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Footer của Card: Các nút hành động --}}
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex gap-3">

                {{-- Nút Toggle Trạng thái --}}
                <form action="{{ route('task.toggle-complete', ['task' => $task]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition">
                        {{ $task->completed ? 'Đánh dấu chưa xong' : 'Đánh dấu đã xong' }}
                    </button>
                </form>

                {{-- Spacer: Đẩy 2 nút kia sang phải (nếu muốn), ở đây mình để liền nhau --}}

                {{-- Nút Xóa --}}
                <form action="{{ route('task.destroy', ['task' => $task]) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                        Xóa
                    </button>
                </form>

                {{-- Nút Sửa --}}
                <a href="{{ route('task.edit', ['task' => $task]) }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    Sửa
                </a>
            </div>

        </div>
    </div>
@endsection
