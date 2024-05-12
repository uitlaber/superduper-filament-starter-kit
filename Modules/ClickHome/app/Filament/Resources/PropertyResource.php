<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\PropertyResource\Pages;
use Modules\ClickHome\Filament\Resources\PropertyResource\RelationManagers;
use Modules\ClickHome\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\ClickHome\Enums\PropertyTypeEnum;
use ReflectionClass;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Параметр';

    protected static ?string $pluralModelLabel = 'Параметры';

    protected static ?string $navigationGroup = 'Параметры';


    public static function form(Form $form): Form
    {

        $propertyTypes = PropertyTypeEnum::toArray();


        return $form
            ->schema([               
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('property_group_id')
                    ->label('Группа')
                    ->required()
                    ->searchable()
                    ->relationship(name: 'group', titleAttribute: 'name'),
                Forms\Components\TextInput::make('label')
                    ->label('Подсказка')
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->label('Тип параметра')
                    ->required()
                    ->options($propertyTypes)->live(),

                Forms\Components\Toggle::make('is_required')
                    ->label('Объязательный параметр?')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Repeater::make('options')
                    ->visible(fn (Get $get): bool => ($get('type') == PropertyTypeEnum::RADIO->value || $get('type') == PropertyTypeEnum::CHECKBOX->value))
                    ->relationship(name: 'options')
                    ->label('Значение')
                    ->schema([
                        TextInput::make('value')->required(),
                        TextInput::make('options.icon'),
                    ])->columns(2)->columnSpanFull()->orderColumn('order')             
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Подсказка')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_required')
                    ->label('Объязательный параметр?'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата изменения')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order')
                    ->label('Сортировка')
                    ->sortable(),
            ])
            ->groups([
                Group::make('group.name')
                    ->label('Группа')
                    // ->orderQueryUsing(fn (Builder $query, string $direction) => $query->orderBy('order', $direction))
                    ->collapsible(),
            ])
            ->reorderable('order')
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
