<?php

namespace Modules\ClickHome\Filament\Resources\PropertyResource\Pages;

use Modules\ClickHome\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\ClickHome\Models\Property;
use Modules\ClickHome\Models\PropertyOption;

class EditProperty extends EditRecord
{
    protected static string $resource = PropertyResource::class;

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {

    //     // dd($record);
    //     // if (!isset($data['options'])) {
    //     //     $record->options()->delete();
    //     // }
    //     $record->update($data);

    //     return $record;
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
