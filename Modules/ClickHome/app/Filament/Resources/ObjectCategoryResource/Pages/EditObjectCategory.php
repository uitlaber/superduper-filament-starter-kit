<?php

namespace Modules\ClickHome\Filament\Resources\ObjectCategoryResource\Pages;

use Modules\ClickHome\Filament\Resources\ObjectCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectCategory extends EditRecord
{
    protected static string $resource = ObjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
