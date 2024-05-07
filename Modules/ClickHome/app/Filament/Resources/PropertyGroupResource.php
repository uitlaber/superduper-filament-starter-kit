<?php

namespace Modules\ClickHome\Filament\Resources;

use Modules\ClickHome\Filament\Resources\PropertyGroupResource\Pages;
use Modules\ClickHome\Filament\Resources\PropertyGroupResource\RelationManagers;
use Modules\ClickHome\Models\PropertyGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Modules\ClickHome\Models\ObjectCategory;

class PropertyGroupResource extends Resource
{
    protected static ?string $model = PropertyGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Группа параметров';

    protected static ?string $pluralModelLabel = 'Группа параметров';

    protected static ?string $navigationGroup = 'ClickHome';

    public static function form(Form $form): Form
    {


        $categoryOptions = [];
        $categoryTree = ObjectCategory::treeNodes();
        foreach ($categoryTree as $category) {
            foreach ($category['children'] as $subCategory) {
                foreach ($subCategory['children'] as $child) {
                    $categoryOptions[$category['title'] . '/' . $subCategory['title']][$child['id']] = $child['title'];
                }
            }
        }
        //   dd($categoryOptions );


        return $form
            ->schema([
                Forms\Components\Select::make('object_category_id')
                    ->label('Категория')
                    ->options($categoryOptions),
                Forms\Components\TextInput::make('name')
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категория')
                    ->description(function (PropertyGroup $record): string {
                       
                        return '';
                    })
                    ->searchable(),
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
            'index' => Pages\ListPropertyGroups::route('/'),
            'create' => Pages\CreatePropertyGroup::route('/create'),
            'edit' => Pages\EditPropertyGroup::route('/{record}/edit'),
        ];
    }
}
