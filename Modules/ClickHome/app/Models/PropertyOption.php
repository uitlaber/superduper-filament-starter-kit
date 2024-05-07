<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ClickHome\Database\Factories\PropertyOptionFactory;

class PropertyOption extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'value',
        'options',
        'property_id',
        'order'
    ];
}
