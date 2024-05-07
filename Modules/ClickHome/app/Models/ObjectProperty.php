<?php

namespace Modules\ClickHome\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ObjectProperty extends Pivot
{
    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    protected $table = 'object_properties';
}
