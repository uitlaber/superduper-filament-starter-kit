<?php

namespace Modules\ClickHome\Filament\Resources\PropertyResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\ClickHome\Models\Property;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    // protected function handleRecordCreate(Property $record, array $data): Property
    // {

    //     dd($data);
    //     $record->update($data);

    //     return $record;
    // }
}
