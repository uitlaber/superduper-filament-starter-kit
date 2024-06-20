<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\ObjectCategoryResource\Pages;
use Modules\ClickHome\Filament\Resources\ObjectCategoryResource\RelationManagers;
use Modules\ClickHome\Models\ObjectCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\ClickHome\Filament\Resources\ObjectCategoryResource\RelationManagers\DealTypeRelationManager;
use Modules\ClickHome\Filament\Resources\ObjectCategoryResource\RelationManagers\PropertyGroupRelationManager;

class ObjectCategoryResource extends Resource
{
    protected static ?string $model = ObjectCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'категории';

    protected static ?string $pluralModelLabel = 'категории';

    protected static ?string $navigationGroup = 'Объекты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('title')
                //     ->label('Название')
                //     ->searchable(),
                // // Tables\Columns\TextColumn::make('parent_id')
                // //     ->numeric()
                // //     ->sortable(),

                    
                // // Tables\Columns\TextColumn::make('order')
                // //     ->numeric()
                // //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            // ->filters([
            //     //
            // ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [
            PropertyGroupRelationManager::class,
            DealTypeRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectCategories::route('/'),
            'create' => Pages\CreateObjectCategory::route('/create'),
            'edit' => Pages\EditObjectCategory::route('/{record}/edit'),
        ];
    }
}
