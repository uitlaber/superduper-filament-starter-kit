<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\ClickHome\Models\ObjectEntity;

class ObjectTypeList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public int $categoryId,
        public int $limit
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $objects = ObjectEntity::query()
            ->where('object_category_id', $this->categoryId)->take($this->limit ?? 8)->get();

        return view('components.object-type-list', compact('objects'));
    }
}
