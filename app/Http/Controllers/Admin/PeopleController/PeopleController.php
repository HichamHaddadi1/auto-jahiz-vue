<?php

namespace App\Http\Controllers\Admin\PeopleController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeopleController extends Controller
{
    public function overview(): \Inertia\Response
    {
        return Inertia::render('Admin/People/Overview');
    }

    public function agents(): \Inertia\Response
    {
        return Inertia::render('Admin/People/Agents');
    }

    public function clients(): \Inertia\Response
    {
        return Inertia::render('Admin/People/Clients');
    }
}
