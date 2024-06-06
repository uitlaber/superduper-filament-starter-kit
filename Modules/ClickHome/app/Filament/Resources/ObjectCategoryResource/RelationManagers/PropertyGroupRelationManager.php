<?php

namespace Modules\ClickHome\Filament\Resources\ObjectCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyGroupRelationManager extends RelationManager
{
    protected static string $relationship = 'propertyGroups';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'группу параметров';

    protected static ?string $pluralLabel = 'группа параметров';

    protected static ?string $title = 'Группа параметров';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание'),
                Tables\Columns\TextColumn::make('pivot.order')
                    ->label('Сортировка')->numeric(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ])->reorderable('object_category_property_groups.order')
            ->defaultSort('object_category_property_groups.order');;
    }
}
