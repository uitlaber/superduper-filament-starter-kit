<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function objectCategories(): BelongsToMany
    {
        return $this->belongsToMany(ObjectCategory::class, 'object_category_property_groups', 'property_group_id', 'object_category_id');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
