<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
use Illuminate\Container\Container;

class PropertyGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    public function objectCategories(): BelongsToMany
    {
        return $this->belongsToMany(ObjectCategory::class, 'object_category_property_groups', 'property_group_id', 'object_category_id');
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }


    function getModelsUsingTrait(string $traitName)
    {
        $models = collect(File::allFiles(module_path("ClickHome")))
            ->map(function ($item) {
                $path = $item->getPathName();
                $fileName = str_replace(".php", "", $item->getBasename());
                $contents = file_get_contents($path);
                if (preg_match("/namespace\s+(.*?);/s", $contents, $matches)) {
                    return [
                        'name' =>  $matches[1] . "\\" . $fileName,
                        'label' => __('resource.'.$fileName)
                    ];
                }
            })
            ->filter(function ($class) use ($traitName) {
                $valid = false;
                if ($class && class_exists($class['name'])) {
                    $reflection = new \ReflectionClass($class['name']);
                    $valid =
                        in_array($traitName, $reflection->getTraitNames()) &&
                        !$reflection->isAbstract();
                }
                return $valid;
            });

        return $models->values();
    }
}
