<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CrawlerController extends Controller
{
    public function __invoke()
    {
        User::registerFromLandingPage(
            request()->validate([
                'email' => 'required|email|unique:users',
                'url' => 'required|url',
                'query' => 'required|alpha_dash'
            ])
        );
    }
}
