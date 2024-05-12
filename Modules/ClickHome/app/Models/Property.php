<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\ClickHome\Enums\PropertyTypeEnum;

class Property extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => PropertyTypeEnum::class,
        'is_required' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'label',
        'description',
        'type',
        'order',
        'property_group_id',
        'is_required'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class, 'property_group_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(PropertyOption::class);
    }
}
