<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebManagementController extends Controller
{
    public function categorys()
    {
        return view('management.web.categorys');
    }
    public function create()
    {
        return view('management.web.create');
    }
    public function recommend()
    {
        return view('management.web.recommend');
    }
    public function settings()
    {
        return view('management.web.settings');
    }
    public function system()
    {
        return view('management.web.system');
    }
}
