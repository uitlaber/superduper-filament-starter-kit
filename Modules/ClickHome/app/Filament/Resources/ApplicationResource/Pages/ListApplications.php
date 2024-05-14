<?php

namespace Modules\ClickHome\Filament\Resources\ApplicationResource\Pages;

use Modules\ClickHome\Filament\Resources\ApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
