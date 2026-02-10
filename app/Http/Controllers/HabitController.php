<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\View\View;
use App\Http\Requests\HabitRequest;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Auth::user()->habits;

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

        Auth::user()->habits()->create($validated);

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
        if ($habit->id != Auth::user()->id) {
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
        if ($habit->user_id != Auth::user()->id) {
            abort(403, 'Esse hábito não é seu!');
        }

        //deleta
        $habit->delete($habit->id);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito removido com sucesso!');
    }

    public function habtisSettings()
    {
        $habits = Auth::user()->habits;
        return view('habits.settings', compact(
            'habits'
        ));
    }
    public function toggle(Habit $habit)
    {
        //Verifica se o usuário autenticado é dono do hábito
        if ($habit->user_id != Auth::user()->id) {
            abort(403, 'Esse hábito não é seu');
        }

        //Pega a data de hoje
        $today = Carbon::today()->toDateString();

        //Pega o log
        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->where('completed_at', $today)
            ->first();

        //Validar se nessa data já existe um registro.
        if ($log) {
            //Se existir remove o registro
            $log->delete();
            $message = 'Hábito desmarcado';
        } else {
            //Se não existir, cria um registro
            HabitLog::create([
                'user_id' => Auth::user()->id,
                'habit_id' => $habit->id,
                'completed_at' => $today
            ]);
            $message = 'Hábito concluido 👏🏽';
        }
        //Retorna para a página anterior
        return redirect()
            ->route('habits.index')
            ->with('success', $message);
    }
}
