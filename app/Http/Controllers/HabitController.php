<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = auth()->user()->habits;

        return view('habits.habit', compact(
            'habits'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('habits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HabitRequest $request)
    {

        $validated = $request->validated();

        auth()->user()->habits()->create($validated);

        return redirect()->route('habits.index')
            ->with('success', 'Hábito criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Habit $habit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habit $habit)
    {
        return view('habits.edit', compact(
            'habit'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitRequest $request, Habit $habit)
    {
        if ($habit->id != auth()->user()->id) {
            abort(403, 'Esse hábito não é seu');
        }

        $habit->update($request->all());

        return redirect()
            ->route('habits.index')
            ->with('Hábito atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        //Valida se o hábito pertence ao usuário logado
        if ($habit->user_id != auth()->user()->id) {
            abort(403, 'Esse hábito não é seu!');
        }

        //deleta
        $habit->delete($habit->id);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito removido com sucesso!');
    }
}
