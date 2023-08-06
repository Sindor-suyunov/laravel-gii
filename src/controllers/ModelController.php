<?php

namespace Sindor\LaravelGii\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Sindor\LaravelGii\DTOs\GenerateModelDTO;
use Sindor\LaravelGii\DTOs\GenerateSameModelsDTO;
use Sindor\LaravelGii\services\model\GenerateModelService;
use Sindor\LaravelGii\services\model\GenerateSameModelsService;

class ModelController extends Controller
{
    public function __construct(
        public GenerateModelService $service,
    )
    {
    }

    public function createModel(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view("gii::model.create-model");
    }

    public function generateModel(Request $request): RedirectResponse
    {
        $this->service->data = GenerateModelDTO::fromRequest($request);
        $this->service->generateModel();
        return redirect()->route('create-model');
    }

    public function createModelsSameNamespace(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view("gii::model.create-models-same-namespace");
    }

    public function generateModelsSameNamespace(Request $request): RedirectResponse
    {
        $service = new GenerateSameModelsService(GenerateSameModelsDTO::fromRequest($request));
        $service->generateModels();
        return redirect()->route('create-models-same-namespace');
    }
}
