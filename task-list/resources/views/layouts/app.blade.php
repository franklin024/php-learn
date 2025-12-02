{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task list app</title>
    <style type="text/tailwindcss">
        * {
            font-size: 16px;
        }

        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-500 hover:bg-blue-100
        }


        .btn.danger {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-500 hover:bg-red-100
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border border-sky-400 rounded-md w-full py-2 px-3 text-slate-700 leading-tight focus:outline-green-400
        }

        .error {
            @apply text-red-400 text-sm py-2
        }
    </style>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @yield('style')
</head>

<body class="container mx-auto my-auto">
    <main class="main-container">
        <h1 class="text-3xl mb-4">@yield('title')</h1>

        <div>
            @yield('content')
        </div>

    </main>
</body>

</html> --}}



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
