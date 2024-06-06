<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;
use Maize\Markable\Models\Favorite;
use Modules\ClickHome\Models\ObjectEntity;

class ListObjects extends Component
{
    public string $title;
    public int $categoryId;
    public int $limit;
    public $objects = [];

    public function mount()
    {
        $this->objects = ObjectEntity::query()
            ->where('object_category_id', $this->categoryId)->take($this->limit ?? 8)->get();
    }

    public function render()
    {
        return view('livewire.list-objects');
    }


    public function favoriteAdd($id)
    {
        if (Auth::check()) {
            $objectEntity = ObjectEntity::findOrFail($id);
            Favorite::add($objectEntity, Auth::user());
            flash('Объект добавлен в избранные');
        } else {
            flash('Нужно авторизоваться');
        }
    }

    public function favoriteRemove($id)
    {
        if (Auth::check()) {
            $objectEntity = ObjectEntity::findOrFail($id);
            Favorite::remove($objectEntity, Auth::user());
            flash('Объект удален из избранных');
        } else {
            flash('Нужно авторизоваться');
        }
    }
}
