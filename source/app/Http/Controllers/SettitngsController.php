<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettitngsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }
}