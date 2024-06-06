<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyValue extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'json'
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'property_id',
        'data'
    ];

    public function properteable()
    {
        return $this->morphTo();
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
