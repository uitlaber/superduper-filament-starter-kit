<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\ClickHome\Models\PropertyValue;

trait HasProperty
{ 
    public function properties(): MorphMany
    {
        return $this->morphMany(PropertyValue::class, 'properteable');
    }
}
