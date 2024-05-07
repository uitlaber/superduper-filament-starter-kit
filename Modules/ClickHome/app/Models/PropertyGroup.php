<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ClickHome\Database\Factories\PropertyGroupFactory;

class PropertyGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PropertyGroupFactory
    {
        //return PropertyGroupFactory::new();
    }
}
