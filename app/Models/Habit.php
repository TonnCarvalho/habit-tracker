<?php

namespace App\Models;

use App\Models\HabitLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name'
    ];

    //Um habito pertence a um usuário.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Um habito pode ter muitos registros
    public function habitsLogs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function wasCompletedToday(): bool
    {
        return $this->habitsLogs
            ->where('completed_at', Carbon::today()->toDateString())
            ->isNotEmpty();
    }

    public function wasCompletedOn(Carbon $date): bool
    {
        return  $this->habitsLogs
            ->where('completed_at', $date->toDateString())
            ->isNotEmpty();
    }

    // public funtion avaliableYears()
    // {
    //     return $this->habitsLogs
    //     ->e
    // }

    /**
     * Generate a year grid for the giver year.
     *
     * @param integer $year
     * @return array
     */
    public static function generateYearGrid(int $year): array
    {
        // Primeiro e último dia do ano
        $startDate = Carbon::create($year, 1, 1); // 01/01/YYYY
        $endDate = Carbon::create($year, 12, 31); // 31/12/YYYY

        $weeks = [];
        $currentWeek = [];

        // Preenche dias vazios no início (se o ano não começar no domingo)
        $firstDayOfWeek = $startDate->dayOfWeek; // 0 = domingo, 1 = segunda, etc
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $currentWeek[] = null; // Placeholder vazio
        }

        // Agrupa os dias em semanas (domingo a sábado)
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $currentWeek[] = $date->copy();

            // Fecha a semana no sábado ou no último dia
            if ($date->isSaturday() || $date->eq($endDate)) {
                $weeks[] = $currentWeek;
                $currentWeek = [];
            }
        }

        return $weeks;
    }
}
