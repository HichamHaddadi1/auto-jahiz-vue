<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/Categories/Categories');
    }
}
