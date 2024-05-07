<?php

namespace Modules\ClickHome\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ObjectProperty extends Pivot
{
    public $incrementing = true;

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    protected $fillable = [
        'data'
    ];

    protected $table = 'object_properties';
}
