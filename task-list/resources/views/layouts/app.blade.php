<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sửa lỗi hiển thị input của Tailwind v4 nếu bạn dùng link cdn v4 */
        input,
        textarea {
            border-width: 1px;
        }
    </style>
</head>

{{-- 👇 CẬP NHẬT CLASS TẠI ĐÂY --}}

<body>

    <main>
        <div>
            @yield('content')
        </div>
    </main>

</body>

</html>
