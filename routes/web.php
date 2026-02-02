<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use App\Http\Controllers\SportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TrainingController;

use App\Models\Sport;
use App\Models\Team;
use App\Models\Player;
use App\Models\Training;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            'sports' => Sport::count(),
            'teams' => Team::count(),
            'players' => Player::count(),
            'trainings' => Training::count(),
            'injured_players' => Player::where('injured', true)->count(),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sports', SportController::class)->except(['show']);
    Route::resource('teams', TeamController::class)->except(['show']);
    Route::resource('players', PlayerController::class)->except(['show']);
    Route::resource('trainings', TrainingController::class)->except(['show']);
});

require __DIR__ . '/settings.php';
