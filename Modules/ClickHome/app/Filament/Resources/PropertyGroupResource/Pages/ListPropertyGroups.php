<?php

namespace Modules\ClickHome\Filament\Resources\PropertyGroupResource\Pages;

use App\Traits\HasProperty;
use Modules\ClickHome\Filament\Resources\PropertyGroupResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\ClickHome\Models\PropertyGroup;

class ListPropertyGroups extends ListRecords
{
    protected static string $resource = PropertyGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    
    public function getTabs(): array
    {
        $tabs = [];

        $types = (new PropertyGroup)->getModelsUsingTrait(HasProperty::class);

        foreach($types as $type) {
            $tabs[$type['label']] = Tab::make($type['label'])
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', $type['name']));
        }

        return $tabs;
    }

    public function activeTab()
    {
        $types = (new PropertyGroup)->getModelsUsingTrait(HasProperty::class);
        return $types->first()['label'];
    }
}
