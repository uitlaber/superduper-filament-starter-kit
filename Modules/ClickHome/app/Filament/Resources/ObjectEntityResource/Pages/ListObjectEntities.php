<?php

namespace Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectEntities extends ListRecords
{
    protected static string $resource = ObjectEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
