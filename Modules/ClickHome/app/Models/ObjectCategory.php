<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class ObjectCategory extends Model
{
    use ModelTree;

    protected $fillable = ["parent_id", "title", "order", "description"];

    protected $table = 'object_categories';

    public function propertyGroups(): BelongsToMany
    {
        return $this->belongsToMany(PropertyGroup::class, 'object_category_property_groups', 'object_category_id', 'property_group_id')->withPivot('order');
    }

    public function dealTypes(): BelongsToMany
    {
        return $this->belongsToMany(DealType::class, 'object_category_deal_types', 'object_category_id', 'deal_type_id');
    }

}
