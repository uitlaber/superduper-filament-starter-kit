<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maize\Markable\Models\Favorite;
use Modules\ClickHome\Models\ObjectEntity;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        $objectEntity = ObjectEntity::findOrFail($request->id);
        Favorite::add($objectEntity, $request->user);
        flash('Объект добавлен в избранные');
    }

    public function remove(Request $request)
    {
        $objectEntity = ObjectEntity::findOrFail($request->id);
        Favorite::adremoved($objectEntity, $request->user);
        flash('Объект удален из избранных');
    }
}
