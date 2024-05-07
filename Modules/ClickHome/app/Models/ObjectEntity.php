<?php

namespace Modules\ClickHome\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\ClickHome\Enums\CurrencyEnum;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class ObjectEntity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, HasTags;

    protected $dates = ['start_publish_at', 'end_publish_at'];

    protected $casts = [
        'price_currency' => CurrencyEnum::class
    ];

    protected $fillable = [
        'title',
        'object_category_id',
        'short_description',
        'description',
        'location',
        'location_settlement',
        'location_street',
        'location_house_number',
        'location_building_number',
        'price',
        'price_currency',
        'youtube_url',
        'tour3d_url',
        'user_id',
        'start_publish_at',
        'end_publish_at',
    ];

    protected $table = 'object_entities';

    public function category(): BelongsTo
    {
        return $this->belongsTo(ObjectCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'object_properties','object_entity_id', 'property_id')->using(ObjectProperty::class)->withTimestamps()->withPivot('data');
    }
}
