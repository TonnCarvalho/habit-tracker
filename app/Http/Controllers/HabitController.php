<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HabitController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Auth::user()->habits()
            ->with('habitsLogs')
            ->get();

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
        $this->authorize('update', $habit);
        return view('habits.edit', compact(
            'habit'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitRequest $request, Habit $habit)
    {

        $this->authorize('update', $habit);
        // if ($habit->id != Auth::user()->id) {
        //     abort(403, 'Esse hábito não é seu');
        // }

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
        $this->authorize('delete', $habit);

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
        $this->authorize('toggle', $habit);

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

    public function history(Habit $habit): View
    {
        //Trazer o ano atual
        $selectedYear = Carbon::now()->year;

        //Setar inicio e fim do ano
        $startDate = Carbon::create($selectedYear, 1, 1);
        $endDate = Carbon::create($selectedYear, 12, 31, 23, 59, 59);

        //Trazer os hábitos com os logs filtrados por ano atual
        $habits = Auth::user()->habits()
            ->with(['habitsLogs' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('completed_at', [$startDate, $endDate]);
            }])
            ->get();

        return view('habits.history', compact([
            'selectedYear',
            'habits'
        ]));
    }
}
