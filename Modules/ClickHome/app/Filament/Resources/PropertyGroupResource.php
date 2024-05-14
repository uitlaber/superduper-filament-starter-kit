<?php

namespace Modules\ClickHome\Filament\Resources;

use App\Traits\HasProperty;
use Modules\ClickHome\Filament\Resources\PropertyGroupResource\Pages;
use Modules\ClickHome\Filament\Resources\PropertyGroupResource\RelationManagers;
use Modules\ClickHome\Models\PropertyGroup;
use Filament\Tables\Grouping\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Concerns\HasTabs;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Modules\ClickHome\Models\ObjectCategory;

class PropertyGroupResource extends Resource
{

    
    protected static ?string $model = PropertyGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'группа';

    protected static ?string $pluralModelLabel = 'группа';

    protected static ?string $navigationGroup = 'Параметры';




    public static function form(Form $form): Form
    {

        $types = (new PropertyGroup)->getModelsUsingTrait(HasProperty::class)->pluck('label', 'name');

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Тип')->options($types),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $types = (new PropertyGroup)->getModelsUsingTrait(HasProperty::class)->pluck('label', 'name');

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->formatStateUsing(fn (string $state): string => __($types[$state]))
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
            ->groups([
                Group::make('type')
                    ->label('Тип')
                    ->collapsible(),
            ])
            ->reorderable('order')
            ->filters([
                SelectFilter::make('type')
                    ->options($types)
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
