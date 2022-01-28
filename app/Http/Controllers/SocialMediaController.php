<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// video names this AppController
class SocialMediaController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
