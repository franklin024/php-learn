@extends('layouts.app')

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

    @if ($task->count())
        <div>
            {{ $tasks->links() }}
        </div>
    @endif
@endsection
