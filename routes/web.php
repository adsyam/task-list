<?php


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');

Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255', // rules
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save(); //runs an update query to the db

    return redirect()->route('tasks.show', ['id'=> $task->id])
        ->with('success', 'Task created successfully!');

        // with() lets you set some session data
})->name('tasks.store');

Route::put('/tasks/{id}', function ($id, Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        // rules
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::findOrFail($id); // Fetching the task from the db
    $task->title = $data['title']; // modifying
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save(); //runs an update query to the db

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!');

    // with() lets you set some session data
})->name('tasks.update');

Route::fallback(function () {
    return 'Still got somewhere!';
});