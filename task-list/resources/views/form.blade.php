{{-- @extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add task')

@section('content')
    <form class="form-container" method="POST"
        action="{{ isset($task) ? route('task.update', ['task' => $task]) : route('task.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset

        <div>
            <label for="title">
                Title
            </label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                @class(['!border-red-400' => $errors->has('title')])>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" @class(['!border-red-400' => $errors->has('description')])>
                {{ $task->description ?? old('description') }}

            </textarea>

            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10" @class(['!border-red-400' => $errors->has('long_description')])>
                 {{ $task->long_description ?? old('long_description') }}
            </textarea>

            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">

            <button type="submit" class="btn">
                @isset($task)
                    Update
                @else
                    Create
                @endisset
            </button>

            <a href="{{ route('task.index') }}" class="btn">Back</a>
        </div>
    </form>
@endsection --}}


@extends('layouts.app')

@section('content')
    {{-- CONTAINER: Giới hạn chiều rộng và căn giữa --}}
    <div class="max-w-2xl mx-auto mt-6 p-4">

        {{-- NÚT BACK --}}
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

        {{-- FORM CARD --}}
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden p-6 sm:p-8">

            <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">
                {{ isset($task) ? 'Chỉnh Sửa Công Việc' : 'Tạo Công Việc Mới' }}
            </h2>

            <form method="POST"
                action="{{ isset($task) ? route('task.update', ['task' => $task]) : route('task.store') }}">
                @csrf
                @isset($task)
                    @method('PUT')
                @endisset

                {{-- Input: Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Tiêu đề</label>
                    <input type="text" name="title" id="title" {{-- LOGIC CHUẨN: Ưu tiên old(), nếu không có mới lấy DB --}}
                        value="{{ old('title', $task->title ?? null) }}" {{-- Style Input: Viền xám nhạt, focus viền xanh/xám, lỗi viền đỏ --}} @class([
                            'w-full rounded-md border px-3 py-2 text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 transition duration-150 ease-in-out',
                            'border-red-500 focus:ring-red-500' => $errors->has('title'),
                            'border-slate-300 focus:border-slate-400 focus:ring-slate-400' => !$errors->has(
                                'title'),
                        ])>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Input: Description --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Mô tả ngắn</label>
                    <textarea name="description" id="description" rows="3" @class([
                        'w-full rounded-md border px-3 py-2 text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 transition duration-150 ease-in-out resize-none',
                        'border-red-500 focus:ring-red-500' => $errors->has('description'),
                        'border-slate-300 focus:border-slate-400 focus:ring-slate-400' => !$errors->has(
                            'description'),
                    ])>{{ old('description', $task->description ?? null) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Input: Long Description --}}
                <div class="mb-8">
                    <label for="long_description" class="block text-sm font-semibold text-slate-700 mb-2">Chi tiết (Tùy
                        chọn)</label>
                    <textarea name="long_description" id="long_description" rows="7" @class([
                        'w-full rounded-md border px-3 py-2 text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 transition duration-150 ease-in-out',
                        'border-red-500 focus:ring-red-500' => $errors->has('long_description'),
                        'border-slate-300 focus:border-slate-400 focus:ring-slate-400' => !$errors->has(
                            'long_description'),
                    ])>{{ old('long_description', $task->long_description ?? null) }}</textarea>

                    @error('long_description')
                        <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="w-full rounded-md bg-slate-800 px-4 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all">
                        @isset($task)
                            Cập nhật
                        @else
                            Tạo mới
                        @endisset
                    </button>

                    <a href="{{ route('task.index') }}"
                        class="w-full rounded-md bg-white border border-slate-300 px-4 py-2.5 text-center text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 transition-all">
                        Hủy bỏ
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
