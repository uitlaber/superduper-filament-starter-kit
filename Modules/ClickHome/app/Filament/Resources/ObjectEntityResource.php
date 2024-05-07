<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;
use Modules\ClickHome\Models\ObjectEntity;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Modules\ClickHome\Enums\CurrencyEnum;
use Modules\ClickHome\Enums\PropertyTypeEnum;
use Modules\ClickHome\Models\ObjectCategory;
use Modules\ClickHome\Models\PropertyGroup;

class ObjectEntityResource extends Resource
{
    protected static ?string $model = ObjectEntity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'объект';

    protected static ?string $pluralModelLabel = 'объекты';

    protected static ?string $navigationGroup = 'ClickHome';

    public static function form(Form $form): Form
    {
        $categoryOptions = [];
        $currencyList =  CurrencyEnum::toArray();
        $categoryTree = ObjectCategory::treeNodes();
        foreach ($categoryTree as $category) {
            foreach ($category['children'] as $subCategory) {
                foreach ($subCategory['children'] as $child) {
                    $categoryOptions[$category['title'] . '/' . $subCategory['title']][$child['id']] = $child['title'];
                }
            }
        }


        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основное')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->maxLength(255)->live(),
                                    Forms\Components\Select::make('object_category_id')
                                        ->label('Категория')
                                        ->options($categoryOptions)->live(),
                                    Forms\Components\Select::make('user_id')
                                        ->searchable()
                                        ->relationship(name: 'user', titleAttribute: 'username'),
                                ]),
                                Forms\Components\Textarea::make('short_description')
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('description')
                                    ->columnSpanFull(),
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('price')
                                        ->numeric()
                                        ->prefix('$'),
                                    Forms\Components\Select::make('price_currency')
                                        ->label('Валюта')
                                        ->options($currencyList),
                                    Forms\Components\TextInput::make('youtube_url')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('tour3d_url')
                                        ->maxLength(255),
                                ]),
                                Grid::make(2)->schema([
                                    Forms\Components\DateTimePicker::make('start_publish_at'),
                                    Forms\Components\DateTimePicker::make('end_publish_at'),
                                ])
                            ]),
                        Tabs\Tab::make('Адрес')
                            ->schema([
                                Grid::make(2)->schema([
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
                                ])
                            ]),
                        Tabs\Tab::make('Параметры')

                            ->schema(
                                function (Get $get): array {
                                    $components = [];
                                    if ($get('object_category_id')) {
                                        $components = self::objectPropertiesSet($get('object_category_id'));
                                    }

                                    return $components;
                                }

                            ),
                    ])->columnSpanFull(),



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


    public static function objectPropertiesSet(int $categoryId): array
    {
        $components = [];
        $propertyGroups = PropertyGroup::query()
            ->where('object_category_id', $categoryId)->get();

        foreach ($propertyGroups as $group) {
            $childComponents = [];
            foreach ($group->properties->sortBy('order') as $property) {

                $dataKey = 'properties.' . $property->id . '.data';

                $valueComponent = TextInput::make($dataKey)->label('');

                switch ($property->type->value) {
                    case PropertyTypeEnum::CHECKBOX->value:
                        $valueComponent = Select::make($dataKey)
                            ->multiple()
                            ->options($property->options()->pluck('value', 'id'))->label('');
                        break;
                    case PropertyTypeEnum::RADIO->value:
                        $valueComponent = Select::make($dataKey)
                            ->options($property->options()->pluck('value', 'id'))->label('');
                        break;
                    case PropertyTypeEnum::SWITCH->value:
                        $valueComponent = Toggle::make($dataKey)->label('');
                        break;
                }

                $childComponents[] = Grid::make(2)->schema([
                    Placeholder::make($property->name),
                    $valueComponent
                ]);
            }

            $components[] = Section::make($group->name)->schema($childComponents);
        }


        return $components;
    }
}
