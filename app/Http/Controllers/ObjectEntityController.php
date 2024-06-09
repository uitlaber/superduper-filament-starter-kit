<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectEntityController extends Controller
{

    public function index()
    {
        return view('objects.list');
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
