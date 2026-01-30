<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habit extends Model
{
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
}
