<?php

namespace Modules\ClickHome\Filament\Resources\ApplicationResource\Pages;

use Modules\ClickHome\Filament\Resources\ApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\ClickHome\Models\Application;
use Modules\ClickHome\Models\ObjectEntity;
use Modules\ClickHome\Models\PropertyValue;

class EditApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;

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
                if ($property->data == null && empty(trim($property->data))) continue;
                $data = json_decode($property->data, true);
                if (isset($data['value'])) {
                    $properties[$property->property_id]['data'] = $data['value'];
                }
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
        $objectEntity = Application::find($record->id);
        $objectEntity->properties()->delete();

        if (isset($data['properties'])) {
            $properties = [];
            foreach ($data['properties'] as $key => $property) {
                if (isset($property['data'])) {
                    $properties[] = new PropertyValue(
                        [
                            'property_id' => $key,
                            'data' => json_encode(['value' => $property['data']])
                        ]
                    );
                }
            }
            $objectEntity->properties()->saveMany($properties);
        } else {
            $objectEntity->properties()->delete();
        }

        return  $record;
    }
}
