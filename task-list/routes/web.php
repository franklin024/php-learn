<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

//GET routes
Route::get("/", function () {
    return redirect()->route("task.index");
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



//HANDLE 404
Route::fallback(function () {
    return "where r u??";
});
