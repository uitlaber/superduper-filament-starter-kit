<?php

namespace Modules\ClickHome\Filament\Resources\ObjectCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DealTypeRelationManager extends RelationManager
{
    protected static string $relationship = 'dealTypes';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = 'тип сделки';

    protected static ?string $pluralLabel = 'тип сделки';

    protected static ?string $title = 'Тип сделки';

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
                Tables\Columns\TextColumn::make('slug')
                    ->label('Название'),
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
            ]);
    }
}
