<?php

namespace App\Http\Controllers\Admin\Agencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgenciesController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/Agencies/Index');
    }
}
