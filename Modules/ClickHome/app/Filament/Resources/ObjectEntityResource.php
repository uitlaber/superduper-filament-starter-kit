<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\ObjectEntityResource\Pages;
use Modules\ClickHome\Models\ObjectEntity;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
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

        $currencyList =  CurrencyEnum::toArray();
        $categoryOptions = [];
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
                                        ->label('Заголовок')
                                        ->maxLength(255)->live(),
                                    Forms\Components\Select::make('object_category_id')
                                        ->label('Категория')
                                        ->options($categoryOptions)->live(),
                                    Forms\Components\Select::make('user_id')
                                        ->label('Пользовтаель')
                                        ->searchable()
                                        ->relationship(name: 'user', titleAttribute: 'username'),
                                ]),
                                Forms\Components\Textarea::make('short_description')
                                    ->label('Короткое описание')
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Описание')
                                    ->columnSpanFull(),
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('price')
                                        ->label('Цена')
                                        ->numeric()
                                        ->prefix('$'),
                                    Forms\Components\Select::make('price_currency')
                                        ->label('Валюта')
                                        ->options($currencyList),
                                    Forms\Components\TextInput::make('youtube_url')
                                        ->label('Ссылка на Youtube')
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('tour3d_url')
                                        ->label('Ссылка на 3D тур')
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->maxLength(255),
                                ]),
                                Grid::make(2)->schema([
                                    Forms\Components\DateTimePicker::make('start_publish_at')
                                        ->label('Начало публикации'),
                                    Forms\Components\DateTimePicker::make('end_publish_at')
                                        ->label('Конец публикации'),
                                ])
                            ]),
                        Tabs\Tab::make('Адрес и контакты')
                            ->schema([
                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('location')
                                        ->label('Координаты')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('location_settlement')
                                        ->label('Регион')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('location_street')
                                        ->label('Улица')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('location_house_number')
                                        ->label('Номер дома')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('location_building_number')
                                        ->label('Номер здания')
                                        ->maxLength(255),
                                ]),
                                Repeater::make('contacts')->relationship()
                                    ->label('Контакты')
                                    ->reorderable()
                                    ->orderColumn('order')
                                    ->schema([
                                        TextInput::make('phone')->label('Номер телефона'),
                                        TextInput::make('name')->label('Имя'),
                                        TextInput::make('email')->email()->label('Email'),
                                    ])
                                    ->columns(3)

                            ]),

                        Tabs\Tab::make('Фото')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->label('Фото')
                                    ->collection('photos')
                                    ->multiple()
                                    ->reorderable()
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Параметры')
                            ->hidden(fn (Get $get, string $operation): bool => ($operation == 'create' || $operation == 'create'  && $get('object_category_id') == null))
                            ->schema(
                                function (Get $get, string $operation): array {
                                    $components = [];
                                    $components = self::objectPropertiesSet($get('object_category_id'));

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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категория')
                    ->description(function (ObjectEntity $record): string {
                        $categoryTreeText = '';
                        $categoryTree = ObjectCategory::treeNodes();
                        foreach ($categoryTree as $category) {
                            foreach ($category['children'] as $subCategory) {
                                foreach ($subCategory['children'] as $child) {
                                    if ($child['id'] == $record->id) {
                                        $categoryTreeText = $category['title'] . '/' . $subCategory['title'];
                                        continue;
                                    }
                                }
                            }
                        }

                        return $categoryTreeText;
                    })
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


    public static function objectPropertiesSet(?int $categoryId): array
    {
        if (is_null($categoryId)) return [];
        $components = [];
        $propertyGroups = PropertyGroup::query()
            ->where('object_category_id', $categoryId)->get();

        foreach ($propertyGroups as $group) {
            $childComponents = [];
            foreach ($group->properties->sortBy('order') as $property) {

                $dataKey = 'properties.' . $property->id . '.data';

                $valueComponent = TextInput::make($dataKey)->label($property->name);

                switch ($property->type->value) {
                    case PropertyTypeEnum::CHECKBOX->value:
                        $valueComponent = Select::make($dataKey)
                            ->multiple()
                            ->searchable(false)
                            ->options($property->options()->pluck('value', 'id'))->label($property->name);
                        break;
                    case PropertyTypeEnum::RADIO->value:
                        $valueComponent = Select::make($dataKey)
                            ->options($property->options()->pluck('value', 'id'))->label($property->name);
                        break;
                    case PropertyTypeEnum::SWITCH->value:
                        $valueComponent = Toggle::make($dataKey)->label($property->name);
                        break;
                }

                $childComponents[] = $valueComponent;
            }

            $components[] = Fieldset::make($group->name)->schema($childComponents)->columns(2);
        }


        return $components;
    }
}
