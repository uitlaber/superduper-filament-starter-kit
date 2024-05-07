<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ClickHome\Database\Factories\PropertyOptionFactory;

class PropertyOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PropertyOptionFactory
    {
        //return PropertyOptionFactory::new();
    }
}
