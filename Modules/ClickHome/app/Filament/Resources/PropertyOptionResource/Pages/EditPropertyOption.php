<?php

namespace Modules\ClickHome\Filament\Resources\PropertyOptionResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPropertyOption extends EditRecord
{
    protected static string $resource = PropertyOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
