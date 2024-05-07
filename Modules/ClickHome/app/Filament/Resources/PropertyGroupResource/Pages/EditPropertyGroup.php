<?php

namespace Modules\ClickHome\Filament\Resources\PropertyGroupResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPropertyGroup extends EditRecord
{
    protected static string $resource = PropertyGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
