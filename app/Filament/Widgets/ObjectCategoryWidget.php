<?php

namespace App\Filament\Widgets;


use Filament\Notifications\Notification;
use Modules\ClickHome\Models\ObjectCategory;
use SolutionForest\FilamentTree\Actions\Action;
use SolutionForest\FilamentTree\Actions\ActionGroup;
use SolutionForest\FilamentTree\Actions\DeleteAction;
use SolutionForest\FilamentTree\Actions\EditAction;
use SolutionForest\FilamentTree\Actions\ViewAction;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;
use Filament\Forms;

class ObjectCategoryWidget extends BaseWidget
{
    protected static string $model = ObjectCategory::class;

    protected static int $maxDepth = 3;

    protected ?string $treeTitle = '';

    protected bool $enableTreeTitle = true;

    protected static bool $isDiscovered = false;

    protected function getFormSchema(): array
    {
        return [
            //
        ];
    }

    protected function getEditFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),
        ];
    }

    // // INFOLIST, CAN DELETE
    // public function getViewFormSchema(): array
    // {
    //     return [
    //         Forms\Components\TextInput::make('title')
    //             ->required()
    //             ->maxLength(255),
    //         Forms\Components\Textarea::make('description')
    //             ->columnSpanFull(),
    //     ];
    // }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }

    // CUSTOMIZE ACTION OF EACH RECORD, CAN DELETE 
    protected function getTreeActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
    // OR OVERRIDE FOLLOWING METHODS
    protected function hasDeleteAction(): bool
    {
        return true;
    }
    protected function hasEditAction(): bool
    {
        return true;
    }
    //protected function hasViewAction(): bool
    //{
    //    return true;
    //}
}
