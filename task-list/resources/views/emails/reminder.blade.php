<!DOCTYPE html>
<html>

<head>
    <title>Nhắc nhở công việc</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Chào {{ $user->name }},</h2>

    <p>Hôm nay bạn vẫn còn <strong>{{ $tasks->count() }}</strong> công việc chưa hoàn thành:</p>

    <ul>
        @foreach ($tasks as $task)
            <li style="margin-bottom: 5px;">
                <strong>{{ $task->title }}</strong>
                <br>
                <span style="color: #666; font-size: 12px;">{{ $task->description }}</span>
            </li>
        @endforeach
    </ul>

    <p>
        <a href="{{ route('task.index') }}"
            style="background: #2563eb; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Vào làm ngay
        </a>
    </p>

    <p>Chúc bạn một ngày làm việc hiệu quả!</p>
</body>

</html>
