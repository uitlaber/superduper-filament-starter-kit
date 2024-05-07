<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ClickHome\Database\Factories\ObjectContactFactory;

class ObjectContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): ObjectContactFactory
    {
        //return ObjectContactFactory::new();
    }
}
