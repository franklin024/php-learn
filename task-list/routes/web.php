<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;

//GET routes
Route::get("/", function () {
    if (Auth::check()) {
        return redirect()->route("task.index");
    } else {
        return redirect()->route("login");
    }
});

Route::get("/tasks", function () {
    return view("index", [
        "tasks" => Task::latest()->paginate(7),
    ]);
})->name("task.index");

Route::view("/tasks/create", "create")
    ->name("task.create");

Route::get("/tasks/{task}/edit", function (Task $task) {
    return view("edit", ["task" => $task]);
})->name("task.edit");

//hiển thị task
Route::get("/tasks/{task}", function (Task $task) {
    return view(
        "show",
        ["task" => $task]
    );
})->name("task.show");


//tạo task
Route::post("/tasks", function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route("task.show", ["task" => $task])
        ->with("success", "đã tạo thành công");
})->name("task.store");

//cập nhật task
Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route("task.show", ["task" => $task])
        ->with("success", "đã sửa thành công");
})->name("task.update");

Route::delete("/tasks/{task}", function (Task $task) {
    $task->delete();

    return redirect()->route("task.index", ["task" => $task])->with("success", "đã xoá task thành công!");
})->name("task.destroy");


Route::put("/task/{task}/toggle-complete", function (Task $task) {

    $task->toggleComplete();
    return redirect()->back()->with("success", "đã cập nhật!!!");
})->name("task.toggle-complete");

Route::view('/register', 'auth.register')->name('register');
Route::post("/register", function (UserRequest $request) {
    $user = User::create($request->validated());

    Auth::login($user);

    $request->session()->regenerate();

    return redirect()->route("task.index");
})->name("register.store");


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', function (LoginRequest $request) {
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('task.index')
            ->with('success', 'Đăng nhập thành công!');
    }

    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không chính xác.',
    ])->onlyInput('email');
})->name('login.store');

//HANDLE 404
Route::fallback(function () {
    return "where r u??";
});
