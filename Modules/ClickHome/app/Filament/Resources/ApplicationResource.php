<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\ApplicationResource\Pages;
use Modules\ClickHome\Filament\Resources\ApplicationResource\RelationManagers;
use Modules\ClickHome\Models\Application;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\ClickHome\Enums\CurrencyEnum;
use Modules\ClickHome\Enums\PropertyTypeEnum;
use Modules\ClickHome\Models\PropertyGroup;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'заявки';

    protected static ?string $pluralModelLabel = 'заявки';

    protected static ?string $navigationGroup = 'Объекты';

    public static function form(Form $form): Form
    {
        $currencyList =  CurrencyEnum::toArray();

        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основное')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Пользовтаель')
                                    ->required()
                                    ->searchable()
                                    ->relationship(name: 'user', titleAttribute: 'username'),
                                Forms\Components\TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(255)->live(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Описание')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('price')
                                    ->label('Цена')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\Select::make('price_currency')
                                    ->label('Валюта')
                                    ->options($currencyList),
                            ]),
                        Tabs\Tab::make('Параметры')
                            ->hidden(fn (Get $get, string $operation): bool => $operation == 'create')
                            ->schema(
                                function (Get $get, string $operation): array {
                                    $components = [];
                                    $components = self::propertiesSet();

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
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок'),
                Tables\Columns\TextColumn::make('user.firstname')
                    ->label('Пользователь'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата изменения')
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

    public static function propertiesSet(): array
    {
        $components = [];
        $propertyGroups = PropertyGroup::where('type', Application::class)->get();

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
