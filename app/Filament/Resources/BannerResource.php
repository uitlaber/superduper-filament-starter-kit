<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static int $globalSearchResultsLimit = 20;
    protected static ?string $modelLabel = 'баннер';

    protected static ?string $pluralModelLabel = 'баннеры';

 

    protected static ?int $navigationSort = -1;
    protected static ?string $navigationIcon = 'fluentui-image-shadow-24';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category')
                    ->label('Категория')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sort')
                    ->label('Сортировка')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Описание')
                    ->maxLength(500),
                SpatieMediaLibraryFileUpload::make('media')
                    ->label('Баннер')
                    ->collection('banners')
                    ->multiple()
                    ->reorderable()
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Включен')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Дата публикации'),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('Конец публикации'),
                Forms\Components\TextInput::make('click_url')
                    ->label('Ссылка')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('media')
                    ->label('Баннер')
                    ->collection('banners')
                    ->wrap(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->lineClamp(2)
                    ->description(fn (Model $record): string => $record->description ?? '')->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_active')->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn (string $state, $record) => match ($state) {
                        '' => 'Выключен',
                        '1' => 'Включен',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '' => 'danger',
                        '1' => 'success',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Дата публикации')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Конец публикации')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('click_url')
                    ->label('Ссылка')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'category'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category,
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.sample");
    }
}
