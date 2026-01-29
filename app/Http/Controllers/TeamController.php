<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        return Inertia::render('Teams/Index', [
            'teams' => Team::query()
                ->with('sport:id,name')
                ->orderBy('name')
                ->get(['id', 'sport_id', 'name']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Teams/Create', [
            'sports' => Sport::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sport_id' => ['required', 'exists:sports,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        Team::create($validated);

        return redirect()->route('teams.index');
    }

    public function edit(Team $team)
    {
        return Inertia::render('Teams/Edit', [
            'team' => $team->only('id', 'sport_id', 'name'),
            'sports' => Sport::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'sport_id' => ['required', 'exists:sports,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team->update($validated);

        return redirect()->route('teams.index');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
