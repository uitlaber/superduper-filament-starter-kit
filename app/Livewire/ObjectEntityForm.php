<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\ClickHome\Enums\DealTypeEnum;
use Modules\ClickHome\Models\DealType;
use Modules\ClickHome\Models\ObjectCategory;

class ObjectEntityForm extends Component
{
    public $selectedDealType = null;
    public $selectedCategory = null;
    public $categoryOptions = [];
    public $dealTypes = [];

    public function mount()
    {

        $this->dealTypes = DealType::pluck('name', 'id')->toArray();
    }

    public function updatedSelectedDealType($value)
    {
        $categoryTree = ObjectCategory::treeNodes();
        foreach ($categoryTree as $category) {
            dd($category);
            foreach ($category['children'] as $subCategory) {
                $this->categoryOptions[$category['title']][$subCategory['id']] = $subCategory['title'];
            }
        }
    }

    public function render()
    {
        return view('livewire.object-entity-form');
    }
}
