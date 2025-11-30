@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add task')

@section('style')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem
        }
    </style>
@endsection

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
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3">{{ $task->description ?? old('description') }}</textarea>

            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10"> {{ $task->long_description ?? old('long_description') }}</textarea>

            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>

            <button type="submit">
                @isset($task)
                    Update
                @else
                    Create
                @endisset
            </button>

            <a href="{{ route('task.index') }}">Back</a>
        </div>
    </form>
@endsection
