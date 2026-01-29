<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlayerController extends Controller
{
    public function index()
    {
        return Inertia::render('Players/Index', [
            'players' => Player::query()
                ->with(['team:id,name', 'team.sport:id,name'])
                ->orderBy('name')
                ->get(['id', 'team_id', 'name', 'injured']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Players/Create', [
            'teams' => Team::query()
                ->with('sport:id,name')
                ->orderBy('name')
                ->get(['id', 'sport_id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => ['required', 'exists:teams,id'],
            'name' => ['required', 'string', 'max:255'],
            'injured' => ['boolean'],
            'notes' => ['nullable', 'string'],
            'jersey_number' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $validated['injured'] = (bool) ($validated['injured'] ?? false);

        Player::create($validated);

        return redirect('/players');
    }

    public function edit(Player $player)
    {
        return Inertia::render('Players/Edit', [
            'player' => $player->only('id', 'team_id', 'name', 'injured', 'notes', 'jersey_number'),
            'teams' => Team::query()
                ->with('sport:id,name')
                ->orderBy('name')
                ->get(['id', 'sport_id', 'name']),
        ]);
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'team_id' => ['required', 'exists:teams,id'],
            'name' => ['required', 'string', 'max:255'],
            'injured' => ['boolean'],
            'notes' => ['nullable', 'string'],
            'jersey_number' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $validated['injured'] = (bool) ($validated['injured'] ?? false);

        $player->update($validated);

        return redirect('/players');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect('/players');
    }
}
