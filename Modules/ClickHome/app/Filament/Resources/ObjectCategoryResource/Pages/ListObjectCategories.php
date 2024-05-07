<?php

namespace Modules\ClickHome\Filament\Resources\ObjectCategoryResource\Pages;

use App\Filament\Widgets\ObjectCategoryWidget;
use Modules\ClickHome\Filament\Resources\ObjectCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectCategories extends ListRecords
{
    protected static string $resource = ObjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ObjectCategoryWidget::class
        ];
    }
}
