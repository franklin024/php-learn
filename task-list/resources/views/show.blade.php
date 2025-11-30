@extends('layouts.app')


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
@endsection
