<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;
use Modules\ClickHome\Filament\Resources\ObjectEntityResource\RelationManagers;
use Modules\ClickHome\Models\ObjectEntity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectEntityResource extends Resource
{
    protected static ?string $model = ObjectEntity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('object_category_id')
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_settlement')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_street')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_house_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_building_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('price_currency')
                    ->maxLength(255),
                Forms\Components\TextInput::make('youtube_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tour3d_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_id')
                    ->maxLength(36),
                Forms\Components\DateTimePicker::make('start_publish_at'),
                Forms\Components\DateTimePicker::make('end_publish_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('object_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location_settlement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location_street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location_house_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location_building_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('youtube_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tour3d_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_publish_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_publish_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectEntities::route('/'),
            'create' => Pages\CreateObjectEntity::route('/create'),
            'edit' => Pages\EditObjectEntity::route('/{record}/edit'),
        ];
    }
}
