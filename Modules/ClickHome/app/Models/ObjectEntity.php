<?php

namespace Modules\ClickHome\Models;

use App\Models\User;
use App\Traits\HasProperty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\ClickHome\Enums\CurrencyEnum;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class ObjectEntity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, HasTags, HasProperty;

    protected $dates = ['start_publish_at', 'end_publish_at'];

    protected $casts = [
        'price_currency' => CurrencyEnum::class
    ];

    protected $fillable = [
        'title',
        'deal_type',
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
        return $this->belongsTo(ObjectCategory::class, 'object_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(ObjectContact::class);
    }
}
