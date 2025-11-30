<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task list app</title>
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-500 hover:bg-blue-100
        }


        .btn.danger {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-500 hover:bg-red-100
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @yield('style')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <main class="main-container">
        <h1 class="text-3xl mb-4">@yield('title')</h1>

        <div>
            @yield('content')
        </div>

    </main>
</body>

</html>
