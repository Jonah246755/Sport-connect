<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Training;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrainingController extends Controller
{
    public function index()
    { 
        return Inertia::render('Trainings/Index', [
            'trainings' => Training::query()
                ->with('team:id,name')
                ->orderByDesc('starts_at')
                ->get(['id', 'team_id', 'starts_at', 'location']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Trainings/Create', [
            'teams' => Team::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => ['required', 'exists:teams,id'],
            'starts_at' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        Training::create($validated);

        return redirect()->route('trainings.index');
    }

    public function edit(Training $training)
    {
        return Inertia::render('Trainings/Edit', [
            'training' => [
                'id' => $training->id,
                'team_id' => $training->team_id,
                'starts_at' => optional($training->starts_at)->format('Y-m-d\TH:i'),
                'location' => $training->location,
                'notes' => $training->notes,
            ],
            'teams' => Team::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'team_id' => ['required', 'exists:teams,id'],
            'starts_at' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $training->update($validated);

        return redirect()->route('trainings.index');
    }

    public function destroy(Training $training)
    {
        $training->delete();

        return redirect()->route('trainings.index');
    }
}
