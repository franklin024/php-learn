<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Registered;


Route::middleware('guest')->group(function () {
    // Đăng ký
    Route::view('/register', 'auth.register')->name('register');

    Route::post("/register", function (UserRequest $request) {
        $user = User::create($request->validated());
        event(new Registered($user));

        Auth::login($user);
        $request->session()->regenerate(); // Fix bảo mật session
        return redirect()->route("task.index");
    })->name("register.store");

    // Đăng nhập
    Route::view('/login', 'auth.login')->name('login');

    Route::post('/login', function (LoginRequest $request) {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('task.index')->with('success', 'Đăng nhập thành công!');
        }
        return back()->withErrors(['email' => 'Thông tin không chính xác.'])->onlyInput('email');
    })->name('login.store');
});

/*
|--------------------------------------------------------------------------
| 2. NHÓM AUTH (Phải đăng nhập mới được vào)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Đăng xuất
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đã đăng xuất!');
    })->name('logout');

    // Trang chủ: Điều hướng
    Route::get("/", function () {
        return redirect()->route("task.index");
    });

    // 1. Danh sách (FIX LỖI 1: Chỉ lấy task của user hiện tại)
    Route::get("/tasks", function (Request $request) {
        return view("index", [
            // CŨ (SAI): Task::latest()... -> Lấy hết của mọi người
            // MỚI (ĐÚNG): $request->user()->tasks()... -> Chỉ lấy của mình
            "tasks" => $request->user()->tasks()->latest()->paginate(7),
        ]);
    })->name("task.index");

    // 2. Form tạo mới
    Route::view("/tasks/create", "create")->name("task.create");

    // 3. Form sửa (FIX LỖI 2: Chặn xem trộm)
    Route::get("/tasks/{task}/edit", function (Task $task) {
        // Kiểm tra: Nếu ID chủ task KHÁC ID người đang login -> Chặn
        if ((int)$task->user_id !== (int)Auth::id()) abort(403);

        return view("edit", ["task" => $task]);
    })->name("task.edit");

    // 4. Xem chi tiết (FIX LỖI 2)
    Route::get("/tasks/{task}", function (Task $task) {
        if ((int)$task->user_id !== (int)Auth::id()) abort(403);

        return view("show", ["task" => $task]);
    })->name("task.show");

    // 5. Lưu mới (Đoạn này bạn viết ĐÚNG rồi)
    Route::post("/tasks", function (TaskRequest $request) {
        $task = $request->user()->tasks()->create($request->validated());

        return redirect()->route("task.show", ["task" => $task])
            ->with("success", "Đã tạo thành công");
    })->name("task.store");

    // 6. Cập nhật (FIX LỖI 2)
    Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {
        if ((int)$task->user_id !== (int)Auth::id()) abort(403);

        $task->update($request->validated());

        return redirect()->route("task.show", ["task" => $task])
            ->with("success", "Đã sửa thành công");
    })->name("task.update");

    // 7. Xóa (FIX LỖI 2)
    Route::delete("/tasks/{task}", function (Task $task) {
        if ((int)$task->user_id !== (int)Auth::id()) abort(403);

        $task->delete();

        return redirect()->route("task.index")->with("success", "Đã xoá task thành công!");
    })->name("task.destroy");

    // 8. Toggle (FIX LỖI 2 & FIX LỖI 3 URL)
    // Sửa URL từ /task/ thành /tasks/ cho đồng bộ
    Route::put("/tasks/{task}/toggle-complete", function (Task $task) {
        if ((int)$task->user_id !== (int)Auth::id()) abort(403);

        $task->toggleComplete();
        return redirect()->back()->with("success", "Đã cập nhật!!!");
    })->name("task.toggle-complete");
});


////////////
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Xử lý link xác nhận trong email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('task.index')->with('success', 'Email đã xác thực!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Gửi lại email
Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Đã gửi lại link xác thực!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Xử lý 404
Route::fallback(function () {
    return "Lạc đường rồi bạn ơi";
});
