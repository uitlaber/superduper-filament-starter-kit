<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DealType extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    public function objectCategories() : BelongsToMany
    {
        return $this->belongsToMany(ObjectCategory::class, 'object_category_deal_types', 'deal_type_id', 'object_category_id');
    }
}
