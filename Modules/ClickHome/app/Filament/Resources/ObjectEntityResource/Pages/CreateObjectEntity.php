<?php

namespace Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\ClickHome\Models\ObjectEntity;

class CreateObjectEntity extends CreateRecord
{
    protected static string $resource = ObjectEntityResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        dd($data);
      
        $record = new ($this->getModel())($data);

        if (
            static::getResource()::isScopedToTenant() &&
            ($tenant = Filament::getTenant())
        ) {
            return $this->associateRecordWithTenant($record, $tenant);
        }

        $record->save();

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
