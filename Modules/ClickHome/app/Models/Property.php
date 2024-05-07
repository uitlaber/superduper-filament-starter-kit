<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function group(): BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(PropertyOption::class);
    }
}
