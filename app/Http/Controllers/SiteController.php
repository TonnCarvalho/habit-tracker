<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function dashboard(): View
    {
        $habits = auth()->user()->habits;
        return view(
            'dashboard',
            compact([
                'habits',
            ])
        );
    }
}
