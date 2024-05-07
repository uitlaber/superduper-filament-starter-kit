<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'object_category_id',
        'name',
        'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ObjectCategory::class, 'object_category_id');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
