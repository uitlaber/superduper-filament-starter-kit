<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\ClickHome\Models\City;
use Modules\ClickHome\Models\ObjectCategory;
use Modules\ClickHome\Models\Property;

class TopFilter extends Component
{
    public $isFullFilter = false;
    public $selectedType = null;
    public $selectedRoot = null;
    public $selectedChild = null;
    public $selectedCity = null;
    public $defaultProperties = null;
    public $fullProperties = null;

    public $rootCategories = null;
    public $childCategories = null;
    public $cities = null;

    public function mount()
    {
        $this->selectedType = 'buy';
        $this->rootCategories = ObjectCategory::query()
            ->where('parent_id', -1)
            ->pluck('title', 'id')
            ->toArray();
        $this->selectedRoot = array_key_first($this->rootCategories);
        $this->childCategories = ObjectCategory::query()
            ->where('parent_id', $this->selectedRoot)
            ->pluck('title', 'id')
            ->toArray();
        $this->selectedChild = array_key_first($this->childCategories);
        $this->setProperties();
        $this->cities = City::query()
            ->whereNull('parent_id')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.top-filter');
    }

    public function selectType($type)
    {
        $this->selectedType = $type;
    }

    public function updatedSelectedRoot($value)
    {
        $this->childCategories = ObjectCategory::query()
            ->where('parent_id', $this->selectedRoot)
            ->pluck('title', 'id')
            ->toArray();
        $this->selectedChild = array_key_first($this->childCategories);
        $this->setProperties();
    }

    public function updatedSelectedChild()
    {
        $this->setProperties();
    }

    public function toggleFull()
    {
        $this->isFullFilter = !$this->isFullFilter;
    }

    public function setProperties()
    {
        $childCategory = ObjectCategory::find($this->selectedChild);
        $this->defaultProperties = Property::query()
            ->whereHas('group', function ($query) use ($childCategory) {
                $query->whereIn('property_group_id', $childCategory->propertyGroups->pluck('id'));
            })
            ->where('show_top_filter', true)
            ->get();
        $this->fullProperties = Property::query()
            ->whereHas('group', function ($query) use ($childCategory) {
                $query->whereIn('property_group_id', $childCategory->propertyGroups->pluck('id'));
            })
            ->where('show_top_filter_advanced', true)
            ->get();
    }
}
