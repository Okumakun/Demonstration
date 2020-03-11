<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipController extends Controller
{
    //
    public function index()
    {
        return view('tips.index');
    }

    //
    public function create()
    {
        return view('tips.create');
    }
    //
    public function store(Request $request)
    {
        return view('tips.store');
    }

    //
    public function display()
    {
        return view('tips.display');
    }

    //
    public function edit($id)
    {
        return view('tips.edit');
    }

    //
    public function update(Request $request ,$id)
    {

    }



}
