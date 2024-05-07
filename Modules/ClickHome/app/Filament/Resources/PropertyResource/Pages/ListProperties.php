<?php

namespace Modules\ClickHome\Filament\Resources\PropertyResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;

    public ?string $tableSortColumn = 'order';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
