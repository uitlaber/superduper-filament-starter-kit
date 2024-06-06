<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ClickHome\Database\Factories\CityFactory;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'parent_id',
        'slug'
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // protected static function newFactory(): CityFactory
    // {
    //     //return CityFactory::new();
    // }
}
