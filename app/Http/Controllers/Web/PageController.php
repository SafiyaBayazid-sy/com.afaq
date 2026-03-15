<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home/Index')->rootView('main');
    }

    public function about()
    {
        return Inertia::render('About/Index')->rootView('main');
    }

    public function services()
    {
        return Inertia::render('Services/Index')->rootView('main');
    }

    public function projects()
    {
        return Inertia::render('Projects/Index')->rootView('main');
    }

    public function contact()
    {
        return Inertia::render('Contact/Index')->rootView('main');
    }
}
