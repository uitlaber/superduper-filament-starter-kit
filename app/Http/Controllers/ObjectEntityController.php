<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ClickHome\Enums\DealTypeEnum;
use Modules\ClickHome\Models\ObjectCategory;
use Modules\ClickHome\Models\ObjectEntity;

class ObjectEntityController extends Controller
{
    public function index()
    {
        return view('objects.list');
    }

    public function single(Request $request, $objectId)
    {
        $objectEntity = ObjectEntity::findOrFail($objectId);
        return view('objects.single', compact('objectEntity'));
    }

    /**
     * Show the application's objects create form.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('objects.add');
    }

    public function remove(Request $request)
    {
    }
}
