<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\PostResource\Pages;
use App\Models\Blog\Post;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'пост';

    protected static ?string $pluralModelLabel = 'посты';

    protected static ?string $navigationIcon = 'fluentui-news-20';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Картинка')
                    ->label('Картинка')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('media')->hiddenLabel()
                            ->collection('blog/posts')
                            ->multiple()
                            ->reorderable()
                            ->required(),
                    ])
                    ->collapsible(),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->label('Алияс')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true),

                        Forms\Components\MarkdownEditor::make('content')
                            ->label('Описание')
                            ->required()
                            ->columnSpan('full'),

                        Forms\Components\Select::make('blog_author_id')
                            ->label('Автор')
                            ->relationship(
                                name: 'author',
                                modifyQueryUsing: fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', 'admin'),
                            )
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->firstname} {$record->lastname}")
                            ->searchable(['firstname', 'lastname'])
                            ->required(),

                        Forms\Components\Select::make('blog_category_id')
                            ->label('Категория')    
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Дата публикации'),

                        SpatieTagsInput::make('tags')->label('Теги'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('media')->label('Image')
                    ->label('Картинка')
                    ->collection('blog/posts')
                    ->wrap(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Алияс')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Автор')
                    ->searchable(['firstname', 'lastname'])
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->getStateUsing(fn (Post $record): string => $record->published_at?->isPast() ? 'Опубликован' : 'Черновик')
                    ->colors([
                        'success' => 'Опубликован',
                    ]),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->date(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата изменения')
                    ->label('Updated')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel()->tooltip('Посмотреть'),
                Tables\Actions\EditAction::make()->hiddenLabel()->tooltip('Изменить'),
                Tables\Actions\DeleteAction::make()->hiddenLabel()->tooltip('Удалить'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.blog");
    }
}
