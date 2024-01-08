<?php

use App\Http\Controllers\HabitLogController;
use App\Http\Controllers\HabitLogsController;
use App\Http\Controllers\HabitsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Habits routes
Route::prefix('/habits')->group(
    function () {
        Route::get('/', [HabitsController::class, 'index'])->name('habits.index');
        Route::get('/create', [HabitsController::class, 'create'])->name('habits.create');
        Route::get('/{id}', [HabitsController::class, 'show'])->name('habits.show');
        Route::post('/{id}/log', [HabitLogsController::class, 'index'])->name('habits.log');
        Route::post('/', [HabitsController::class, 'store'])->name(('habits.store'));
        Route::get('/edit/{id}', [HabitsController::class, 'edit'])->name(('habits.edit'));
        Route::patch('/{id}', [HabitsController::class, 'update'])->name('habits.update');
        Route::delete('/{id}', [HabitsController::class, 'destroy'])->name('habits.destroy');

        //Log-related routes
        Route::patch('/{id}/check/{date?}', [HabitLogsController::class, 'check'])->name('habits.check');
    }
);

//Auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/habits', [HabitsController::class, 'index'])->name('habits.index');
    Route::get('/create', [HabitsController::class, 'create'])->name('habits.create');
});


require __DIR__ . '/auth.php';
