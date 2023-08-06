<?php

namespace Sindor\LaravelGii\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundApplication;

class MainController extends Controller
{
    public function index(): View|FoundApplication|Factory|Application
    {
        return view("gii::main.index");
    }
}
