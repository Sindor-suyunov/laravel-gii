<?php

namespace Sindor\LaravelGii\livewire\model;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundApplication;
use Livewire\Component;
use Sindor\LaravelGii\helpers\Generator;

class CreateModelComponent extends Component
{
    public string $model_namespace;
    public string|null $table_name;
    public string $model_name;
    public string $table_schema;
    public string $model_path;
    public bool $model_create_fillable;
    public bool $model_create_casts;
    public bool $model_create_relations;
    public bool $add_resource_controller;
    public string $controller_namespace;
    public string $controller_name;
    public string $controller_path;
    public bool $hasError = true;

    protected array $rules = [
        'model_namespace' => 'required',
        'table_name' => 'required',
        'table_schema' => 'required',
        'model_name' => 'required',
        'model_path' => 'required',
        'controller_name' => "required_if:add_resource_controller,true",
        'controller_path' => "required_if:add_resource_controller,true",
        'controller_namespace' => "required_if:add_resource_controller,true",
    ];

    public function mount(): void
    {
        $this->model_namespace = 'App\Models';
        $this->model_path = 'app\Models';
        $this->table_name = '';
        $this->table_schema = env('DB_DATABASE', 'scheme');
        $this->model_name = '';
        $this->add_resource_controller = false;
        $this->controller_namespace = 'App\Http\Controllers';
        $this->controller_name = '';
        $this->controller_path = 'app\Http\Controllers';
        $this->model_create_relations = false;
        $this->model_create_casts = false;
        $this->model_create_fillable = false;
    }

    public function generateModelName(): void
    {
        $this->model_name = Generator::generateSingularModelNameFromTableName($this->table_name);
        $this->generateControllerName();
    }

    public function generateControllerName(): void
    {
        if ($this->add_resource_controller) $this->controller_name = Generator::generateSingularModelNameFromTableName($this->table_name) . 'Controller';
    }

    public function check()
    {
        $this->hasError = true;
        $this->validate();
        $this->hasError = false;
    }


    public function render(): View|FoundApplication|Factory|Application
    {
        return view('gii::livewire.model.create-model-component');
    }
}
