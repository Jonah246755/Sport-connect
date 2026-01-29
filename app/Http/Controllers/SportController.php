<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SportController extends Controller
{
    public function index()
    {
        return Inertia::render('Sports/Index', [
            'sports' => Sport::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Sports/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sports,name'],
        ]);

        Sport::create($validated);

        return redirect()->route('sports.index');
    }

    public function edit(Sport $sport)
    {
        return Inertia::render('Sports/Edit', [
            'sport' => $sport->only('id', 'name'),
        ]);
    }

    public function update(Request $request, Sport $sport)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sports,name,' . $sport->id],
        ]);

        $sport->update($validated);

        return redirect()->route('sports.index');
    }

    public function destroy(Sport $sport)
    {
        $sport->delete();

        return redirect()->route('sports.index');
    }
}
