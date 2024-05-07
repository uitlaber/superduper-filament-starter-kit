<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class ObjectEntity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, HasTags;

    protected $fillable = [];

    protected $table = 'object_entities';

    public function category(): BelongsTo
    {
        return $this->belongsTo(ObjectCategory::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(ObjectProperty::class)
            ->using(ObjectProperty::class)
            ->withTimestamps()->withPivot('data');
    }
}
