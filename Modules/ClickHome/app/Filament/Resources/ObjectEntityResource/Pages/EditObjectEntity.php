<?php

namespace Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\ClickHome\Models\ObjectEntity;

class EditObjectEntity extends EditRecord
{
    protected static string $resource = ObjectEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }   

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        if ($this->record->properties->count()) {
            $properties = [];

            foreach ($this->record->properties as $property) {
                $properties[$property->id]['data'] = json_decode($property->pivot->data, true)['value'];
            }

            $this->record->properties = $properties;
        }

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $objectEntity = ObjectEntity::find($record->id);

        if (isset($data['properties'])) {
            $properties = $data['properties'];
            foreach ($properties as $key => $property) {
                $properties[$key]['data'] = json_encode(
                    ['value' => $properties[$key]['data']]
                );
            }
            $objectEntity->properties()->sync($properties);
        } else {
            $objectEntity->properties()->detach();
        }

        return  $record;
    }
}
