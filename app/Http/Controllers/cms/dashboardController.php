<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard()
    {
        return view('cms.pages.dashboard');
    }
}
