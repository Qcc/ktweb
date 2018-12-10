<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubManagementController extends Controller
{
     
    public function system()
    {
        return view('management.club.system');
    }
    public function recommend()
    {
        return view('management.club.recommend');
    }
    public function roles()
    {
        return view('management.club.roles');
    }
    public function settings()
    {
        return view('management.club.settings');
    }
    public function users()
    {
        return view('management.club.users');
    }
    public function articles()
    {
        return view('management.club.articles');
    }
    public function replys()
    {
        return view('management.club.replys');
    }
}
