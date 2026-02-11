<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
