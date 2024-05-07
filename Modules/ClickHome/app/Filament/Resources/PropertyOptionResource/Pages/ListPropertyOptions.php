<?php

namespace Modules\ClickHome\Filament\Resources\PropertyOptionResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPropertyOptions extends ListRecords
{
    protected static string $resource = PropertyOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
