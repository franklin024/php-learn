<div class="hello">this is blade</div>

<div>
    @forelse ($tasks as $task)
    <div>
        <a href="{{ route("task.show", ["id" => $task->id]) }} ">{{ $task->title }}</a>

    </div>
    @empty
        <div>Task rỗng</div>
    @endforelse
</div>
