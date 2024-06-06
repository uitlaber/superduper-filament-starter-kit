<?php

namespace Modules\ClickHome\Models;

use App\Models\User;
use App\Traits\HasProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Maize\Markable\Markable;
use Maize\Markable\Models\Favorite;
use Modules\ClickHome\Enums\CurrencyEnum;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class ObjectEntity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags, HasProperty, Markable;

    protected $dates = ['start_publish_at', 'end_publish_at'];

    protected $casts = [
        'price_currency' => CurrencyEnum::class
    ];

    protected static $marks = [
        Favorite::class,
    ];

    protected $fillable = [
        'title',
        'deal_type',
        'object_category_id',
        'short_description',
        'description',
        'city_id',
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
        return $this->belongsTo(ObjectCategory::class, 'object_category_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(ObjectContact::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Crop, 265, 200)
            ->nonQueued();
    }

    public function cardProperties()
    {
        $propertyIds = Property::query()->where('show_in_card', true)->pluck('id');
     
        return $this->properties()->whereIn('property_id', $propertyIds)->get();
    }
}
