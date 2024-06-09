<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;
use Maize\Markable\Models\Favorite;
use Modules\ClickHome\Models\ObjectEntity;

class FavoriteButton extends Component
{

    public ObjectEntity $obj;

    public function render()
    {
        return view('livewire.favorite-button');
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
